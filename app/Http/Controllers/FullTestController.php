<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FullTestController extends Controller
{
    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form',
        'results' => 'Results',
        'otherExamScore' => 'Other Exam Score',
        'view_details' => 'View Details',
        'examDetails' => 'Exam Details',
        'getExamQuestions' => 'Get Exam Questions',
        'filterExamQuestions' => 'Filter Exam Questions',
        'otherStudentScore' => 'Other Student Score',
        'drillExam' => 'Drill Exam',
    ];

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
        $attemptedExam = ExamAttempt::completed()
                    ->where('exam_id', $examId)
                    ->where('user_id', $userId)
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

    public function view_details($id)
    {
        $scoreData = self::getExamScore($id, auth()->id());

        $examAttempt          = $scoreData['examAttempt'];
        $percentCorrect       = $scoreData['percentCorrect'];
        $correctAnswers       = $scoreData['correctAnswers'];
        $totalQuestions       = $scoreData['totalQuestions'];
        $averagePaceFormatted = $scoreData['averagePaceFormatted'];
        $totalTimeFormatted   = $scoreData['totalTimeFormatted'];
        $betterThanPercent    = $scoreData['betterThanPercent'];

        return response()->json([
            'examAttempt'          => $examAttempt,
            'percentCorrect'       => $percentCorrect,
            'correctAnswers'       => $correctAnswers,
            'totalQuestions'       => $totalQuestions,
            'averagePaceFormatted' => $averagePaceFormatted,
            'totalTimeFormatted'   => $totalTimeFormatted,
            'betterThanPercent'    => $betterThanPercent,
        ]);
    }

    public function examDetails($id)
    {

        $exam = Exam::find($id);
        // $totalQuestion = $exam->questions->count();
        $attemptId = ExamAttempt::completed()
                        ->where('exam_id', $id)
                        ->orderByDesc('score')
                        ->first()->id;

        $scoreData = self::getExamScore($attemptId, auth()->id());


        $previousAttempts = ExamAttempt::completed()->where('exam_id', $id)->select('id','start_time', 'exam_id')->latest()->take(5)->get();

        return response()->json([
            'leadBoard' => $scoreData['leadBoard'],
            'examAttempt' => $scoreData['examAttempt'],
            'percentCorrect' => $scoreData['percentCorrect'],
            'correctAnswers' => $scoreData['correctAnswers'],
            'totalQuestions' =>  $scoreData['totalQuestions'],
            'averagePaceFormatted' => $scoreData['averagePaceFormatted'],
            'totalTimeFormatted' => $scoreData['totalTimeFormatted'],
            'betterThanPercent' => $scoreData['betterThanPercent'],
            'previousAttempts' => $previousAttempts,
            'exam' => $exam,
        ]);
    }

    private static function getExamScore($attemptId, $userId)
    {
        $examAttempt = ExamAttempt::completed()
                        ->where('id', $attemptId)
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
        $leadBoard =  ExamAttempt::completed()
                ->where('exam_id', $examAttempt->exam_id)
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
        $otherAttempts = ExamAttempt::completed()
            ->where('exam_id', $examAttempt->exam_id)
            ->where('user_id', '!=', auth()->id())
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

    public function getExamQuestions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attempt_id' => 'required|integer|exists:exam_attempts,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $questions = ExamAttempt::where('exam_attempt_id', $request->attempt_id)
            ->whereHas('question') // Ensure question exists
            ->with('question')
            ->get()
            ->map(function ($question) {
                return [
                    'is_correct' => $question->is_correct ? 'Correct' : 'Incorrect',
                    'question' => [
                        'question_title' => $question->question->question_title ?? 'N/A',
                        'difficulty' => $question->question->difficulty ?? 'Unknown',
                        'section' => $question->question->section ?? null,
                    ],
                    'time_spent' => $this->formatTime($question->time_spent),
                    'student_answer' => $question->student_answer ?? 'Not Attempted',
                ];
            });

        return response()->json(['questions' => $questions]);
    }

    /**
     * Filter exam questions via API.
     */
    public function filterExamQuestions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attempt_id' => 'required|integer|exists:exam_attempts,id',
            'correct' => 'boolean',
            'incorrect' => 'boolean',
            'difficulties' => 'array',
            'difficulties.*' => 'in:Easy,Medium,Hard,Very Hard',
            'minDuration' => 'numeric|min:1',
            'maxDuration' => 'numeric|min:1',
            'search' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $query = ExamAttemptQuestion::where('attempt_id', $request->attempt_id)
            ->whereHas('question')
            ->with('question');

        // Correct/Incorrect filter
        if ($request->correct && !$request->incorrect) {
            $query->where('is_correct', 1);
        } elseif (!$request->correct && $request->incorrect) {
            $query->where('is_correct', 0);
        }

        // Difficulty filter
        if ($request->difficulties && !empty($request->difficulties)) {
            $query->whereHas('question', function ($q) use ($request) {
                $q->whereIn('difficulty', $request->difficulties);
            });
        }

        // Duration filter
        $query->whereBetween('time_spent', [
            $request->minDuration ?? 1,
            $request->maxDuration ?? 120,
        ]);

        // Search filter
        if ($request->search) {
            $query->whereHas('question', function ($q) use ($request) {
                $q->where('question_title', 'like', '%' . $request->search . '%');
            });
        }

        $questions = $query->get()->map(function ($question) {
            return [
                'is_correct' => $question->is_correct ? 'Correct' : 'Incorrect',
                'question' => [
                    'question_title' => $question->question->question_title ?? 'N/A',
                    'difficulty' => $question->question->difficulty ?? 'Unknown',
                    'section' => $question->question->section ?? null,
                    'id' => $question->question->id ?? null,
                ],
                'time_spent' => $this->formatTime($question->time_spent),
                'student_answer' => $question->student_answer ?? 'Not Attempted',
            ];
        });

        return response()->json(['questions' => $questions]);
    }

    /**
     * Get other student's score via API.
     */
    public function otherStudentScore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'exam_id' => 'required|integer|exists:exam_attempts,exam_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $attempt = ExamAttempt::completed()
            ->where('exam_id', $request->exam_id)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$attempt) {
            return response()->json(['error' => 'No attempt found for this user.'], 404);
        }

        $totalQuestions = $attempt->examAttemptQuestions()->count();
        $totalTimeSpent = $attempt->examAttemptQuestions()->sum('time_spent');
        $averagePaceSeconds = $totalQuestions > 0 ? round($totalTimeSpent / $totalQuestions) : 0;

        return response()->json([
            'averagePaceFormatted' => $this->formatTime($averagePaceSeconds),
            'totalTimeFormatted' => $this->formatTime($totalTimeSpent),
        ]);
    }

    /**
     * Format time from seconds to mm:ss.
     */
    private function formatTime($seconds)
    {
        if (!$seconds) {
            return '0:00';
        }
        $minutes = floor($seconds / 60);
        $secs = $seconds % 60;
        return sprintf('%d:%02d', $minutes, $secs);
    }

    public function drillExam()
    {
        return view('backend.fulltest.drill-exam');
    }
}
