<?php

namespace App\Http\Controllers\Api;

use App\Models\ExamSection;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Console\Question\Question;

class ExamSectionController extends Controller
{

    public function getQuestionsWithExamSection(Request $request)
    {
        $questions =  ExamQuestion::where('sat_question_type', $request->section_type)
                                    ->where('audience', $request->audience)
                                    ->where('status', 'active')
                                    ->get();
        return response()->json(['code' => 200, 'data' => $questions]);
    }
    
    /**
     * Assign a question to a section (Drag & Drop).
     */
    public function assignQuestionToSection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required|exists:exam_sections,id',
            'question_id' => 'required|exists:exam_questions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return DB::transaction(function () use ($request) {
            $section = ExamSection::findOrFail($request->section_id);
            $question = ExamQuestion::findOrFail($request->question_id);

            // ✅ Attach question to section
            $section->questions()->syncWithoutDetaching([$question->id]);

            Log::info('Question assigned to section', ['section_id' => $section->id, 'question_id' => $question->id]);

            return response()->json([
                'message' => 'Question assigned to section successfully',
                'section' => $section->load('questions'),
            ]);
        });
    }

    /**
     * Remove a question from a section (Drag out).
     */
    public function removeQuestionFromSection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required|exists:exam_sections,id',
            'question_id' => 'required|exists:exam_questions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return DB::transaction(function () use ($request) {
            $section = ExamSection::findOrFail($request->section_id);
            $question = ExamQuestion::findOrFail($request->question_id);

            // ✅ Detach question from section
            $section->questions()->detach($question->id);

            Log::info('Question removed from section', ['section_id' => $section->id, 'question_id' => $question->id]);

            return response()->json([
                'message' => 'Question removed from section successfully',
                'section' => $section->load('questions'),
            ]);
        });
    }

    public function examSectionQuestion(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'exam_id'     => 'required|exists:exams,id',
            'section_id'  => 'required|exists:exam_sections,id',
            'questions'   => 'required|array',
            'questions.*' => 'exists:exam_questions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        DB::beginTransaction();

            $section = ExamSection::find($request->section_id);
            $section->questions()->sync($request->questions);

            $exam = Exam::find($request->exam_id);
            $exam->questions()->sync($request->questions);

        DB::commit();

        return response()->json(['code' => 200, 'Success' => true]);
    }
}