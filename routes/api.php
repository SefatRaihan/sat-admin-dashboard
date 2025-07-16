<?php

use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\MainQuestionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\ExamSectionController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RoleManagementController;
use App\Http\Controllers\Api\RoleNavItemApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 'middleware' => ['api', 'auth', 'web'],
Route::group(['as' => 'api.', 'middleware' => ['auth', 'web', 'check.permission']], function () {
    Route::get('get-role-navitems-with-selected/{id}', [RoleNavItemApiController::class, 'getnavitemWithSelected']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/students/{uuid}/update', [StudentController::class, 'update']);
    Route::resource('students', StudentController::class);
    Route::post('/students-delete', [StudentController::class, 'delete']);
    Route::post('/students/deactivate', [StudentController::class, 'deactivate']);
    Route::post('/students/send-notification', [StudentController::class, 'sendNotification']);
    Route::get('/students/export/{ids}', [StudentController::class, 'exportExcel']);
    Route::post('/students/update-status', [StudentController::class, 'updateStatus']);

    Route::resource('supervisors', SupervisorController::class);
    Route::post('/supervisors/{uuid}/update', [SupervisorController::class, 'update']);
    Route::post('/supervisors-delete', [SupervisorController::class, 'delete']);

    Route::post('/roles-delete', [RoleManagementController::class, 'delete']);
    Route::post('/roles/activate', [RoleManagementController::class, 'activate']);
    Route::post('/roles/deactivate', [RoleManagementController::class, 'deactivate']);
    Route::post('/roles/update-status', [RoleManagementController::class, 'updateStatus']);

    Route::post('/notifications-delete', [NotificationController::class, 'delete']);

    Route::resource('topic', TopicController::class);
    Route::get('get-topic', [TopicController::class, 'getTopic']);
    Route::get('get-exam', [CourseController::class, 'getExam']);
    Route::get('get-lesson', [CourseController::class, 'getLesson']);
    Route::get('lessons-by-id', [CourseController::class, 'getLessonByIds']);
    Route::get('get-chapter', [CourseController::class, 'getChapter']);
    Route::apiResource('course', CourseController::class);

    /*
    |--------------------------------------------------------------------------
    | API Routes for Questions
    |--------------------------------------------------------------------------
    */

    // 📌 Get all questions (supports filtering & pagination)
    Route::get('/questions', [MainQuestionController::class, 'index']);
    Route::post('/questions-delete', [MainQuestionController::class, 'delete']);


    // 📌 Create a new question
    Route::post('/questions', [MainQuestionController::class, 'store']);

    // 📌 Get a specific question by ID (with related exams & sections)
    Route::get('/questions/{id}', [MainQuestionController::class, 'show']);

    // 📌 Update a question
    Route::put('/questions/{id}', [MainQuestionController::class, 'update']);

    // 📌 Soft delete a question
    Route::delete('/questions/{id}', [MainQuestionController::class, 'destroy']);

    // 📌 Restore a soft-deleted question
    Route::post('/questions/{id}/restore', [MainQuestionController::class, 'restore']);

    // 📌 Toggle question status (active <-> inactive)
    Route::patch('/questions/{id}/update-status', [MainQuestionController::class, 'toggleStatus']);


    // 📌 Get related exams and sections for a question
    Route::get('/questions/{id}/relations', [MainQuestionController::class, 'getRelations']);

    /*
    |--------------------------------------------------------------------------
    | API Routes for Exams
    |--------------------------------------------------------------------------
    */

    Route::get('/exams/questions', [ExamSectionController::class, 'getQuestionsWithExamSection']);
    Route::post('/exams/exam-section-questions', [ExamSectionController::class, 'examSectionQuestion']);
    // Route::post('/exams/publish', [ExamSectionController::class, 'examPublish']);
    Route::apiResource('/exams', ExamController::class);
    Route::post('/exam-delete', [ExamController::class, 'delete']);
    Route::post('/exams/{id}/restore', [ExamController::class, 'restore']);
    Route::patch('/exams/{id}/update-status', [ExamController::class, 'toggleStatus']);

    Route::post('/registrations', [RegistrationController::class, 'store']);
    Route::get('/registrations', [RegistrationController::class, 'index']);

    Route::get('/results', [ExamController::class, 'results']);
    Route::get('/ranking', [ExamController::class, 'ranking']);
    Route::patch('/exams/{id}/ranking', [ExamController::class, 'updateRanking']);
    Route::post('/exams/{id}/move-ranking', [ExamController::class, 'moveRanking']);
    // Route::middleware('auth')->get('/student-history', [StudentController::class, 'history']);
    Route::post('/feedback', [FeedbackController::class, 'store']);

    Route::prefix('chapters')->group(function () {
        Route::get('/', [ChapterController::class, 'index']);
        Route::post('/', [ChapterController::class, 'store']);
        Route::get('/{id}', [ChapterController::class, 'show']);
        Route::patch('/{id}', [ChapterController::class, 'update']);
        Route::patch('/{id}/state', [ChapterController::class, 'updateState']);
        Route::post('/delete', [ChapterController::class, 'destroy']);
    });

    Route::get('/lessons', [LessonController::class, 'index']);
    Route::post('/lessons', [LessonController::class, 'store']);
    Route::get('/lessons/{id}', [LessonController::class, 'show']);
    Route::post('/lessons/{id}', [LessonController::class, 'update']);
    Route::post('/lessons/delete', [LessonController::class, 'destroy']);
    Route::patch('/lessons/{id}/update-status', [LessonController::class, 'updateStatus']);
});
