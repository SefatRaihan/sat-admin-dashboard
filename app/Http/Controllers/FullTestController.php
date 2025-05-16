<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullTestController extends Controller
{
    public function index()
    {
        return view('backend.fulltest.index');
    }

    public function create()
    {
        $exams = Exam::with(['sections', 'questions', 'userAttempt'])->where('status', 'active')->paginate(12);
        // dd($exams);
        $examIds = $exams->pluck('id'); // Get all exam IDs in current page
        $attempts = ExamAttempt::where('user_id', Auth::user()->id)
                ->whereIn('exam_id', $examIds)
                ->get()
                ->groupBy('exam_id'); // Grouped by exam ID for easy lookup


        $attemptedExamId = $attempts->where('status', 'completed')->pluck('exam_id')->toArray();
        $unattemptedExamId = $attempts->where('status', 'paused')->pluck('exam_id')->toArray();
        
        $attemptedExams = $exams->whereIn('id', $attemptedExamId);
        $unattemptedExams = $exams->whereIn('id', $unattemptedExamId);

        // $unattemptedExams = $exams->reject(function ($exam) use ($attempts) {
        //     return $attempts->has($exam->id) && $attempts[$exam->id]->contains('status', 'completed');
        // });
        
        return view('backend.fulltest.create', compact('exams', 'attemptedExams', 'unattemptedExams'));
    }

    public function results($id)
    {
        // dd($id);
        // $exam = Exam::with(['sections', 'questions', 'userAttempt'])->find($id);
        // dd($exam);
        $examAttempt = ExamAttempt::where('user_id', Auth::user()->id)
            ->where('exam_id', $id)
            ->where('status', 'completed')
            ->first();

   
        $examAttemptQuestions = $examAttempt->questions()->with(['question'])->get();
        $examAttemptQuestions->each(function ($question) {
            $question->is_correct = $question->is_correct ? 'Correct' : 'Incorrect';
            $question->student_answer = $question->student_answer ?? 'Not Attempted';
        });

        return view('backend.fulltest.results', compact('exam', 'examAttempt', 'examAttemptQuestions'));
    }
}
