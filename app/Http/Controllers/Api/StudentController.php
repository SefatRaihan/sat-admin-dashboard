<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\Audience;
use App\Models\ExamAttempt;
use App\Models\StudentHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Models\StudentNotification;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

class StudentController extends Controller
{
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
        'getCourseLessons' => 'Get Course Lessons',
        'markComplete' => 'Mark Complete',
        'getCourseProgress' => 'Get Course Progress',
    ];

    public function index(Request $request)
    {
        $query = Student::query()->with('audiences');

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
                $query->whereHas('audiences', function ($q) {
                    $q->where('audience', 'SAT 2');
                });
            }
            if (in_array('All-SAT-1', $audiences)) {
                $query->whereHas('audiences', function ($q) {
                    $q->whereIn('audience', ['High School', 'College', 'Graduate']);
                });
            }
            $query->whereHas('audiences', function ($q) use ($audiences) {
                $validAudiences = array_intersect($audiences, ['High School', 'College', 'Graduate', 'SAT 2']);
                if (!empty($validAudiences)) {
                    $q->whereIn('audience', $validAudiences);
                }
            });
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
            $student->audience = $student->audiences->pluck('audience')->implode(', ');
            $student->photo_url = $student->image
                ? asset('storage/' . $student->image)
                : asset('image/default-avatar.png');
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'audience' => 'required|array',
            'audience.*' => 'in:High School,College,Graduate,SAT 2',
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

        DB::beginTransaction();

        try {
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('student_photos', 'public');
            }

            $ipAddress = getHostByName(getHostName());
            $role = Role::where('slug', 'student')->first();

            // Create User
            $user = User::create([
                'uuid' => Str::uuid(),
                'first_name' => $request->name,
                'last_name' => null,
                'full_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'active_role_id' => $role->id,
                'is_active' => true,
                'ip_address' => $ipAddress,
                'last_login' => now(),
                'profile_image' => $photoPath,
            ]);

            $latestStudent = Student::latest('id')->first();
            $nextCoded = $latestStudent && preg_match('/SID(\d+)/', $latestStudent->student_code, $matches)
                ? (int)$matches[1] + 1
                : 1;
            $studentCode = 'SID' . str_pad($nextCoded, 4, '0', STR_PAD_LEFT);

            // Create Student
            $student = Student::create([
                'uuid' => Str::uuid(),
                'student_code' => $studentCode,
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'package' => $request->package,
                'duration' => $request->duration,
                'image' => $photoPath,
                'created_by' => Auth::id(),
            ]);

            // Attach audiences
            $student->audiences()->attach($request->audience);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $student
            ], 201);
        } catch (\Exception | QueryException $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    public function show(Student $student)
    {
        $student->load('audiences', 'histories');
        $student->audience = $student->audiences->pluck('audience')->implode(', ');
        return response()->json([
            'status' => true,
            'data' => $student
        ], 200);
    }

    public function update(Request $request, $uuid)
    {
        $student = Student::where('uuid', $uuid)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'audience' => 'required|array',
            'audience.*' => 'in:High School,College,Graduate,SAT 2',
            'package' => 'required|string',
            'duration' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $student->user_id],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $photoPath = $student->image;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('student_photos', 'public');
            }

            // Log changes
            $changes = [];
            $fields = ['name', 'email', 'phone', 'gender', 'date_of_birth', 'package', 'duration'];
            foreach ($fields as $field) {
                if ($request->$field !== $student->$field) {
                    $changes[] = [
                        'student_uuid' => $student->uuid,
                        'field' => $field,
                        'old_value' => $student->$field,
                        'new_value' => $request->$field,
                        'changed_by' => Auth::id(),
                    ];
                }
            }

            // Update student
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'package' => $request->package,
                'duration' => $request->duration,
                'image' => $photoPath,
                'updated_by' => Auth::id(),
            ]);

            // Update user
            $user = $student->user;
            $user->update([
                'first_name' => $request->name,
                'full_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_image' => $photoPath,
            ]);

            // Sync audiences
            $student->audiences()->sync($request->audience);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $student
            ], 200);
        } catch (\Exception | QueryException $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Student $student)
    {
        try {
            StudentHistory::create([
                'student_uuid' => $student->uuid,
                'field' => 'status',
                'old_value' => $student->status,
                'new_value' => 'deleted',
                'changed_by' => Auth::id(),
            ]);
            $student->audiences()->detach();
            $student->user()->delete();
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
        try {
            $students = Student::whereIn('uuid', $request->students)->get();
            foreach ($students as $student) {
                StudentHistory::create([
                    'student_uuid' => $student->uuid,
                    'field' => 'status',
                    'old_value' => $student->status,
                    'new_value' => 'deleted',
                    'changed_by' => Auth::id(),
                ]);
                $student->audiences()->detach();
                $student->user()->delete();
                $student->delete();
            }
            return response()->json([
                'status' => true,
                'message' => 'Students deleted successfully'
            ]);
        } catch (\Exception | QueryException $e) {
            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    public function deactivate(Request $request)
    {
        try {
            $students = Student::whereIn('uuid', $request->students)->get();
            foreach ($students as $student) {
                StudentHistory::create([
                    'student_uuid' => $student->uuid,
                    'field' => 'status',
                    'old_value' => $student->status,
                    'new_value' => 'inactive',
                    'changed_by' => Auth::id(),
                ]);
                $student->status = 'inactive';
                $student->save();
            }
            return response()->json([
                'status' => true,
                'message' => 'Students deactivated successfully'
            ]);
        } catch (\Exception | QueryException $e) {
            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

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

        try {
            foreach ($request->students as $studentId) {
                StudentNotification::create([
                    'uuid' => Str::uuid(),
                    'student_id' => $studentId,
                    'title' => $request->title,
                    'description' => $request->description,
                    'date' => $request->date,
                    'time' => $request->time,
                ]);
                StudentHistory::create([
                    'student_uuid' => $studentId,
                    'field' => 'notification',
                    'old_value' => null,
                    'new_value' => json_encode([
                        'title' => $request->title,
                        'description' => $request->description,
                        'date' => $request->date,
                        'time' => $request->time,
                    ]),
                    'changed_by' => Auth::id(),
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Notification sent successfully!',
            ]);
        } catch (\Exception | QueryException $e) {
            return response()->json([
                'status' => 'error',
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
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
        try {
            $student = Student::where('uuid', $request->uuid)->firstOrFail();
            StudentHistory::create([
                'student_uuid' => $student->uuid,
                'field' => 'status',
                'old_value' => $student->status,
                'new_value' => $request->status,
                'changed_by' => Auth::id(),
            ]);
            $student->status = $request->status;
            $student->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } catch (\Exception | QueryException $e) {
            return response()->json([
                'success' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    public function history(Request $request)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        $histories = StudentHistory::where('student_uuid', $student->uuid)
            ->orderBy('created_at', $request->input('sortOrder', 'desc'))
            ->paginate($request->input('per_page', 10));

        $histories->getCollection()->transform(function ($history) {
            if ($history->field === 'audience' || $history->field === 'notification') {
                $history->old_value = $history->old_value ? json_decode($history->old_value, true) : null;
                $history->new_value = $history->new_value ? json_decode($history->new_value, true) : null;
            }
            return $history;
        });

        return response()->json([
            'status' => 'success',
            'data' => $histories->items(),
            'meta' => [
                'current_page' => $histories->currentPage(),
                'last_page' => $histories->lastPage(),
                'per_page' => $histories->perPage(),
                'total' => $histories->total(),
                'from' => $histories->firstItem(),
                'to' => $histories->lastItem(),
            ]
        ]);
    }

    public function getCourseLessons($courseId, $chapterId, $lessonId)
    {
        try {
            $user = Auth::user();
            $lesson = Lesson::findOrFail($lessonId);
            $course = Course::findOrFail($courseId);

            $lessonUser = LessonUser::where('user_id', $user->id)
                ->where('lesson_id', $lesson->id)
                ->where('course_id', $course->id)
                ->where('chapter_id', $chapterId)
                ->first();

            return response()->json([
                'status' => 'success',
                'lessonUser' => $lessonUser
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCourseProgress($courseId)
    {
        try {
            $user = Auth::user();
            $course = Course::findOrFail($courseId);
            
            $totalLessons = $course->total_lesson;
            $completedLessons = $user->lessons()
                ->wherePivot('course_id', $course->id)
                ->whereNotNull('completed_at')
                ->count();

            $progress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

            return response()->json([
                'status' => 'success',
                'progress' => $progress
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}