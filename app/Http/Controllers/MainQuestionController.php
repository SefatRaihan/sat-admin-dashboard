<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class MainQuestionController extends Controller
{
    /**
     * Display a listing of the questions with optional filters and pagination.
     */
    public function index(Request $request)
    {
        $questions = ExamQuestion::query();

        // Apply optional filters
        if ($request->filled('difficulty')) {
            $questions->where('difficulty', $request->difficulty);
        }
        if ($request->filled('question_type')) {
            $questions->where('question_type', $request->question_type);
        }
        if ($request->filled('audience')) {
            $questions->where('audience', $request->audience);
        }
        if ($request->filled('sat_type')) {
            $questions->where('sat_type', $request->sat_type);
        }
        if ($request->filled('sat_question_type')) {
            $questions->where('sat_question_type', $request->sat_question_type);
        }
        if ($request->filled('status')) {
            $questions->where('status', $request->status);
        }

        $perPage = $request->get('per_page', 10);
        $questions = $questions->paginate($perPage);

        return response()->json($questions);
    }

    /**
     * Store a newly created question.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_title' => 'required|string|max:255',
            'question_description' => 'nullable|string',
            'question_text' => 'required|string',
            'question_type' => ['required', Rule::in(['MCQ', 'Fill-in-the-Blank', 'Paragraph'])],
            'audience' => ['required', Rule::in(['High School', 'College', 'Graduation', 'SAT 2'])],
            'sat_type' => ['nullable', Rule::in(['SAT 1', 'SAT 2'])],
            'sat_question_type' => ['nullable', Rule::in(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant'])],
            'options' => 'nullable',
            'correct_answer' => 'required|string|max:255',
            'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard', 'Very Hard'])],
            'tags' => 'nullable|array',
            'explanation' => 'nullable|string',
            'images' => 'nullable|array',
            'videos' => 'nullable|array',
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $question = ExamQuestion::create([
                        'audience'             => $request->audience,
                        'question_title'       => $request->question_title,
                        'question_description' => $request->question_description,
                        'question_text'        => $request->question_text,
                        'question_type'        => $request->question_type,
                        'sat_type'             => $request->sat_type,
                        'sat_question_type'    => $request->sat_question_type,
                        'options'              => $request->options,
                        'correct_answer'       => $request->correct_answer,
                        'difficulty'           => $request->difficulty,
                        'explanation'          => $request->explanation,
                        'status'               => $request->status,
                        'created_by'           => auth()->id() ?? '1'
                    ]);

        Log::info('New question created', ['question_id' => $question->id, 'created_by' => $question->created_by]);

        return response()->json(['success'=> true, 'data' => $question, 201]);
    }

    /**
     * Display the specified question with related exams and sections.
     */
    public function show($id)
    {
        try {
            $question = ExamQuestion::with(['exams'])->findOrFail($id);
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
                'question_title' => 'sometimes|string|max:255',
                'question_description' => 'sometimes|string|nullable',
                'question_text' => 'sometimes|string',
                'question_type' => ['sometimes', Rule::in(['MCQ', 'Fill-in-the-Blank', 'Paragraph'])],
                'audience' => ['sometimes', Rule::in(['High School', 'College', 'Graduation', 'SAT 2'])],
                'sat_type' => ['sometimes', Rule::in(['SAT 1', 'SAT 2'])],
                'sat_question_type' => ['sometimes', Rule::in(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant'])],
                'options' => 'nullable|array',
                'correct_answer' => 'sometimes|string|max:255',
                'difficulty' => ['sometimes', Rule::in(['Easy', 'Medium', 'Hard', 'Very Hard'])],
                'tags' => 'nullable|array',
                'explanation' => 'nullable|string',
                'images' => 'nullable|array',
                'videos' => 'nullable|array',
                'status' => ['sometimes', Rule::in(['active', 'inactive'])],
                'updated_by' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $question->update($validator->validated());

            Log::info('Question updated', ['question_id' => $question->id, 'updated_by' => $question->updated_by]);

            return response()->json($question);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }
    }

    /**
     * Remove the specified question (Soft Delete).
     */
    public function destroy($id)
    {
        try {
            $question = ExamQuestion::findOrFail($id);
            $question->delete();

            Log::warning('Question deleted', ['question_id' => $question->id]);

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

        Log::info('Question restored', ['question_id' => $question->id]);

        return response()->json(['message' => 'Question restored successfully', 'question' => $question]);
    }

    /**
 * Toggle the status of a question (Active ↔ Inactive)
 */
    public function toggleStatus(Request $request, $id)
    {
        try {
            $question = ExamQuestion::findOrFail($id);

            $question->update(['status' => $request->status]);

            Log::info('Question status toggled', ['question_id' => $question->id, 'new_status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => "Question status updated successfully.",
                // 'question_id' => $question->id,
                // 'new_status' => $status
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Question not found'], 404);
        }
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