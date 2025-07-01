<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public static $visiblePermissions = [
        'dashboard' => 'Dashboard'
    ];

    public function dashboard()
    {
        $user = User::where('id', auth()->user()->id)->first();


        if($user->active_role_id == 4){
            return view('student-dashboard');
        } else {
            return view('dashboard');
        }
    }
}
