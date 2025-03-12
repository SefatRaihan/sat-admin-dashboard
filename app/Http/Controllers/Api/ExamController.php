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
    }

    /**
     * 📌 Store a newly created exam.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title'        => 'required|string|max:255',
        'description'  => 'nullable|string',
        'scheduled_at' => 'nullable|date',
        'duration'     => 'required|integer|min:1',
        'num_sections' => 'nullable|integer|min:1|max:4',   // Default is 1
        'created_by'   => 'required|exists:users,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    return DB::transaction(function () use ($request) {
        // ✅ Ensure UUID is generated for the Exam
        $exam = Exam::create([
            'uuid'         => Str::uuid(),
            'title'        => $request->title,
            'description'  => $request->description,
            'scheduled_at' => $request->scheduled_at,
            'duration'     => $request->duration,
            'created_by'   => $request->created_by,
        ]);

        // ✅ Default to 1 section if num_sections not provided
        $numSections = $request->num_sections ?? 1;

        // ✅ Create Sections (Ensuring `title` is set)
        for ($i = 1; $i <= $numSections; $i++) {
            ExamSection::create([
                'uuid'        => Str::uuid(),
                'exam_id'     => $exam->id,
                'title'       => "Section $i",           // ✅ This ensures title is always set
                'description' => null,
                'duration'    => null,
                'created_by'  => $request->created_by,
            ]);
        }

        Log::info('Exam created with sections', ['exam_id' => $exam->id]);

        return response()->json([
            'message' => 'Exam created successfully with sections',
            'exam' => $exam->load('sections'),
        ], 201);
    });
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
}