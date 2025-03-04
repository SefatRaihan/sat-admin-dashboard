<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('backend.exams.index');
    }

    public function create()
    {
        return view('backend.exams.create');
    }
}
