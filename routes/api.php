<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleNavItemApiController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\MainQuestionController;
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

// Get all questions (with optional filters)
Route::get('/questions', [MainQuestionController::class, 'index']);

// Create a new question
Route::post('/questions', [MainQuestionController::class, 'store']);

// Get a specific question by ID (with related exams and sections)
Route::get('/questions/{id}', [MainQuestionController::class, 'show']);

// Update a question
Route::put('/questions/{id}', [MainQuestionController::class, 'update']);

// Delete a question (soft delete)
Route::delete('/questions/{id}', [MainQuestionController::class, 'destroy']);

// Restore a soft-deleted question
Route::post('/questions/{id}/restore', [MainQuestionController::class, 'restore']);

// Get related exams and sections for a question
Route::get('/questions/{id}/relations', [MainQuestionController::class, 'getRelations']);

