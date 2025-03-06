<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;

class MainQuestionController extends Controller
{
    /**
     * Display a listing of the questions with optional filters and pagination.
     */
    public function index(Request $request)
    {
        $questions = ExamQuestion::query();

        // Apply filters if provided
        if ($request->has('difficulty')) {
            $questions->where('difficulty', $request->difficulty);
        }

        if ($request->has('question_type')) {
            $questions->where('question_type', $request->question_type);
        }

        return response()->json($questions->paginate($request->get('per_page', 10)));
    }

    /**
     * Store a newly created question.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required|string',
            'question_type' => ['required', Rule::in(['MCQ', 'Fill-in-the-Blank', 'Paragraph'])],
            'options' => 'nullable|array',
            'correct_answer' => 'required|string',
            'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard', 'Very Hard'])],
            'tags' => 'nullable|array',
            'explanation' => 'nullable|string',
            'images' => 'nullable|array',
            'videos' => 'nullable|array',
            'created_by' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $question = ExamQuestion::create($validator->validated());
        return response()->json($question, 201);
    }

    /**
     * Display the specified question with its related exams and sections.
     */
    public function show($id)
    {
        try {
            $question = ExamQuestion::with(['exams', 'sections'])->findOrFail($id);
            return response()->json($question);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }
    }

    /**
     * Update the specified question.
     */
    public function update(Request $request, $id)
    {
        try {
            $question = ExamQuestion::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'question_text' => 'sometimes|string',
                'question_type' => ['sometimes', Rule::in(['MCQ', 'Fill-in-the-Blank', 'Paragraph'])],
                'options' => 'nullable|array',
                'correct_answer' => 'sometimes|string',
                'difficulty' => ['sometimes', Rule::in(['Easy', 'Medium', 'Hard', 'Very Hard'])],
                'tags' => 'nullable|array',
                'explanation' => 'nullable|string',
                'images' => 'nullable|array',
                'videos' => 'nullable|array',
                'updated_by' => 'required|exists:users,id'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            
            $question->update($validator->validated());
            return response()->json($question);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }
    }

    /**
     * Remove the specified question.
     */
    public function destroy($id)
    {
        try {
            $question = ExamQuestion::findOrFail($id);
            $question->delete();
            return response()->json(['message' => 'Question deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }
    }

    /**
     * Restore a soft-deleted question.
     */
    public function restore($id)
    {
        $question = ExamQuestion::onlyTrashed()->find($id);
        
        if (!$question) {
            return response()->json(['error' => 'Question not found or not deleted'], 404);
        }

        $question->restore();
        return response()->json(['message' => 'Question restored successfully', 'question' => $question]);
    }

    /**
     * Fetch exams and sections related to a question.
     */
    public function getRelations($id)
    {
        try {
            $question = ExamQuestion::with(['exams', 'sections'])->findOrFail($id);
            return response()->json($question);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }
    }
}
