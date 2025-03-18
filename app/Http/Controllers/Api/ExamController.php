<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * 📌 Get a list of all exams (with optional filters)
     */
    public function index(Request $request)
    {
        $exams = Exam::query();

        // Apply filters if provided
        if ($request->has('scheduled_at')) {
            $exams->whereDate('scheduled_at', $request->scheduled_at);
        }

        // Filter soft-deleted exams only if requested
        if ($request->has('with_deleted') && $request->with_deleted == true) {
            $exams = $exams->withTrashed();
        }

        return response()->json($exams->paginate($request->get('per_page', 10)));
        // return view('backend.exams.index');
    }

    /**
     * 📌 Store a newly created exam.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255',
            // 'description'  => 'nullable|string',
            // 'scheduled_at' => 'required|date',
            'total_duration'  => 'required|integer|min:1',
            // 'created_by'      => 'required|integer|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        DB::beginTransaction();
            // Create the exam
            $exam = Exam::create([
                'uuid' => Str::uuid(),
                'title' => $request->title,
                // 'description' => $request->description,
                // 'scheduled_at' => $request->scheduled_at,
                'duration' => $request->total_duration,
                'created_by' =>  auth()->id(),
            ]);
        
            foreach ($request->section_details as $section) {
                // dd($section['exam_name']);
                ExamSection::create([
                    'uuid' => Str::uuid(),
                    'exam_id'  => $exam->id,
                    'audience' => $request->audience,
                    'title'    => $section['exam_name'],
                    // 'description'   => $section['section_type'],
                    'section_order'   => $section['section_order'],
                    'section_type'    => $section['section_type'],
                    'num_of_question' => $section['no_of_questions'],
                    'duration'        => $section['duration'],
                    'created_by'      => auth()->id(),
                ]);
            }
        DB::commit();
        return response()->json(['success'=> true, 'redirect' => route('exams.show', $exam->id), 201]);
        
    }






    /**
     * 📌 Get details of a specific exam (with sections).
     */
    public function show($id)
    {
        try {
            $exam = Exam::with('sections')->findOrFail($id);
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
        try {
            $exam = Exam::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title'        => 'sometimes|string|max:255',
                'description'  => 'nullable|string',
                'scheduled_at' => 'nullable|date',
                'duration'     => 'sometimes|integer|min:1',
                'updated_by'   => 'nullable|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $exam->update($validator->validated());

            Log::info('Exam updated', ['exam_id' => $exam->id, 'updated_by' => $exam->updated_by]);

            return response()->json($exam);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Exam not found'], 404);
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

}