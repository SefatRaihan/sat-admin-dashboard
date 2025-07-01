<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form'
    ];

    public function index()
    {
        return view('backend.supervisors.index');
    }

    public function create()
    {
        return view('backend.supervisors.create');
    }
}
