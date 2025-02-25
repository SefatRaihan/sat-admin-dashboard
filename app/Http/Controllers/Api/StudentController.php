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
    public function index()
    {
        $students = Student::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $students
        ], 200);
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
    
            // Create Student
            $student = Student::create([
                'uuid'          => Str::uuid(),
                'user_id'       => $user->id,
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'gender'        => $request->gender,
                'date_of_birth' => $request->date_of_birth,
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
    public function update(Request $request, Student $student)
    {
        try {
            $student->update($request->all());
            //handle relationship update
            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $student
            ], 200);
        } catch (\Exception | QueryException $e) {
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
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

//another methods
}
