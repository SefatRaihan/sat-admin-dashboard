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
        $query = ExamQuestion::latest()->with('createdBy');
    
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question_title', 'like', "%{$search}%")
                  ->orWhere('question_description', 'like', "%{$search}%")
                  ->orWhere('question_text', 'like', "%{$search}%");
            });
        }
    
        // Date range filter
        if ($request->filled('crated_start_at') && $request->filled('crated_end_at')) {
            $query->whereBetween('created_at', [
                $request->crated_start_at,
                $request->crated_end_at
            ]);
        }
    
        // Status filter
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'Active only':
                    $query->where('status', 'active');
                    break;
                case 'Inactive only':
                    $query->where('status', '!=', 'active');
                    break;
                // 'All' case doesn't need additional where clause
            }
        }
    
        // Audience and Type filters
        if ($request->filled('audience')) {
            $query->where('audience', $request->audience);
        }
    
        if ($request->filled('sat_type')) {
            $query->where('sat_type', $request->sat_type);
        }
    
        if ($request->filled('sat_question_type')) {
            $query->where('sat_question_type', $request->sat_question_type);
        }
    
        // Exam appearance filter
        if ($request->filled('exam_appearance')) {
            $query->whereIn('audience', $request->exam_appearance);
        }
    
        // Difficulty filter
        if ($request->filled('difficulty')) {
            $difficulties = is_array($request->difficulty) ? $request->difficulty : [$request->difficulty];
            $query->whereIn('difficulty', $difficulties);
        }
    
        // Created by filter
        if ($request->filled('created_by')) {
            $query->whereIn('created_by', $request->created_by);
        }
    
        // Question type filter
        if ($request->filled('question_type')) {
            $query->where('question_type', $request->question_type);
        }

        if ($request->section_type != 'Mixed') {
            $query->where('sat_question_type', $request->section_type);
        }

        $questions = $query->where('status', 'active')->get();
        
        return response()->json(['code' => 200, 'data' => $questions]);
    }

    // public function getQuestionsWithExamSection(Request $request)
    // {
    //     dd($request->all());
    //     if ($request->section_type == 'Mixed') {
    //         $questions =  ExamQuestion::where('audience', $request->audience)
    //                                     ->where('status', 'active')
    //                                     ->get();
    //     } else {
    //         $questions =  ExamQuestion::where('sat_question_type', $request->section_type)
    //                                     ->where('audience', $request->audience)
    //                                     ->where('status', 'active')
    //                                     ->get();
    //     }
    //     return response()->json(['code' => 200, 'data' => $questions]);
    // }
    
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
            $section->questions()->syncWithoutDetaching($request->questions);

            $exam = Exam::find($request->exam_id);
            $exam->questions()->syncWithoutDetaching($request->questions);
            


        DB::commit();

        return response()->json(['code' => 200, 'Success' => true]);
    }
}