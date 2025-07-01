<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form',
        'allResult' => 'All Result',
        'ranking' => 'Ranking',
    ];

    public function index()
    {
        $exams = Exam::with('createdBy')
        ->select('created_by') // Select only the created_by column
        ->distinct()           // Get unique created_by values
        ->get();

        return view('backend.exams.index', compact('exams'));
    }

    public function create()
    {
        $exams = Exam::with('createdBy')
        ->select('created_by') // Select only the created_by column
        ->distinct()           // Get unique created_by values
        ->get();

        return view('backend.exams.create' , compact('exams'));
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

    public function edit($id)
    {
        // Fetch exam data from the database
        $exam = Exam::with([
            'sections' => function ($query) {
                $query->with('questions');
            }
        ])->find($id);

        // dd($exam);
        if (!$exam) {
            return abort(404, "Exam not found");
        }

        // Pass data to the Blade view
        return view('backend.exams.edit', compact('exam'));
    }

    public function allResult()
    {
        return view('backend.exams.all-result');
    }

    public function ranking()
    {
        $exams = Exam::with('createdBy')
        ->select('created_by') // Select only the created_by column
        ->distinct()           // Get unique created_by values
        ->get();

        return view('backend.exams.ranking', compact('exams'));
    }
}
