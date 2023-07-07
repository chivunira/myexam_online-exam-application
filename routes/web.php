<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;

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

Route::get('/', [LoginController::class, 'index']);

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/user_login', [LoginController::class, 'index'])->name('loginn');
Route::post('/user_login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logoutt');

//route to redirect the user to the success message after email verification
Route::get('/successful_verification', [VerificationController::class, 'sverification'])->name('s.verification')->middleware('guest');


//paths accessed by students only
Route::prefix('student')->middleware(['auth', 'isStd', 'verified'])->group(function () {

    Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
});


////paths accessed by lecturers only
Route::prefix('lecturer')->middleware(['auth', 'isLec', 'verified'])->group(function () {

    Route::get('/dashboard', [LecturerController::class, 'index'])->name('lecturer.dashboard');
});


//paths accessed by the admin only
Route::prefix('admin')->middleware(['auth', 'isAdmin', 'verified'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
