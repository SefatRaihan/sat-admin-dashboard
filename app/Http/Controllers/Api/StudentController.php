<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\ExamAttempt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Models\StudentNotification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class StudentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Response status code
    |--------------------------------------------------------------------------
    | 201 response with created data
    | 200 update/list/show/delete
    | 204 deleted response with no content
    | 500 internal server or db error
    */

    public static $visiblePermissions = [
        'index' => 'List',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'delete' => 'Delete Multiple Students',
        'deactivate' => 'Deactivate Students',
        'sendNotification' => 'Send Notification',
        'exportExcel' => 'Export Excel',
        'updateStatus' => 'Update Student Status',
        'history' => 'Student History',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Date range filter
        if ($request->filled('create_from') && $request->filled('create_to')) {
            $query->whereBetween('created_at', [$request->create_from, $request->create_to]);
        }

        // Status filter
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Audience type filter
        if ($request->filled('audience_type')) {
            $audiences = explode(',', $request->audience_type);
            if (in_array('All-SAT-2', $audiences)) {
                $query->orWhere('audience', 'sat-2');
            }

            if (in_array('All-SAT-1', $audiences)) {
                $query->orWhereIn('audience', ['High School', 'graduate', 'college']);
            }
        }

        // Package filter
        if ($request->filled('package')) {
            $packages = explode(',', $request->package);
            $query->whereIn('package', $packages);
        }

        // Duration filter
        if ($request->filled('duration')) {
            $durations = explode(',', $request->duration);
            $query->whereIn('duration', $durations);
        }

        // Gender filter
        if ($request->filled('gender')) {
            $genders = explode(',', $request->gender);
            $query->whereIn('gender', $genders);
        }

        // Sorting
        if ($request->filled('sort')) {
            $sort = $request->sort == 'Oldest' ? 'asc' : 'desc';
            $query->orderBy('created_at', $sort);
        }

        $students = $query->latest()->paginate($request->input('per_page', 10));

        $students->getCollection()->transform(function ($student) {
            $student->photo_url = $student->image
                ? asset('storage/' . $student->image)
                : asset('image/default-avatar.png'); // Fallback Image

            // Add status switch component
            $student->status_switch = view('components.backend.layouts.elements.switch', [
                'name' => "status_{$student->id}",
                'data-uuid' => "{$student->uuid}",
                'checked' => $student->status == 'active' ? 1 : 0,
            ])->render();

            return $student;
        });

        $totalStudent = Student::count();

        return response()->json([
            'students' => $students,
            'totalStudent' => $totalStudent
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'audience' => 'required|string',
            'package' => 'required|string',
            'duration' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction(); // Start Transaction

        try {
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('student_photos', 'public');
            }

            $ipAddress = getHostByName(getHostName());
            $role = Role::where('slug', 'student')->first();

            // Create User
            $user = User::create([
                'uuid'              => Str::uuid(),
                'first_name'        => $request->name,
                'last_name'         => null,
                'full_name'         => $request->name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'password'          => Hash::make($request->password),
                'active_role_id'    => $role->id,
                'is_active'         => true,
                'ip_address'        => $ipAddress,
                'last_login'        => now(),
                'profile_image'     => $photoPath,
            ]);

            $latestStudent = Student::latest('id')->first();

            if ($latestStudent && preg_match('/SID(\d+)/', $latestStudent->student_code, $matches)) {
                $nextCoded = (int)$matches[1] + 1; // Extract numeric part and increment
            } else {
                $nextCoded = 1; // Start from 1 if no student exists
            }

            // Format student_code as SID0001, SID0002, etc.
            $studentCode = 'SID' . str_pad($nextCoded, 4, '0', STR_PAD_LEFT);


            // Create Student
            $student = Student::create([
                'uuid'          => Str::uuid(),
                'student_code'  => $studentCode,
                'user_id'       => $user->id,
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'gender'        => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'package'       => $request->package,
                'duration'      => $request->duration,
                'audience'      => $request->audience,
                'image'         => $photoPath,
            ]);

            DB::commit(); // Commit Transaction

            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $student
            ], 201);

        } catch (\Exception | QueryException $e) {
            DB::rollBack(); // Rollback on Error

            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Student $student)
    {
         return response()->json([
            'status' => true,
            'data' => $student
         ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'audience' => 'required|string',
            'package' => 'required|string',
            'duration' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction(); // Start Transaction

        try {
            $student = Student::where('uuid', $uuid)->first();

            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('student_photos', 'public');
            } else {
                $photoPath = $student->image;
            }

            $student->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'gender'        => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'package'       => $request->package,
                'duration'      => $request->duration,
                'audience'      => $request->audience,
                'image'         => $photoPath
            ]);

            DB::commit(); // Commit Transaction

            //handle relationship update
            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $student
            ], 200);
        } catch (\Exception | QueryException $e) {
            DB::rollBack(); // Rollback on Error

            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Student $student)
    {
        try {

            $student->delete();

            return response()->json([
                'status' => true,
                'message' => __('Successfully Deleted')
            ], 200);
        } catch (\Exception | QueryException $e) {
             return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        Student::whereIn('uuid', $request->students)->delete();
        return response()->json(['message' => 'Students deleted successfully']);
    }

    public function deactivate(Request $request)
    {
        Student::whereIn('uuid', $request->students)->update(['status' => 'inactive']);
        return response()->json(['message' => 'Students deactivated successfully']);
    }

    // public function sendNotification(Request $request)
    // {
    //     $students = Student::whereIn('uuid', $request->students)->get();
    //     foreach ($students as $student) {
    //         Notification::send($student, new StudentNotification("New notification"));
    //     }
    //     return response()->json(['message' => 'Notification sent successfully']);
    // }

    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'students' => 'required|array|min:1',
            'students.*' => 'exists:students,uuid',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Multiple students-এর জন্য নোটিফিকেশন তৈরি করা হবে
        foreach ($request->students as $studentId) {
            StudentNotification::create([
                'uuid'        => Str::uuid(),
                'student_id'  => $studentId,
                'title'       => $request->title,
                'description' => $request->description,
                'date'        => $request->date,
                'time'        => $request->time,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Notification sent successfully!',
        ]);
    }

    public function exportExcel($students)
    {

        if (empty($students)) {
            return response()->json(['error' => 'No students selected'], 400);
        }

        return Excel::download(new StudentsExport($students), 'students.xlsx');
    }

    public function updateStatus(Request $request)
    {
        $student = Student::where('uuid', $request->uuid)->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found']);
        }

        $student->status = $request->status;
        $student->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }


    public function history(Request $request)
    {
        $userId = Auth::id();

        // Base query for exam attempts
        $examAttempts = ExamAttempt::whereNotNull('exam_attempts.status')
            ->where('exam_attempts.user_id', $userId)
            ->join('exams', 'exam_attempts.exam_id', '=', 'exams.id')
            ->with('exam.questions')
            ->select(
                'exam_attempts.score',
                'exam_attempts.start_time',
                'exams.title',
                'exams.scheduled_at',
                'exams.section',
                'exams.duration',
                'exams.id as exam_id'
            );

        // Apply date filters based on exam_attempts start_time and end_time
        if ($request->has('crated_start_at') && $request->input('crated_start_at')) {
            $examAttempts->where('exam_attempts.start_time', '>=', $request->input('crated_start_at'));
        }

        if ($request->has('crated_end_at') && $request->input('crated_end_at')) {
            $examAttempts->where('exam_attempts.end_time', '<=', $request->input('crated_end_at'));
        }

        // Apply section filter based on sections.title (hasMany relationship with exams)
        if ($request->has('sectionSearch') && $request->input('sectionSearch')) {
            $examAttempts->whereHas('exam.sections', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('sectionSearch') . '%');
            });
        }

        // Apply question filter based on questions.question_title (via exam_attempt_questions)
        if ($request->has('questionSearch') && $request->input('questionSearch')) {
            $examAttempts->whereHas('examAttemptQuestions.question', function ($query) use ($request) {
                $query->where('question_title', 'like', '%' . $request->input('questionSearch') . '%');
            });
        }

        // Apply correct percentage filter
        if ($request->has('correct_percentage') && $request->input('correct_percentage')) {
            $examAttempts->where('exam_attempts.score', '>=', $request->input('correct_percentage'));
        }

        // Apply duration filter
        if ($request->has('duration') && is_array($request->input('duration'))) {
            $duration = $request->input('duration');
            if (isset($duration['min']) && $duration['min']) {
                $examAttempts->where('exams.duration', '>=', $duration['min']);
            }
            if (isset($duration['max']) && $duration['max']) {
                $examAttempts->where('exams.duration', '<=', $duration['max']);
            }
        }

        // Apply sorting
        $sortColumn = $request->input('sortColumn', 'exam_attempts.start_time');
        $sortOrder = $request->input('sortOrder', 'desc');
        $examAttempts->orderBy($sortColumn, $sortOrder);

        // Get exam IDs
        $examIds = $examAttempts->pluck('exam_id')->unique();

        // Fetch exams with pagination
        $exams = Exam::whereIn('id', $examIds)
            ->withCount([
                'questions',
                'examAttempts as unique_user_attempts_count' => function ($q) {
                    $q->select(DB::raw('COUNT(DISTINCT user_id)'));
                }
            ])
            ->paginate($request->input('per_page', 10));

        // Map the data
        $data = $exams->getCollection()->map(function ($exam) use ($userId) {
            $userAttempt = $exam->examAttempts()->where('user_id', $userId)->first();

            return [
                'score'                 => $exam->questions_count > 0 ? round(($userAttempt->score / $exam->questions_count) * 100, 2) : 0,
                'start_time'            => $userAttempt->start_time ?? null,
                'exam_id'               => $exam->id,
                'title'                 => $exam->title,
                'scheduled_at'          => $exam->scheduled_at,
                'section'               => $exam->section,
                'duration'              => $exam->duration,
                'total_questions'       => $exam->questions_count,
                'total_user_attempts'   => $exam->unique_user_attempts_count,
            ];
        });

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $exams->currentPage(),
                'last_page'    => $exams->lastPage(),
                'per_page'     => $exams->perPage(),
                'total'        => $exams->total(),
                'from'         => $exams->firstItem(),
                'to'           => $exams->lastItem(),
            ]
        ]);
    }

}
