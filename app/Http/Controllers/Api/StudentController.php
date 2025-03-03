<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Models\StudentNotification;
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
    
        return response()->json($students);
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
            'students.*' => 'exists:students,id',
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
                'student_id' => $studentId,
                'title' => $request->title,
                'description' => $request->description,
                'schedule_date' => $request->date,
                'schedule_time' => $request->time,
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
    

    //another methods
}
