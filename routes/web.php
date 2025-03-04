<?php

use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\NavItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MakeModelController;
use App\Http\Controllers\RoleNavItemController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PackageGenerateController;

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
});


Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth','web'])->group(function () {

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

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::get('/notification/create', [NotificationController::class, 'create'])->name('notification.create');

    Route::resource('roles', RoleManagementController::class);
    Route::resource('supervisors', SupervisorController::class);
    Route::resource('students', StudentController::class);

    Route::resource('exams', ExamController::class);

});



require __DIR__.'/auth.php';
