<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamSection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams based on filters.
     * Possible filters: active, inactive, all
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'active'); // Default to active exams

        if ($filter === 'inactive') {
            $exams = Exam::onlyTrashed()->get();
        } elseif ($filter === 'all') {
            $exams = Exam::withTrashed()->get();
        } else {
            $exams = Exam::all(); // Active exams
        }

        return response()->json($exams, Response::HTTP_OK);
    }

    /**
     * Store a newly created exam in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'scheduled_at' => 'required|date',
        'duration' => 'required|integer|min:1',
        'created_by' => 'required|integer|exists:users,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Create the exam
    $exam = Exam::create([
        'title' => $request->title,
        'description' => $request->description,
        'scheduled_at' => $request->scheduled_at,
        'duration' => $request->duration,
        'created_by' => $request->created_by,
    ]);

    // Automatically create a default section
    $defaultSection = ExamSection::create([
        'exam_id' => $exam->id,
        'title' => 'Default Section', // You can change this title
        'description' => 'This is an auto-generated section for the exam.',
        'duration' => $request->duration, // Set section duration same as exam by default
        'created_by' => $request->created_by,
    ]);

    return response()->json([
        'message' => 'Exam created successfully with a default section.',
        'exam' => $exam,
        'section' => $defaultSection
    ], 201);
}


    /**
     * Display the specified exam.
     */
    public function show(Exam $exam)
    {
        return response()->json($exam, Response::HTTP_OK);
    }

    /**
     * Update the specified exam in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'duration' => 'sometimes|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $exam->update(array_merge($request->all(), ['updated_by' => auth()->id()]));

        return response()->json($exam, Response::HTTP_OK);
    }

    /**
     * Soft delete the specified exam.
     */
    public function destroy(Exam $exam)
    {
        $exam->update(['deleted_by' => auth()->id()]);
        $exam->delete();

        return response()->json(['message' => 'Exam soft deleted successfully'], Response::HTTP_OK);
    }

    /**
     * Restore a soft deleted exam.
     */
    public function restore($id)
    {
        $exam = Exam::withTrashed()->find($id);

        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], Response::HTTP_NOT_FOUND);
        }

        $exam->restore();

        return response()->json(['message' => 'Exam restored successfully', 'exam' => $exam], Response::HTTP_OK);
    }

    public function toggleStatus($id)
    {
        $exam = Exam::find($id);

        if (!$exam) {
            return response()->json(['message' => 'Exam not found'], 404);
        }

        // Toggle between active/inactive
        $exam->status = $exam->status === 'active' ? 'inactive' : 'active';
        $exam->save();

        return response()->json([
            'message' => 'Exam status updated successfully',
            'exam' => $exam
        ], 200);
    }


}
