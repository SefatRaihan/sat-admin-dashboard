<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FullTestController extends Controller
{
    public function index()
    {
        return view('backend.fulltest.index');
    }

    public function create()
    {
        $exams = Exam::with(['sections', 'questions', 'userAttempt'])
            ->where('status', 'active')
            ->paginate(12);


        $allExamIds = Exam::where('status', 'active')->pluck('id');

        $attempts = ExamAttempt::where('user_id', Auth::id())
            ->whereIn('exam_id', $allExamIds)
            ->get()
            ->groupBy('exam_id');

        $flatAttempts = $attempts->flatten(1);

        $attemptedExamIds = $flatAttempts
            ->where('status', 'completed')
            ->pluck('exam_id')
            ->unique();

        $unattemptedExams = Exam::where('status', 'active')
            ->whereNotIn('id', $attemptedExamIds)
            ->paginate(12);

        $attemptedExams = $exams->whereIn('id', $attemptedExamIds);
        
        
        $allExamCount = $allExamIds->count();
        $attemptedCount = $attemptedExamIds->count();
        $unattemptedCount = $allExamIds->diff($attemptedExamIds)->count();

        // dd($exams, $attemptedExams, $unattemptedExams);
        return view('backend.fulltest.create', compact(
            'exams', 
            'attemptedExams', 
            'unattemptedExams', 
            'allExamCount',
            'attemptedCount',
            'unattemptedCount'
        ));
    }

    public function results($id)
    {

       $scoreData = self::getExamScore($id, auth()->id());


        $leadBoard = $scoreData['leadBoard'];
        $examAttempt = $scoreData['examAttempt'];
        $examAttemptQuestions = $scoreData['examAttemptQuestions'];
        $percentCorrect = $scoreData['percentCorrect'];
        $correctAnswers = $scoreData['correctAnswers'];
        $totalQuestions = $scoreData['totalQuestions'];
        $averagePaceFormatted = $scoreData['averagePaceFormatted'];
        $totalTimeFormatted = $scoreData['totalTimeFormatted'];
        $betterThanPercent = $scoreData['betterThanPercent'];
        
        // Update each question display status
        $examAttemptQuestions->each(function ($question) {
            $question->is_correct = $question->is_correct ? 'Correct' : 'Incorrect';
            $question->student_answer = $question->student_answer ?? 'Not Attempted';
        });

        return view('backend.fulltest.results', compact(
            'leadBoard',
            'examAttempt',
            'examAttemptQuestions',
            'percentCorrect',
            'correctAnswers',
            'totalQuestions',
            'averagePaceFormatted',
            'totalTimeFormatted',
            'betterThanPercent',
        ));
    }


    public function otherExamScore(Request $request)
    {     
        $userId = $request->query('user_id');
        $examId = $request->query('exam_id');
        $attemptedExam = ExamAttempt::where('exam_id', $examId)
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->orderByDesc('score')
            ->orderByRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) ASC')
            ->firstOrFail();


        $scoreData = self::getExamScore($attemptedExam->id, $userId);

        $averagePaceFormatted = $scoreData['averagePaceFormatted'];
        $totalTimeFormatted = $scoreData['totalTimeFormatted'];
    
        return response()->json([
            'averagePaceFormatted' => $averagePaceFormatted,
            'totalTimeFormatted' => $totalTimeFormatted
        ],200);
    }

    private static function getExamScore($attemptId, $userId)
    {
        $examAttempt = ExamAttempt::where('id', $attemptId)
                        ->where('status', 'completed')
                        ->where('user_id', $userId)
                        ->firstOrFail();

        $examAttemptQuestions = $examAttempt->examAttemptQuestions()->with(['question'])->get();

        // Calculate total questions
        $totalQuestions = $examAttemptQuestions->count();

        // Calculate correct answers
        $correctAnswers = $examAttemptQuestions->where('is_correct', true)->count();

        // Calculate percent correct
        $percentCorrect = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;

        // Sum total time spent (assuming each question_attempt has a 'time_spent' column in seconds)
        $totalTimeSpent = $examAttemptQuestions->sum('time_spent');

        // Average pace per question
        $averagePaceSeconds = $totalQuestions > 0 ? round($totalTimeSpent / $totalQuestions) : 0;

        // Format times
        $formatTime = function ($seconds) {
            $minutes = floor($seconds / 60);
            $secs = $seconds % 60;
            return sprintf("%d:%02d", $minutes, $secs);
        };

        // Exam LeadBoard
        $leadBoard =  ExamAttempt::where('exam_id', $examAttempt->exam_id)
                ->where('status', 'completed')
                ->where('correct_answers', '>', 0)
                ->orderByDesc('correct_answers')
                ->orderByRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) ASC')
                ->with('user')
                ->limit(5)
                ->get()
                ->map(function ($attempt) {
                    $durationInSeconds = strtotime($attempt->end_time) - strtotime($attempt->start_time);
                    $minutes = floor($durationInSeconds / 60);
                    $seconds = $durationInSeconds % 60;
                    $totalQ = $attempt->count();
                    $percentCorrect = $totalQ > 0 ? round(($attempt->correct_answers / $totalQ) * 100) : 0;
                    return [
                        'user_id' => $attempt->user->id ?? 'N/A',
                        'user_name' => $attempt->user->student->name ?? 'N/A',
                        'score' => $percentCorrect,
                        'time' => sprintf("%d:%02d", $minutes, $seconds),
                        'submitted_at' => $attempt->end_time,
                        'profile_image' => $attempt->user->student->image 
                                ? Storage::disk('public')->url($attempt->user->student->image) 
                                : asset('images/default-avatar.png'),
                    ];
                });

        // Calculate the percentage of other users who scored less than the current user
        $currentUserScore = $examAttempt->correct_answers;
        $otherAttempts = \App\Models\ExamAttempt::where('exam_id', $examAttempt->exam_id)
            ->where('user_id', '!=', auth()->id())
            ->where('status', 'completed')
            ->get();

        $totalOthers = $otherAttempts->count();
        $scoredLess = $otherAttempts->where('correct_answers', '<', $currentUserScore)->count();

        $betterThanPercent = $totalOthers > 0 ? round(($scoredLess / $totalOthers) * 100) : 0;

        return [
            'leadBoard' => $leadBoard,
            'examAttempt' => $examAttempt,
            'examAttemptQuestions' => $examAttemptQuestions,
            'percentCorrect' => $percentCorrect,
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => $totalQuestions,
            'averagePaceFormatted' => $formatTime($averagePaceSeconds),
            'totalTimeFormatted' => $formatTime($totalTimeSpent),
            'betterThanPercent' => $betterThanPercent,
        ];
    }

    public function examDetails(Exam $exam)
    {
        // Fetch all the related info needed for modal, e.g.:
        $leaderboard = $exam->examAttempts()
            ->with('user')
            ->orderByDesc('score')
            ->limit(10)
            ->get()
            ->map(function($attempt) {
                return [
                    'name'       => $attempt->user->name,
                    'score'      => $attempt->score,
                    'avatar_url' => $attempt->user->avatar_url ?? asset('image/profile.jpeg'),
                ];
            });

        return response()->json([
            'data' => [
                'title'            => $exam->title,
                'audience'         => 'Hi School',  // customize as needed
                'sections_count'   => $exam->sections()->count(),
                'total_questions'  => $exam->questions()->count(),
                'score'            => 75,            // or calculate user's score
                'student_name'     => auth()->user()->name,
                'correct_answers'  => 60,            // calculate accordingly
                'percent_correct'  => '75%',
                'total_time'       => '0:10',
                'others_average_time' => '0:45',
                'leaderboard'      => $leaderboard,
            ]
        ]);
    }
}
