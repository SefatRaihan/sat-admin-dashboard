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

class RoleManagementController extends Controller
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
    public function delete(Request $request)
    {
        Role::whereIn('uuid', $request->roles)->delete();
        return response()->json(['message' => 'Roles deleted successfully']);
    }

    public function activate(Request $request)
    {
        Role::whereIn('uuid', $request->roles)->update(['status' => 'active']);
        return response()->json(['message' => 'Roles activated successfully']);
    }

    public function deactivate(Request $request)
    {
        Role::whereIn('uuid', $request->roles)->update(['status' => 'inactive']);
        return response()->json(['message' => 'Roles deactivated successfully']);
    }

    public function updateStatus(Request $request)
    {
        $role = Role::where('uuid', $request->uuid)->first();
        
        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found']);
        }
    
        $role->status = $request->status;
        $role->save();
    
        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
    

    //another methods
}
