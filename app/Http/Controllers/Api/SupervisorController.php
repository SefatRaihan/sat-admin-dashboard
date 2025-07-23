<?php

namespace App\Http\Controllers\Api;

use App\Models\Supervisor;
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
use App\Exports\SupervisorsExport;
use App\Models\SupervisorNotification;
use Illuminate\Support\Facades\Notification;

class SupervisorController extends Controller
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
        'delete' => 'Delete Multiple Supervisors',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Supervisor::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Role filter
        if ($request->filled('role')) {
            $roles = explode(',', $request->role);
            $query->whereIn('role_name', $roles);
        }

        // Status filter
        if ($request->filled('status')) {
            $status = explode(',', $request->status);
            $query->whereIn('status', $status);
        }

        // Sorting
        if ($request->filled('sort')) {
            $sort = $request->sort == 'Oldest' ? 'asc' : 'desc';
            $query->orderBy('created_at', $sort);
        }

        $supervisors = $query->latest()->paginate($request->input('per_page', 10));

        $totalSupervisor = Supervisor::count();

        return response()->json([
            'supervisors' => $supervisors,
            'totalSupervisor' => $totalSupervisor
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'status' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction(); // Start Transaction

        try {

            $ipAddress = getHostByName(getHostName());
            $role = Role::where('slug', 'supervisor')->first();

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
                'last_login'        => now()
            ]);


            $supervisorRole = Role::where('slug', $request->role)->first();
            // Create Supervisor
            $supervisor = Supervisor::create([
                'uuid'          => Str::uuid(),
                'user_id'       => $user->id,
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'role_id'       => $supervisorRole->id,
                'role_name'     => $request->role,
                'status'        => $request->status,
            ]);

            DB::commit(); // Commit Transaction

            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $supervisor
            ], 201);

        } catch (\Exception | QueryException $e) {
            DB::rollBack(); // Rollback on Error

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Supervisor $supervisor)
    {
         return response()->json([
            'status' => true,
            'data' => $supervisor
         ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction(); // Start Transaction

        try {
            $supervisor = Supervisor::where('uuid', $uuid)->first();
            $supervisorRole = Role::where('slug', $request->role)->first();

            $supervisor->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'role_id'       => $supervisorRole->id,
                'role_name'     => $request->role,
                'status'        => $request->status,
            ]);

            DB::commit(); // Commit Transaction

            //handle relationship update
            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $supervisor
            ], 200);
        } catch (\Exception | QueryException $e) {
            DB::rollBack(); // Rollback on Error

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Supervisor $supervisor)
    {
        try {

            $supervisor->delete();

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
        Supervisor::whereIn('uuid', $request->supervisors)->delete();
        return response()->json(['message' => 'Supervisors deleted successfully']);
    }
    //another methods
}
