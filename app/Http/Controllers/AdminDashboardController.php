<?php

namespace App\Http\Controllers;


class AdminDashboardController extends Controller
{
    public static $visiblePermissions = [
        'adminDashboard' => 'Admin Dashboard'
    ];

    public function adminDashboard()
    {
        return view('backend.admin.dashboard');
    }
}