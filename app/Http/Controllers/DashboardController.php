<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExamAttempt;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public static $visiblePermissions = [
        'dashboard' => 'Dashboard'
    ];

    public function dashboard()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $attemptedExams = ExamAttempt::with('exam', 'exam.questions')->where('user_id', $user->id)
            ->where('status', 'completed')
            ->limit(5)
            ->get();


        // Exam LeadBoard
        $leadBoard =  ExamAttempt::completed()
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

        if($user->active_role_id == 4){
            return view('student-dashboard', compact('user', 'attemptedExams', 'leadBoard'));
        } else {
            return view('dashboard');
        }
    }

    public function financialDashboard()
    {
        return view('financial-dashboard');
    }
}
