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

}
