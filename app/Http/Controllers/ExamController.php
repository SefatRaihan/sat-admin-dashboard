<?php

namespace App\Http\Controllers;

use App\Models\Exam;
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

    public function show($id)
    {
        // Fetch exam data from the database
        $exam = Exam::with('sections')->find($id);

        if (!$exam) {
            return abort(404, "Exam not found");
        }

        // Pass data to the Blade view
        return view('backend.exams.create', compact('exam'));
    }
}
