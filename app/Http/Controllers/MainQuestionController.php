<?php

namespace App\Http\Controllers;

use App\Models\ExamAttemptQuestion;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MainQuestionController extends Controller
{

    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form',
        'toggleStatus' => 'Toggle Status',
        'restore' => 'Restore',
        'delete' => 'Delete Multiple',
        'getRelations' => 'Get Relations'
    ];

    /**
     * Display a listing of the questions with optional filters and pagination.
     */
    public function index(Request $request)
    {
        $query = ExamQuestion::with('createdBy');


        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question_title', 'like', "%{$search}%")
                ->orWhere('question_description', 'like', "%{$search}%")
                ->orWhere('question_text', 'like', "%{$search}%");
            });
        }

        if ($request->filled('created_start_at') && $request->filled('created_end_at')) {
            $query->whereBetween('exam_questions.created_at', [
                $request->created_start_at,
                $request->created_end_at
            ]);
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'All') {
            switch ($request->status) {
                case 'Active only':
                    $query->where('status', 'active');
                    break;
                case 'Inactive only':
                    $query->where('status', '!=', 'active');
                    break;
            }
        }

        // Audience filter
        if ($request->filled('audience')) {
            $audiences = $request->audience;
            $audienceValues = array_unique(
                array_map(
                    fn($value) => explode('-', $value)[0],
                    array_filter($audiences, fn($value) => strpos($value, '-') !== false)
                )
            );
            $satQuestionTypes = array_unique(
                array_map(
                    fn($value) => explode('-', $value)[1],
                    array_filter($audiences, fn($value) => strpos($value, '-') !== false)
                )
            );

            if (!empty($audienceValues)) {
                $query->whereIn('audience', $audienceValues);
            }

            if (!empty($satQuestionTypes)) {
                $query->whereIn('sat_question_type', $satQuestionTypes);
            }
        }

        // Audience and Type filters
        if ($request->filled('audienceSat') && $request->audienceSat[0] === 'All SAT 2') {
            $query->orWhere('audience', 'SAT 2');
        }

        // Exam appearance filter
        if ($request->filled('questionSearch')) {
            $query->where('question_title', 'LIKE', '%' . $request->questionSearch . '%');
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

        // Sorting
        if ($request->filled('sort')) {
            $sort = $request->sort == 'Oldest' ? 'asc' : 'desc';
            $query->orderBy('id', $sort);
        }

        $query->leftJoin('exam_attempt_questions', 'exam_questions.id', '=', 'exam_attempt_questions.question_id')
                ->select(
                    'exam_questions.*',
                    DB::raw('COALESCE(ROUND(AVG(exam_attempt_questions.time_spent), 2), 00.0) as avg_time_spent')
                )
                ->groupBy(
                    'exam_questions.id',
                    'exam_questions.uuid',
                    'exam_questions.question_title',
                    'exam_questions.question_description',
                    'exam_questions.question_text',
                    'exam_questions.question_type',
                    'exam_questions.audience',
                    'exam_questions.sat_type',
                    'exam_questions.sat_question_type',
                    'exam_questions.options',
                    'exam_questions.correct_answer',
                    'exam_questions.difficulty',
                    'exam_questions.tags',
                    'exam_questions.explanation',
                    'exam_questions.images',
                    'exam_questions.videos',
                    'exam_questions.status',
                    'exam_questions.created_by',
                    'exam_questions.updated_by',
                    'exam_questions.version_number',
                    'exam_questions.language_code',
                    'exam_questions.deleted_by',
                    'exam_questions.deleted_at',
                    'exam_questions.created_at',
                    'exam_questions.updated_at',
                    'exam_questions.topic_id',
                    'exam_questions.question_code'
                );

        // Pagination
        $perPage = $request->get('per_page', 10);
        $questions = $query->paginate($perPage);

        return response()->json($questions);
    }


    /**
     * Store a newly created question.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_title' => 'required',
            'question_description' => 'nullable',
            'topic' => 'required',
            'question_text' => 'required',
            'question_type' => ['required', Rule::in(['MCQ', 'Fill-in-the-Blank', 'Paragraph'])],
            'audience' => ['required', Rule::in(['High School', 'College', 'Graduation', 'SAT 2'])],
            'sat_type' => ['nullable', Rule::in(['SAT 1', 'SAT 2'])],
            'sat_question_type' => ['nullable', Rule::in(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant'])],
            'options' => 'nullable',
            'correct_answer' => 'required',
            'difficulty' => ['required', Rule::in(['Easy', 'Medium', 'Hard', 'Very Hard'])],
            'tags' => 'nullable|array',
            'explanation' => 'nullable',
            'images' => 'nullable|array',
            'videos' => 'nullable|array',
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction(); // Start Transaction

        try {

            if ($request->questionId != null) {
                // dd($request->topic);
                $question = ExamQuestion::find($request->questionId);
                $question->update([
                    'audience'             => $request->audience,
                    'topic_id'             => $request->topic,
                    'question_title'       => $request->question_title,
                    'question_description' => $request->question_description,
                    'question_text'        => $request->question_text,
                    'question_type'        => $request->question_type,
                    'sat_type'             => $request->sat_type,
                    'sat_question_type'    => $request->sat_question_type,
                    'options'              => $request->options,
                    'correct_answer'       => strip_tags($request->correct_answer),
                    'difficulty'           => $request->difficulty,
                    'explanation'          => $request->explanation,
                    'status'               => $request->status,
                    'updated_by'           => auth()->id() ?? '1'
                ]);

                $message = 'Question updated successfully.';
            } else {

                $latestStudent = ExamQuestion::latest('id')->first();
                if ($latestStudent && preg_match('/Q(\d+)/', $latestStudent->question_code, $matches)) {
                    $nextCoded = (int)$matches[1] + 1; // Extract numeric part (002) and increment to 3
                } else {
                    $nextCoded = 1; // Start from 1 if no question exists
                }

                $questionCode = 'Q' . str_pad($nextCoded, 4, '0', STR_PAD_LEFT);

                $question = ExamQuestion::create([
                    'question_code'        => $questionCode,
                    'audience'             => $request->audience,
                    'question_title'       => $request->question_title,
                    'question_description' => $request->question_description,
                    'question_text'        => $request->question_text,
                    'question_type'        => $request->question_type,
                    'sat_type'             => $request->sat_type,
                    'sat_question_type'    => $request->sat_question_type,
                    'options'              => $request->options,
                    'correct_answer'       => strip_tags($request->correct_answer),
                    'difficulty'           => $request->difficulty,
                    'explanation'          => $request->explanation,
                    'status'               => $request->status,
                    'created_by'           => auth()->id() ?? '1'
                ]);

                $message = 'Question created successfully.';
            }


            Log::info('New question created', ['question_id' => $question->id, 'created_by' => $question->created_by]);
            DB::commit();
            return response()->json(['success' => true, 'message' => $message ,'data' => $question, 201]);
        } catch (\Exception | QueryException $e) {
            DB::rollBack(); // Rollback on Error

            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified question with related exams and sections.
     */
    public function show($id)
    {
        try {
            $question = ExamQuestion::with(['exams','exams.sections','createdBy','updatedBy'])->findOrFail($id);
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
                'question_title' => 'sometimes',
                'question_description' => 'sometimes|string|nullable',
                'question_text' => 'sometimes|string',
                'question_type' => ['sometimes', Rule::in(['MCQ', 'Fill-in-the-Blank', 'Paragraph'])],
                'audience' => ['sometimes', Rule::in(['High School', 'College', 'Graduation', 'SAT 2'])],
                'sat_type' => ['sometimes', Rule::in(['SAT 1', 'SAT 2'])],
                'sat_question_type' => ['sometimes', Rule::in(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant'])],
                'options' => 'nullable|array',
                'correct_answer' => 'sometimes',
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

    public function delete(Request $request)
    {
        ExamQuestion::whereIn('uuid', $request->questions)->delete();
        return response()->json(['message' => 'Question deleted successfully']);
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
