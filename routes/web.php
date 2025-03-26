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


Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified', 'check.permission'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


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

    Route::resource('exams', ExamController::class);
    Route::get('exams/{id}/edit', [ExamController::class, 'edit'])->name('exam.edit');

    Route::get('/mark-as-read/{id}', function ($id) {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    })->name('markAsRead');

});



require __DIR__.'/auth.php';
