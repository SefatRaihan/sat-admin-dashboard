<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleNavItemApiController;
use App\Http\Controllers\Api\StudentController;
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
    Route::post('/students/{uuid}/update', [StudentController::class, 'update']);
    Route::resource('students', StudentController::class);
    Route::post('/students-delete', [StudentController::class, 'delete']);
    Route::post('/students/deactivate', [StudentController::class, 'deactivate']);
    Route::post('/students/send-notification', [StudentController::class, 'sendNotification']);
    Route::get('/students/export/{ids}', [StudentController::class, 'exportExcel']);
    Route::post('/students/update-status', [StudentController::class, 'updateStatus']);
});
