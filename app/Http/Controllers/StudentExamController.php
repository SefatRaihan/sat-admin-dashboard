<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ExamAttemptQuestion;

class StudentExamController extends Controller
{

    public function openExam($examId)
    {
        // dd($examId);
        $exam = Exam::with(['questions', 'sections'])->find($examId);
        return view('backend.student-exam.open-exam', compact('exam'));
    }

    public function startExam(Request $request, $examId)
    {
        // dd($examId);
        $exam = Exam::with(['questions', 'sections'])->find($examId);

        $userId = auth()->id();
        $ip = $request->ip();
        $device = $request->header('User-Agent');
        $durationSeconds = $exam->duration * 60;

        $examAttempt = ExamAttempt::where('user_id', $userId)
            ->where('exam_id', $exam->id)
            ->where('status', 'in_progress')
            ->first();

        $metadata = [
            'exam_name'       => $exam->name,
            'total_questions' => $exam->questions->count(),
            'total_duration'  => $exam->duration,
            'scheduled_at'    => $exam->scheduled_at,
        ];

        // Retake logic
        if ($request->has('retake') && $examAttempt) {
            $examAttempt->increment('attempt_number');
            $examAttempt->update([
                'status'         => 'in_progress',
                'remaining_time' => $durationSeconds,
                'answers'        => null,
                'metadata'       => $metadata,
            ]);
        }

        // If no in-progress attempt exists (or after retake reset), create new attempt
        if (!$examAttempt) {
            $examAttempt = ExamAttempt::create([
                'uuid'           => Str::uuid(),
                'exam_id'        => $exam->id,
                'user_id'        => $userId,
                'ip_address'     => $ip,
                'start_time'     => now(),
                'device_info'    => $device,
                'status'         => 'in_progress',
                'remaining_time' => $durationSeconds,
                'metadata'       => $metadata,
            ]);
        }


        $questions = $exam->questions->groupBy('sat_question_type');
        // ->map(function ($group) {
        //     return $group->groupBy('sat_question_type');
        // });
        // dd($nestedGrouped);
        return view('backend.student-exam.create', compact('exam', 'questions', 'examAttempt'));
    }

    public function index()
    {
        return view('backend.student-exam.index');
    }


    public function update(Request $request, $examAttemptId)
    {
        // dd($examAttemptId);
        DB::beginTransaction();
           $attempt = ExamAttempt::where('id', $examAttemptId)
                ->where('user_id', auth()->id())
                ->where('status', 'in_progress')
                ->first();

            $responses = collect($request->responses);

            // Count correct answers
            $correctCount = $responses->where('is_correct', 1)->count();
            $inCorrectCount = $responses->where('is_correct', 0)->count();

            $answers = collect($request->responses)->mapWithKeys(function ($item) {
                return [$item['question_id'] => $item['answer']];
            });

       
            foreach ($responses as $response) {
                ExamAttemptQuestion::create([
                    'uuid'           => Str::uuid(),
                    'attempt_id'     => $attempt->id,
                    'question_id'    => $response['question_id'],
                    'student_answer' => $response['answer'],
                    'is_correct'     => $response['is_correct'],
                    'time_spent'     => $response['time_spent'] ?? null, // Optional if tracked
                ]);
            }

            $attempt->update([
                'answers'         => $answers,
                'status'          => 'completed',
                'score'           => $correctCount,
                'correct_answers' => $correctCount,
                'wrong_answers'   => $inCorrectCount,
                'end_time'        => now(),
            ]);

        DB::commit();
        return response()->json(['msg' => 'Exam submitted successfully!', 'data' => $attempt], 201);
    }

    public function histories()
    {
        return view('backend.student-exam.histories');
    }
}
