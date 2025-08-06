<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Exam;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use App\Models\Lesson;
use App\Models\Supervisor;
use App\Models\Student;
use App\Models\Question;
use App\Models\VideoLesson;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public static $visiblePermissions = [
        'adminDashboard' => 'Admin Dashboard',
        'getDashboardData' => 'Get Dashboard Data'
    ];

    // public function adminDashboard()
    // {
    //     return view('backend.admin.dashboard');
    // }

    public function getDashboardData(Request $request)
    {
        // Validate the timeFrame parameter
        $timeFrame = $request->query('timeFrame', 'week');
        $startDate = null;
        $endDate = Carbon::now();

        // Determine date range based on timeFrame
        if ($timeFrame === 'week') {
            $startDate = Carbon::now()->subWeek();
        } elseif ($timeFrame === 'two_weeks') {
            $startDate = Carbon::now()->subWeeks(2);
        } elseif ($timeFrame === 'month') {
            $startDate = Carbon::now()->subMonth();
        } elseif (str_starts_with($timeFrame, 'custom')) {
            $startDate = Carbon::parse($request->query('start'));
            $endDate = Carbon::parse($request->query('end'));
        } else {
            return response()->json(['error' => 'Invalid time frame'], 400);
        }


        // Initialize default response
        $response = [
            'subscriptions' => [
                'total' => 0,
                'active' => 0,
                'expired' => 0,
                'canceled' => 0
            ],
            'exams' => [
                'total' => 0,
                'active' => 0,
                'inactive' => 0,
                'used' => 0,
                'added' => 0
            ],
            'courses' => [
                'completed' => array_fill(0, 12, 0),
                'inProgress' => array_fill(0, 12, 0)
            ],
            'supervisor' => [
                'total' => 0,
                'new' => 0
            ],
            'students' => [
                'total' => 0,
                'new' => 0,
                'unregistered' => 0
            ],
            'questions' => [
                'total' => 0,
                'add' => 0,
                'feedback' => 0,
                'progress' => 0
            ],
            'videoLessons' => [
                'total' => 0,
                'added' => 0,
                'progress' => 0
            ]
        ];

        try {
            // Subscriptions
            // $response['subscriptions']['total'] = Subscription::count();
            // $response['subscriptions']['active'] = Subscription::where('status', 'active')->count();
            // $response['subscriptions']['expired'] = Subscription::where('status', 'expired')->count();
            // $response['subscriptions']['canceled'] = Subscription::where('status', 'canceled')->count();

            $response['subscriptions']['total'] = 0;
            $response['subscriptions']['active'] = 0;
            $response['subscriptions']['expired'] = 0;
            $response['subscriptions']['canceled'] = 0;

            // Exams
            $response['exams']['total'] = Exam::count();
            $response['exams']['active'] = Exam::where('status', 'active')->count();
            $response['exams']['inactive'] = Exam::where('status', 'inactive')->count();
            $response['exams']['used'] = Exam::whereHas('courses')->count();
            $response['exams']['added'] = ExamAttempt::whereBetween('created_at', [$startDate, $endDate])->count();

            // Courses (Monthly data for completed and in-progress courses)
            $monthlyCompleted = array_fill(0, 12, 0);
            $monthlyInProgress = array_fill(0, 12, 0);
            $currentYear = Carbon::now()->year;

            for ($month = 1; $month <= 12; $month++) {
                $monthStart = Carbon::create($currentYear, $month, 1)->startOfMonth();
                $monthEnd = Carbon::create($currentYear, $month, 1)->endOfMonth();

                $monthlyCompleted[$month - 1] = CourseUser::where('is_completed', 1)
                    ->whereBetween('updated_at', [$monthStart, $monthEnd])
                    ->count();
                $monthlyInProgress[$month - 1] = CourseUser::where('is_completed', 0)
                    ->whereBetween('updated_at', [$monthStart, $monthEnd])
                    ->count();
            }
            $response['courses']['completed'] =$monthlyCompleted;
            $response['courses']['inProgress'] = $monthlyInProgress;
            // Supervisors
            $response['supervisor']['total'] = Supervisor::count();
            $response['supervisor']['new'] = Supervisor::whereBetween('created_at', [$startDate, $endDate])->count();

            // Students
            $response['students']['total'] = Student::count();
            $response['students']['new'] = Student::whereBetween('created_at', [$startDate, $endDate])->count();
            // $response['students']['unregistered'] = ExamQuestion::whereHas('students')->count();

            // Questions
            $response['questions']['total'] = ExamQuestion::count();
            $response['questions']['add'] = ExamQuestion::whereBetween('created_at', [$startDate, $endDate])->count();
            $response['questions']['feedback'] = ExamAttempt::whereHas('feedbacks')->count();
            $response['questions']['progress'] = ExamQuestion::count() > 0
                ? (ExamQuestion::whereBetween('created_at', [$startDate, $endDate])->count() / ExamQuestion::count()) * 100
                : 0;

            // Video Lessons
            $response['videoLessons']['total'] = Lesson::count();
            $response['videoLessons']['added'] = Lesson::whereBetween('created_at', [$startDate, $endDate])->count();
            $response['videoLessons']['progress'] = Lesson::count() > 0
                ? (Lesson::whereBetween('created_at', [$startDate, $endDate])->count() / Lesson::count()) * 100
                : 0;

            return response()->json($response);
        } catch (\Exception $e) {
            dd($e->getMessage());
            \log()::error('Dashboard data fetch error: ' . $e->getMessage());
            return response()->json($response, 200); // Return defaults on error
        }
    }
}
