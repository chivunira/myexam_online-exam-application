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

    Route::get('/view_users', [AdminController::class, 'view_users'])->name('admin.viewusers');

    Route::get('/view_courses', [AdminController::class, 'view_course'])->name('admin.viewcourses');
    Route::post('/view_courses', [AdminController::class, 'add_course']);

    Route::get('/view_units', [AdminController::class, 'view_unit'])->name('admin.viewunits');
    Route::post('/view_units', [AdminController::class, 'add_unit']);

    // Route::get('/delete-department/{id}', ('App\Http\Controllers\Admin\DepartmentController@destroy'));
    // Route::put('/update-department/{id}', 'App\Http\Controllers\Admin\DepartmentController@update'); // Update leave details
    // Route::get('/edit-department/{id}', 'App\Http\Controllers\Admin\DepartmentController@edit'); // Edit leave details
});
