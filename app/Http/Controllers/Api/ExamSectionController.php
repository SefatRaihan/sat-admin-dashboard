<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSection;
use App\Models\ExamQuestion;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ExamSectionController extends Controller
{
    /**
     * Assign a question to a section (Drag & Drop).
     */
    public function assignQuestionToSection(Request $request)
    {
        $validator = \Validator::make($request->all(), [
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
        $validator = \Validator::make($request->all(), [
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
}
