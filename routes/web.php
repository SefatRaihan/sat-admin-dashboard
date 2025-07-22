<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\NavItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FullTestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MakeModelController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\RoleNavItemController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\PackageGenerateController;
use App\Http\Controllers\Api\StudentController as StudentApiController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DrillExamController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TopicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::patch('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update.name');
    Route::patch('/profile/dob', [ProfileController::class, 'updateDob'])->name('profile.update.dob');
    Route::patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
    Route::patch('/profile/phone', [ProfileController::class, 'updatePhone'])->name('profile.update.phone');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});


Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified', 'check.permission'])->name('dashboard');


Route::middleware(['auth','web', 'check.permission'])->group(function () {

    // Route::resource('roles', RoleController::class);
    Route::resource('navitems', NavItemController::class);
    Route::resource('rolenavitems', RoleNavItemController::class);

    //users crud
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::get('/users-trash', [UserController::class, 'trash'])->name('users.trash');
    Route::get('/users-trash/{user}', [UserController::class, 'restore'])->name('users.restore');
    Route::get('/users-trash/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users-excel', [UserController::class, 'excel'])->name('users.excel');
    Route::get('/users-pdf', [UserController::class, 'pdf'])->name('users.pdf');
    Route::resource('generals', GeneralController::class);
    Route::resource('question', QuestionController::class);

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notification/create', [NotificationController::class, 'create'])->name('notification.create');
    Route::post('/notification/send', [NotificationController::class, 'sendNotification'])->name('notification.send');
    Route::post('/notification/sms', [NotificationController::class, 'sendSms'])->name('notification.sms');
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');

    Route::resource('roles', RoleManagementController::class);
    Route::resource('supervisors', SupervisorController::class);
    Route::resource('students', StudentController::class);
    Route::resource('chapters', ChapterController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('courses', CourseController::class);

    Route::resource('exams', ExamController::class);
    Route::get('exams/{id}/edit', [ExamController::class, 'edit'])->name('exam.edit');

    Route::get('/mark-as-read/{id}', function ($id) {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    })->name('markAsRead');

    Route::resource('full-tests', FullTestController::class);
    Route::get('drill-exam', [DrillExamController::class, 'create'])->name('drill-exam');
    Route::post('/drill-exam/prepare', [DrillExamController::class, 'prepare'])->name('drill-exam.prepare');
    Route::get('/drill-exam/start', [DrillExamController::class, 'start'])->name('drill-exam.start');
    Route::resource('student-exams', StudentExamController::class)->names('student-exams');
    Route::post('student-exams/{id}', [StudentExamController::class, 'update']);
    Route::post('student-exam/start/{examId}', [StudentExamController::class, 'startExam'])->name('student-exam.start');
    Route::get('student-open-exam/{examId}', [StudentExamController::class, 'openExam'])->name('student-exam.open');
    Route::get('student-open-exam/{examId}', [StudentExamController::class, 'openExam'])->name('student-exam.open');
    Route::get('student-exam/histories', [StudentExamController::class, 'histories'])->name('student-exam.histories');
    Route::get('result/{id}', [FullTestController::class, 'results'])->name('result');
    Route::get('view-details/{id}', [FullTestController::class, 'view_details']);
    Route::get('/other-student-score', [FullTestController::class, 'otherExamScore'])->name('other-student-score');
    Route::get('/exams/{id}/details', [FullTestController::class, 'examDetails']);

    Route::get('student-profile', [StudentController::class, 'studentProfile'])->name('student.profile');
    Route::get('/checkout', [StudentController::class, 'checkout'])->name('student.checkout');
    Route::get('/checkout', [StudentController::class, 'checkout'])->name('student.checkout');
    Route::get('/explanation/{examattemptid}/{questionid}', [StudentController::class, 'explanation'])->name('student.explanation');

    Route::get('/all-result', [ExamController::class, 'allResult'])->name('all-result');
    Route::get('/student-history', [StudentApiController::class, 'history']);
    Route::get('/api/other-student-score', [FullTestController::class, 'otherStudentScore'])->name('other.student.score');
    Route::post('/api/exam-questions', [FullTestController::class, 'getExamQuestions'])->name('exam.questions');
    Route::post('/api/filter-exam-questions', [FullTestController::class, 'filterExamQuestions'])->name('filter.exam.questions');
    Route::get('/ranking', [ExamController::class, 'ranking'])->name('ranking');
    Route::get('/topic/create', [TopicController::class, 'create'])->name('topic.crate');
    Route::get('/student/course', [StudentController::class, 'studentCourse'])->name('student.course');
    Route::get('/student/course/detail/{id}', [StudentController::class, 'studentCourseDetails'])->name('student.course.detail');
    Route::get('/student/video/lesson/{uuid}', [StudentController::class, 'studentVideoLessonDetails'])->name('student.video.lesson.details');

});



require __DIR__.'/auth.php';
