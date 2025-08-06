<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExamAttempt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public static $visiblePermissions = [
        'dashboard' => 'Dashboard'
    ];

    // public function dashboard()
    // {
    //     $user = User::where('id', auth()->user()->id)->first();
    //     $attemptedExams = ExamAttempt::with('exam', 'exam.questions')->where('user_id', $user->id)
    //         ->where('status', 'completed')
    //         ->limit(5)
    //         ->get();


    //     // Exam LeadBoard
    //     $leadBoard =  ExamAttempt::completed()
    //             ->where('correct_answers', '>', 0)
    //             ->orderByDesc('correct_answers')
    //             ->orderByRaw('TIMESTAMPDIFF(SECOND, start_time, end_time) ASC')
    //             ->with('user')
    //             ->limit(5)
    //             ->get()
    //             ->map(function ($attempt) {
    //                 $durationInSeconds = strtotime($attempt->end_time) - strtotime($attempt->start_time);
    //                 $minutes = floor($durationInSeconds / 60);
    //                 $seconds = $durationInSeconds % 60;
    //                 $totalQ = $attempt->count();
    //                 $percentCorrect = $totalQ > 0 ? round(($attempt->correct_answers / $totalQ) * 100) : 0;
    //                 return [
    //                     'user_id' => $attempt->user->id ?? 'N/A',
    //                     'user_name' => $attempt->user->student->name ?? 'N/A',
    //                     'score' => $percentCorrect,
    //                     'time' => sprintf("%d:%02d", $minutes, $seconds),
    //                     'submitted_at' => $attempt->end_time,
    //                     'profile_image' => $attempt->user->student->image
    //                             ? Storage::disk('public')->url($attempt->user->student->image)
    //                             : asset('images/default-avatar.png'),
    //                 ];
    //             });

    //     if($user->active_role_id == 4){
    //         return view('student-dashboard', compact('user', 'attemptedExams', 'leadBoard'));
    //     } else {
    //         return view('dashboard');
    //     }
    // }

    public function dashboard()
    {
        $user = auth()->user();
        $attemptedExams = ExamAttempt::with('exam', 'exam.questions')
            ->where('user_id', $user->id)
            ->where('exam_attempts.status', 'completed') // Qualified status
            ->limit(5)
            ->get();

        $leadBoard = ExamAttempt::completed()
            ->select('exam_attempts.*')
            ->selectRaw('ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY correct_answers DESC, TIMESTAMPDIFF(SECOND, start_time, end_time) ASC) as rn')
            ->where('correct_answers', '>', 0)
            ->with('user')
            ->get()
            ->filter(function ($attempt) {
                return $attempt->rn === 1; // Keep only the best attempt per user
            })
            ->take(5) // Limit to top 5 users
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

        // Determine audience based on sat_question_type
        $questionTypes = ExamAttempt::where('user_id', $user->id)
            ->where('exam_attempts.status', 'completed') // Qualified status
            ->join('exam_attempt_questions', 'exam_attempts.id', '=', 'exam_attempt_questions.attempt_id')
            ->join('exam_questions', 'exam_attempt_questions.question_id', '=', 'exam_questions.id')
            ->distinct()
            ->pluck('exam_questions.sat_question_type');

        $isSat2 = $questionTypes->contains(function ($type) {
            return in_array(strtolower($type), ['verbal', 'quant']);
        });

        $questionDistribution = [
            'allTime' => [],
            'last5' => []
        ];
        $categories = [];

        if ($isSat2) {
            // SAT2: Verbal and Quant
            $categories = ['Verbal', 'Quant'];

            // All-Time Stats
            $allTimeStats = ExamAttempt::where('user_id', $user->id)
                ->where('exam_attempts.status', 'completed') // Qualified status
                ->join('exam_attempt_questions', 'exam_attempts.id', '=', 'exam_attempt_questions.attempt_id')
                ->join('exam_questions', 'exam_attempt_questions.question_id', '=', 'exam_questions.id')
                ->select(
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'verbal' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as verbal_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'verbal' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as verbal_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'quant' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as quant_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'quant' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as quant_incorrect")
                )
                ->first();

            $questionDistribution['allTime'] = [
                'Verbal_Correct' => $allTimeStats->verbal_correct ?? 0,
                'Verbal_Incorrect' => $allTimeStats->verbal_incorrect ?? 0,
                'Quant_Correct' => $allTimeStats->quant_correct ?? 0,
                'Quant_Incorrect' => $allTimeStats->quant_incorrect ?? 0
            ];

            // Last 5 Stats
            $last5AttemptIds = ExamAttempt::where('user_id', $user->id)
                ->where('exam_attempts.status', 'completed') // Qualified status
                ->orderBy('start_time', 'desc')
                ->limit(5)
                ->pluck('id');

            $last5Stats = ExamAttempt::whereIn('exam_attempts.id', $last5AttemptIds)
                ->join('exam_attempt_questions', 'exam_attempts.id', '=', 'exam_attempt_questions.attempt_id')
                ->join('exam_questions', 'exam_attempt_questions.question_id', '=', 'exam_questions.id')
                ->select(
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'verbal' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as verbal_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'verbal' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as verbal_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'quant' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as quant_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'quant' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as quant_incorrect")
                )
                ->first();

            $questionDistribution['last5'] = [
                'Verbal_Correct' => $last5Stats->verbal_correct ?? 0,
                'Verbal_Incorrect' => $last5Stats->verbal_incorrect ?? 0,
                'Quant_Correct' => $last5Stats->quant_correct ?? 0,
                'Quant_Incorrect' => $last5Stats->quant_incorrect ?? 0
            ];
        } else {
            // Non-SAT2: Math, Physics, Biology, Chemistry
            $categories = ['Math', 'Physics', 'Biology', 'Chemistry'];

            // All-Time Stats
            $allTimeStats = ExamAttempt::where('user_id', $user->id)
                ->where('exam_attempts.status', 'completed') // Qualified status
                ->join('exam_attempt_questions', 'exam_attempts.id', '=', 'exam_attempt_questions.attempt_id')
                ->join('exam_questions', 'exam_attempt_questions.question_id', '=', 'exam_questions.id')
                ->select(
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'math' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as math_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'math' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as math_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'physics' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as physics_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'physics' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as physics_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'biology' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as biology_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'biology' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as biology_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'chemistry' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as chemistry_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'chemistry' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as chemistry_incorrect")
                )
                ->first();

            $questionDistribution['allTime'] = [
                'Math_Correct' => $allTimeStats->math_correct ?? 0,
                'Math_Incorrect' => $allTimeStats->math_incorrect ?? 0,
                'Physics_Correct' => $allTimeStats->physics_correct ?? 0,
                'Physics_Incorrect' => $allTimeStats->physics_incorrect ?? 0,
                'Biology_Correct' => $allTimeStats->biology_correct ?? 0,
                'Biology_Incorrect' => $allTimeStats->biology_incorrect ?? 0,
                'Chemistry_Correct' => $allTimeStats->chemistry_correct ?? 0,
                'Chemistry_Incorrect' => $allTimeStats->chemistry_incorrect ?? 0
            ];

            // Last 5 Stats
            $last5AttemptIds = ExamAttempt::where('user_id', $user->id)
                ->where('exam_attempts.status', 'completed') // Qualified status
                ->orderBy('start_time', 'desc')
                ->limit(5)
                ->pluck('id');

            $last5Stats = ExamAttempt::whereIn('exam_attempts.id', $last5AttemptIds)
                ->join('exam_attempt_questions', 'exam_attempts.id', '=', 'exam_attempt_questions.attempt_id')
                ->join('exam_questions', 'exam_attempt_questions.question_id', '=', 'exam_questions.id')
                ->select(
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'math' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as math_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'math' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as math_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'physics' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as physics_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'physics' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as physics_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'biology' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as biology_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'biology' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as biology_incorrect"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'chemistry' AND exam_attempt_questions.is_correct = 1 THEN 1 ELSE 0 END) as chemistry_correct"),
                    DB::raw("SUM(CASE WHEN LOWER(exam_questions.sat_question_type) = 'chemistry' AND exam_attempt_questions.is_correct = 0 THEN 1 ELSE 0 END) as chemistry_incorrect")
                )
                ->first();

            $questionDistribution['last5'] = [
                'Math_Correct' => $last5Stats->math_correct ?? 0,
                'Math_Incorrect' => $last5Stats->math_incorrect ?? 0,
                'Physics_Correct' => $last5Stats->physics_correct ?? 0,
                'Physics_Incorrect' => $last5Stats->physics_incorrect ?? 0,
                'Biology_Correct' => $last5Stats->biology_correct ?? 0,
                'Biology_Incorrect' => $last5Stats->biology_incorrect ?? 0,
                'Chemistry_Correct' => $last5Stats->chemistry_correct ?? 0,
                'Chemistry_Incorrect' => $last5Stats->chemistry_incorrect ?? 0
            ];
        }

        // Top 5 Weakness Areas
        $weaknessAreas = ExamAttempt::where('user_id', $user->id)
            ->where('exam_attempts.status', 'completed')
            ->join('exam_attempt_questions', 'exam_attempts.id', '=', 'exam_attempt_questions.attempt_id')
            ->join('exam_questions', 'exam_attempt_questions.question_id', '=', 'exam_questions.id')
            ->join('topics', 'exam_questions.topic_id', '=', 'topics.id') // Join with topics table
            ->where('exam_attempt_questions.is_correct', 0)
            ->select('exam_questions.topic_id', 'topics.name', DB::raw('COUNT(*) as incorrect_count'))
            ->groupBy('exam_questions.topic_id', 'topics.name')
            ->orderByDesc('incorrect_count')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'topic_id' => $item->topic_id,
                    'name' => $item->name,
                    'incorrect_count' => $item->incorrect_count
                ];
            });

        // Dynamically calculate Courses Completed from course_user table
        $coursesCompleted = DB::table('course_user')
            ->where('user_id', $user->id)
            ->where('is_completed', true) // Adjust if 'is_completed' uses a different value (e.g., 1, 'completed')
            ->count();

        // Dynamically calculate Predicted Score
        $totalAttempts = $attemptedExams->count();
        $averagePercentCorrect = $totalAttempts > 0
            ? $attemptedExams->avg(function ($attempt) {
                $totalQ = $attempt->count();
                return $totalQ > 0 ? ($attempt->correct_answers / $totalQ) * 100 : 0;
            })
            : 0;
        $predictedScore = round($averagePercentCorrect); // Predicted score as a percentage

        // return response()->json([
        //     'user' => $user,
        //     'attemptedExams' => $attemptedExams,
        //     'leadBoard' => $leadBoard,
        //     'questionDistribution' => $questionDistribution,
        //     'weaknessAreas' => $weaknessAreas,
        //     'categories' => $categories
        // ]);
        if($user->active_role_id == 4){
            return view('student-dashboard', compact(
                'user',
                'attemptedExams',
                'leadBoard',
                'questionDistribution',
                'weaknessAreas',
                'categories',
                'coursesCompleted', // Pass dynamic courses completed
                'predictedScore'    // Pass dynamic predicted score
            ));
        } else {
            return view('dashboard');
        }
    }

    public function financialDashboard()
    {
        return view('financial-dashboard');
    }
}
