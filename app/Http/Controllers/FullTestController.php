<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class FullTestController extends Controller
{
    public function index()
    {
        return view('backend.fulltest.index');
    }

    public function create()
    {
        $exams = Exam::with(['sections', 'questions'])->where('status', 'active')->get();
        ExamAttempt::find($exams->id)->get();
        // dd($exams);.
        
        return view('backend.fulltest.create', compact('exams'));
    }

    public function results()
    {
        return view('backend.fulltest.results');
    }
}
