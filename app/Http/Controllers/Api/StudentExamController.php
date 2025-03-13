<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentExamController extends Controller
{
    /**
     * Fetch exam details for a student, including sections and questions.
     */
    public function getExamForStudent($examId)
    {
        try {
            $exam = Exam::with([
                'sections' => function ($query) {
                    $query->with([
                        'questions' => function ($q) {
                            $q->where('status', 'active') // Fetch only active questions
                              ->select('id', 'section_id', 'question_text', 'question_type', 'options', 'correct_answer', 'difficulty');
                        }
                    ]);
                }
            ])->findOrFail($examId);

            return response()->json([
                'success' => true,
                'exam' => $exam
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found'
            ], 404);
        }
    }
}
