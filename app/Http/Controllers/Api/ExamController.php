<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\ExamSection;
use Illuminate\Support\Str;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptQuestion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExamController extends Controller
{
    /**
     * 📌 Get a list of all exams (with optional filters)
     */
    public function index(Request $request)
    {
        $exams = Exam::latest()->with([
            'sections' => function ($query) {
                $query->withCount('questions');
            },'createdBy'
        ])->withCount('sections');

        // Apply filters if provided
        if ($request->has('scheduled_at')) {
            $exams->whereDate('scheduled_at', $request->scheduled_at);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $exams->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('section', 'like', "%{$search}%")
                  ->orWhere('scheduled_at', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('duration', 'like', "%{$search}%");
            });
        }

        // Filter soft-deleted exams only if requested
        if ($request->has('with_deleted') && $request->with_deleted == true) {
            $exams = $exams->withTrashed();
        }

        $perPage = $request->get('per_page', 10);
        $exams = $exams->paginate($perPage);

        // Append total question count
        $exams->getCollection()->transform(function ($exam) {
            $exam->total_question_count = $exam->sections->sum('questions_count');
            return $exam;
        });

        return response()->json($exams);
    }

    /**
     * 📌 Store a newly created exam.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'section'         => 'required|integer',
            'total_duration'  => 'required|integer|min:1',
            'audience'        => 'required|string', // Added assuming it's used in ExamSection
            'section_details' => 'required|array',  // Validate section_details as an array
            'section_details.*.exam_name'     => 'required|string|max:255',
            'section_details.*.section_order' => 'required|integer|min:1',
            'section_details.*.section_type'  => 'required|string',
            'section_details.*.no_of_questions' => 'required|integer|min:1',
            'section_details.*.duration'      => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Create the exam
            $exam = Exam::create([
                'uuid' => Str::uuid(),
                'title' => $request->title,
                'section' => $request->section,
                'duration' => $request->total_duration,
                'created_by' => auth()->id(),
            ]);

            // Create exam sections
            foreach ($request->section_details as $section) {
                ExamSection::create([
                    'uuid' => Str::uuid(),
                    'exam_id' => $exam->id,
                    'audience' => $request->audience,
                    'title' => $section['exam_name'],
                    'section_order' => $section['section_order'],
                    'section_type' => $section['section_type'],
                    'num_of_question' => $section['no_of_questions'],
                    'duration' => $section['duration'],
                    'created_by' => auth()->id(),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('exams.show', $exam->id),
            ], 201); // 201 Created status code

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create exam: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 📌 Get details of a specific exam (with sections).
     */
    public function show($id)
    {
        try {
            $exam = Exam::with('sections','createdBy','updatedBy','questions')->findOrFail($id);
            return response()->json($exam);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Exam not found'], 404);
        }
    }

    /**
     * 📌 Update an existing exam.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'section'         => 'required|integer',
            'total_duration'  => 'required|integer|min:1',
            'audience'        => 'required|string', // Assuming it's used in ExamSection
            'section_details' => 'required|array',  // Validate section_details as an array
            'section_details.*.exam_name'       => 'required|string|max:255',
            'section_details.*.section_order'   => 'required|integer|min:1',
            'section_details.*.section_type'    => 'required|string',
            'section_details.*.no_of_questions' => 'required|integer|min:1',
            'section_details.*.duration'        => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Find the existing exam by ID
            $exam = Exam::findOrFail($id);

            // Update the exam
            $exam->update([
                'title'      => $request->title,
                'section'    => $request->section,
                'duration'   => $request->total_duration,
                'status'     => 'inactive',
                'updated_by' => auth()->id(),
            ]);

            // Create or update exam sections
            foreach ($request->section_details as $section) {
                ExamSection::updateOrCreate(
                    ['id' => $section['section_id'] ?? null], // Find existing section if ID is provided
                    [
                        'uuid'            => $section['section_id'] ? ExamSection::find($section['section_id'])->uuid : Str::uuid(),
                        'exam_id'         => $exam->id,
                        'audience'        => $request->audience,
                        'title'           => $section['exam_name'],
                        'section_order'   => $section['section_order'],
                        'section_type'    => $section['section_type'],
                        'num_of_question' => $section['no_of_questions'],
                        'duration'        => $section['duration'],
                        'updated_by'      => auth()->id(),
                        'created_by'      => $section['section_id'] ? null : auth()->id(),                                             // Only set `created_by` for new sections
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('exams.edit', $exam->id),
            ], 200); // 200 OK status code

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update exam: ' . $e->getMessage(),
            ], 500);
        }
    }


    /**
     * 📌 Soft delete an exam.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $exam = Exam::findOrFail($id);

            // Validate deleted_by
            $validator = Validator::make($request->all(), [
                'deleted_by' => 'nullable|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $exam->update(['deleted_by' => $request->deleted_by]);

            $exam->delete();

            return response()->json(['message' => 'Exam deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Exam not found'], 404);
        }
    }

    /**
     * 📌 Restore a soft-deleted exam.
     */
    public function restore($id)
    {
        try {
            $exam = Exam::onlyTrashed()->findOrFail($id);
            $exam->restore();

            return response()->json(['message' => 'Exam restored successfully', 'exam' => $exam]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Exam not found or not deleted'], 404);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $exam = Exam::findOrFail($id);

            $exam->update(['status' => $request->status]);

             // Retrieve all sections belonging to this exam
            $sections = ExamSection::where('exam_id', $exam->id)->get();

            // Collect all questions linked to sections in this exam
            $currentSectionQuestions = ExamQuestion::whereHas('sections', function ($query) use ($exam) {
                $query->where('exam_id', $exam->id);
            })->pluck('id')->toArray();


            // Find all questions assigned to the exam
            $currentExamQuestions = $exam->questions()->pluck('exam_questions.id')->toArray();

            // Identify questions that are in the exam but NOT in the section
            $questionsToRemove = array_diff($currentExamQuestions, $currentSectionQuestions);

            if (!empty($questionsToRemove)) {
                // Remove those questions from the exam-question pivot table
                $exam->questions()->detach($questionsToRemove);
            }

            Log::info('Question status toggled', ['question_id' => $exam->id, 'new_status' => $exam->status]);

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

    public function delete(Request $request)
    {
        Exam::whereIn('uuid', $request->exams)->delete();
        return response()->json(['message' => 'Exams deleted successfully']);
    }

    public function results(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'search' => 'nullable|string|max:255',
            'create_from' => 'nullable|date',
            'create_to' => 'nullable|date|after_or_equal:create_from',
            'status' => 'nullable|in:all,active,inactive', // Adjusted to match frontend
            'audience_type' => 'nullable|string',
            'package' => 'nullable|string',
            'duration' => 'nullable|string',
            'gender' => 'nullable|string',
            'sort' => 'nullable|in:Latest,Oldest',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);
    
        // Base query with eager loading
        $query = ExamAttempt::with([
            'exam.sections' => function ($query) {
                $query->orderBy('id', 'asc');
            },
            'user.student',
        ]);
    
        // Apply status filter (adjusted to match frontend)
        if ($status = $request->input('status')) {
            if ($status === 'active') {
                $query->where('status', 'completed');
            } elseif ($status === 'inactive') {
                $query->where('status', 'in_progress');
            }
            // If 'all', no status filter is applied
        } else {
            $query->whereIn('status', ['completed', 'in_progress']);
        }
    
        // Search by exam name or student name
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('exam', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })->orWhereHas('user', function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%");
                });
            });
        }
    
        // Date range filter
        if ($createFrom = $request->input('create_from')) {
            $query->whereDate('created_at', '>=', $createFrom);
        }
        if ($createTo = $request->input('create_to')) {
            $query->whereDate('created_at', '<=', $createTo);
        }
    
        // Audience type filter
        if ($audienceTypes = $request->input('audience_type')) {
            $audienceTypes = array_filter(explode(',', trim($audienceTypes)));
            if (!empty($audienceTypes)) {
                $query->whereHas('exam.sections', function ($q) use ($audienceTypes) {
                    $q->whereIn('audience', $audienceTypes);
                });
            }
        }

    
        // Sorting
        $sort = $request->input('sort', 'Latest');
        $query->orderBy('created_at', $sort === 'Latest' ? 'desc' : 'asc');
    
        // Pagination
        $perPage = $request->input('per_page', 10);
        $results = $query->paginate($perPage);
    
        // Transform results
        $transformedResults = $results->getCollection()->map(function ($attempt) {
            // Calculate total questions from exam sections
            $totalQuestions = ExamSection::where('exam_id', $attempt->exam_id)
                ->sum('num_of_question');
    
            // Calculate time taken
            $timeTaken = ($attempt->end_time && $attempt->start_time)
                ? $attempt->end_time->diffInMinutes($attempt->start_time)
                : null;
    
            // Optimized ranking calculation
            $currentCorrectAnswers = ExamAttemptQuestion::where('attempt_id', $attempt->id)
                ->where('is_correct', true)
                ->count();
    
            $rank = ExamAttempt::where('exam_id', $attempt->exam_id)
                ->where('status', 'completed')
                ->select('user_id', \DB::raw('MIN(attempt_number) as attempt_number'))
                ->groupBy('user_id')
                ->get()
                ->map(function ($otherAttempt) use ($attempt, $currentCorrectAnswers) {
                    $otherAttemptId = ExamAttempt::where('user_id', $otherAttempt->user_id)
                        ->where('exam_id', $attempt->exam_id)
                        ->where('status', 'completed')
                        ->orderBy('attempt_number', 'asc')
                        ->first()?->id;
    
                    if (!$otherAttemptId) {
                        return null;
                    }
    
                    $otherCorrectAnswers = ExamAttemptQuestion::where('attempt_id', $otherAttemptId)
                        ->where('is_correct', true)
                        ->count();
    
                    return [
                        'correct_answers' => $otherCorrectAnswers,
                        'attempt_number' => $otherAttempt->attempt_number,
                        'is_higher' => ($otherCorrectAnswers > $currentCorrectAnswers) ||
                            ($otherCorrectAnswers === $currentCorrectAnswers &&
                             $otherAttempt->attempt_number < $attempt->attempt_number),
                    ];
                })
                ->filter()
                ->filter(fn($result) => $result['is_higher'])
                ->count() + 1;
    
            return [
                'uuid' => $attempt->uuid ?? 'N/A',
                'exam_name' => $attempt->exam->title ?? 'N/A',
                'audience' => $attempt->exam->sections->first()->audience ?? 'N/A',
                'student_name' => $attempt->user->student->name ?? $attempt->user->full_name ?? 'N/A',
                'ranking' => $rank ?? 'N/A',
                'total_questions' => $totalQuestions ?? 'N/A',
                'result' => ($attempt->correct_answers && $totalQuestions)
                    ? number_format(($attempt->correct_answers / $totalQuestions) * 100, 2) . '%'
                    : 'N/A',
                'duration' => $attempt->exam->duration ? $attempt->exam->duration . ' min' : 'N/A',
                'timing' => $timeTaken ? $timeTaken . ' min' : 'N/A',
                'created_at' => $attempt->created_at ? $attempt->created_at->format('d-M-y') : 'N/A',
            ];
        });
    
        return response()->json([
            'totalResult' => $results->total(),
            'results' => [
                'data' => $transformedResults,
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem(),
                'total' => $results->total(),
            ],
        ]);
    }

    public function resultDetails($uuid)
    {
        $attempt = ExamAttempt::with([
            'exam.sections',
            'user.student'
        ])->where('uuid', $uuid)->firstOrFail();

        // Fetch performance data from exam_attempt_questions
        $performance = ExamAttemptQuestion::where('attempt_id', $attempt->id)
            ->with(['question' => function ($query) {
                $query->with(['course', 'section']); // Assumes question has course and section relationships
            }])
            ->get()
            ->groupBy('question.section_id') // Group by section
            ->map(function ($questions, $sectionId) use ($attempt) {
                $section = $questions->first()->question->section;
                $course = $questions->first()->question->course;
                $totalQuestions = $questions->count();
                $correctAnswers = $questions->where('is_correct', true)->count();
                $score = $correctAnswers; // Or use a custom scoring logic
                $percentage = $totalQuestions ? ($correctAnswers / $totalQuestions) * 100 : 0;

                return [
                    'course' => $course ? $course->name : 'N/A',
                    'date' => $attempt->created_at->format('d-M-y'),
                    'section' => $section ? $section->name : 'Not found',
                    'score' => $score,
                    'percentage' => number_format($percentage, 2),
                ];
            })->values();

        return response()->json([
            'data' => [
                'result_code' => 'SID' . str_pad($attempt->id, 3, '0', STR_PAD_LEFT),
                'name' => $attempt->user->student->name ?? $attempt->user->name ?? 'N/A',
                'date_of_birth' => $attempt->user->date_of_birth,
                'email' => $attempt->user->email,
                'audience' => $attempt->exam->sections->first()->audience ?? 'N/A',
                'gender' => $attempt->user->gender,
                'status' => $attempt->status ?? 'completed',
                'phone' => $attempt->user->phone,
                'performance' => $performance,
            ],
        ]);
    }
    

}