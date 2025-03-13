<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the questions based on filters.
     * Possible filters: active, inactive, all
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'active'); // Default to active questions

        if ($filter === 'inactive') {
            $questions = ExamQuestion::onlyTrashed()->get();
        } elseif ($filter === 'all') {
            $questions = ExamQuestion::withTrashed()->get();
        } else {
            $questions = ExamQuestion::all(); // Active questions
        }

        return response()->json($questions, Response::HTTP_OK);
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_title' => 'required|string|max:255',
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'audience' => 'required|string',
            'sat_type' => 'nullable|string',
            'sat_question_type' => 'nullable|string',
            'options' => 'nullable|array',
            'correct_answer' => 'required|string',
            'difficulty' => 'required|string|in:Easy,Medium,Hard,Very Hard',
            'tags' => 'nullable|array',
            'explanation' => 'nullable|string',
            'created_by' => 'required|integer|exists:users,id', // ✅ Ensure created_by is specified
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $question = ExamQuestion::create($request->all());

        return response()->json($question, Response::HTTP_CREATED);
    }


    /**
     * Display the specified question.
     */
    public function show(ExamQuestion $question)
    {
        return response()->json($question, Response::HTTP_OK);
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, ExamQuestion $question)
    {
        $validator = Validator::make($request->all(), [
            'question_title' => 'sometimes|string|max:255',
            'question_text' => 'sometimes|string',
            'question_type' => 'sometimes|string',
            'difficulty' => 'sometimes|string|in:Easy,Medium,Hard,Very Hard',
            'options' => 'nullable|array',
            'correct_answer' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $question->update(array_merge($request->all(), ['updated_by' => auth()->id()]));

        return response()->json($question, Response::HTTP_OK);
    }

    /**
     * Soft delete the specified question.
     */
    public function destroy(ExamQuestion $question)
    {
        $question->update(['deleted_by' => auth()->id()]);
        $question->delete();

        return response()->json(['message' => 'Question soft deleted successfully'], Response::HTTP_OK);
    }

    /**
     * Restore a soft deleted question.
     */
    public function restore($id)
    {
        $question = ExamQuestion::withTrashed()->find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], Response::HTTP_NOT_FOUND);
        }

        $question->restore();

        return response()->json(['message' => 'Question restored successfully', 'question' => $question], Response::HTTP_OK);
    }
}
