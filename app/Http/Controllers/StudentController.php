<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StudentNotification;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('backend.students.index');
    }

    public function create()
    {
        return view('backend.students.create');
    }

    public function studentProfile()
    {
        return view('backend.students.profile');
    }
}
