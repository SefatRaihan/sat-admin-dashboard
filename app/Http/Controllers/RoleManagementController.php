<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index()
    {
        return view('backend.role-managements.index');
    }

    public function create()
    {
        return view('backend.role-managements.create');
    }
}
