<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{

    public function openExam($examId)
    {
        // dd($examId);
        $exam = Exam::with(['questions', 'sections'])->find($examId);
        return view('backend.student-exam.open-exam', compact('exam'));
    }

    public function index()
    {
        return view('backend.student-exam.index');
    }

    public function create()
    {
        $data = [
            "bangla" => [
                "question1" => [
                    "id" => 1,
                    "context" => "প্রশ্ন ১ এর বিষয়বস্তু",
                    "question" => "প্রশ্ন ১",
                    "options" => [
                        "option1" => "অপশন ১",
                        "option2" => "অপশন ২",
                        "option3" => "অপশন ৩",
                        "option4" => "অপশন ৪"
                    ],
                    "answer" => "অপশন ১"
                ],
                "question2" => [
                    "id" => 2,
                    "context" => "প্রশ্ন ২ এর বিষয়বস্তু",
                    "question" => "প্রশ্ন ২",
                    "options" => [
                        "option1" => "অপশন ১",
                        "option2" => "অপশন ২",
                        "option3" => "অপশন ৩",
                        "option4" => "অপশন ৪"
                    ],
                    "answer" => "অপশন ২"
                ]
            ],
            "english" => [
                "question1" => [
                    "id" => 3,
                    "context" => "Content of Question 1",
                    "question" => "Question 1",
                    "options" => [
                        "option1" => "Option 1",
                        "option2" => "Option 2",
                        "option3" => "Option 3",
                        "option4" => "Option 4"
                    ],
                    "answer" => "Option 1"
                ],
                "question2" => [
                    "id" => 4,
                    "context" => "Content of Question 2",
                    "question" => "Question 2",
                    "options" => [
                        "option1" => "Option 1",
                        "option2" => "Option 2",
                        "option3" => "Option 3",
                        "option4" => "Option 4"
                    ],
                    "answer" => "Option 2"
                ]
            ]
        ];
        
        
        return view('backend.student-exam.create', compact('data'));
    }

    public function store(Request $request)
    {
        dd($request->all());

        return redirect()->route('student-exams.index')->with('success', 'Exam submitted successfully!');
    }

    public function histories()
    {
        return view('backend.student-exam.histories');
    }
}
