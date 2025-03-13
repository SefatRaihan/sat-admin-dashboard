<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleNavItemApiController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ExamSectionController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\StudentExamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::group(['middleware' => ['api', 'auth', 'web'], 'as' => 'api.'], function () {
    Route::get('get-role-navitems-with-selected/{id}', [RoleNavItemApiController::class,'getnavitemWithSelected']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::resource('students', StudentController::class);
});



/*
|--------------------------------------------------------------------------
| API Routes for Questions
|--------------------------------------------------------------------------
*/

// Resource routes for standard CRUD operations
Route::apiResource('/questions', QuestionController::class);

// Route for restoring soft-deleted questions
Route::post('/questions/{id}/restore', [QuestionController::class, 'restore']);



/*
|--------------------------------------------------------------------------
| API Routes for Exams
|--------------------------------------------------------------------------
*/

Route::apiResource('/exams', ExamController::class);
Route::post('/exams/{id}/restore', [ExamController::class, 'restore']);
Route::patch('/exams/{id}/toggle-status', [ExamController::class, 'toggleStatus']);




// ✅ Assign Question to Section (Drag & Drop)
//Route::post('/sections/assign-question', [ExamSectionController::class, 'assignQuestionToSection']);

// ✅ Remove Question from Section (Drag Out)
//Route::post('/sections/remove-question', [ExamSectionController::class, 'removeQuestionFromSection']);

//Route::get('/student/exam/{examId}', [StudentExamController::class, 'getExamForStudent']);

