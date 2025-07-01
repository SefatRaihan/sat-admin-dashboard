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
use App\Models\Notification;

class NotificationController extends Controller
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
        'delete' => 'Delete Multiple Notifications'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Notification::whereIn('id', $request->notifications)->delete();
        return response()->json(['message' => 'Notification deleted successfully']);
    }


    //another methods
}
