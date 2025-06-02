<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptQuestion;
use App\Models\Exam;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StudentNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        $user = auth()->user();
        return view('backend.students.profile', compact('user'));
    }

    public function checkout()
    {
        return view('backend.students.checkout');
    }

    public function explanation($examAttemptId, $questionId = null)
    {
        $examAttempt = ExamAttempt::with(['exam.questions', 'exam.sections'])->findOrFail($examAttemptId);
        $exam = $examAttempt->exam;
        $userId = Auth::id();

        if ($examAttempt->user_id !== $userId) {
            abort(403, 'Unauthorized access to exam attempt.');
        }

        // Fetch all questions with their attempt details
        $questions = $exam->questions->map(function ($question) use ($examAttempt) {
            $attemptQuestion = ExamAttemptQuestion::where('attempt_id', $examAttempt->id)
                ->where('question_id', $question->id)
                ->first();

            return [
                'id' => $question->id,
                'question_title' => $question->question_title,
                'question_description' => $question->question_description,
                'options' => $question->options,
                'correct_answer' => $question->correct_answer,
                'explanation' => $question->explanation,
                'sat_question_type' => $question->sat_question_type,
                'difficulty' => $question->difficulty,
                'is_correct' => $attemptQuestion ? $attemptQuestion->is_correct : false,
                'time_spent' => $attemptQuestion ? $attemptQuestion->time_spent : 0,
                'student_answer' => $attemptQuestion ? $attemptQuestion->student_answer : null,
                'section' => $examAttempt->exam?->section
            ];
        })->groupBy('sat_question_type');

        $flatQuestions = $questions->flatten(1)->values();

        $metadata = [
            'exam_name' => $exam->name,
            'total_questions' => $exam->questions->count(),
            'total_duration' => $exam->duration,
            'scheduled_at' => $exam->scheduled_at,
        ];

        return view('backend.students.explanation', compact('exam', 'questions', 'examAttempt', 'flatQuestions', 'questionId'));
    }
}
