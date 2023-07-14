<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\MpesaController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;

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

    Route::get('/profile', [StudentController::class, 'stdProfile'])->name('student.profile');
    Route::put('/profile', [StudentController::class, 'profileUpdate']);

    Route::get('/special_request_form', [StudentController::class, 'view_special'])->name('student.specialrequest');
    Route::post('/special_request_form', [StudentController::class, 'store_special']);

    Route::get('/retake_request_form', [StudentController::class, 'view_retake'])->name('student.retakerequest');
    Route::post('/retake_request_form_finalize', [StudentController::class, 'retake_cont'])->name('student.retakecont');
    Route::post('retake-finalize', [StudentController::class, 'store_retake'])->name('retake.finalize');
    //Route::post('/retake_request_form', [StudentController::class, 'store_special']);

    Route::post('/payment', [MpesaController::class, 'handleCallback'])->name('payment');
    Route::get('/stk-push', [MpesaController::class, 'STKPush'])->name('stk_push');
    //Route::get('/payment', [MpesaController::class, 'viewPayment'])->name('payment_page');

    

    Route::get('/application_history', [StudentController::class, 'application_history'])->name('student.application_history');

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
    Route::get('/delete-course/{id}',[AdminController::class, 'destroy_course']);
    Route::put('/update-course/{id}',[AdminController::class, 'update_course']); // Update leave details
    Route::get('/edit-course/{id}', [AdminController::class, 'edit_course'])->name('course.edit'); // Edit leave details


    Route::get('/view_units', [AdminController::class, 'view_unit'])->name('admin.viewunits');
    Route::post('/view_units', [AdminController::class, 'add_unit']);
    Route::get('/delete-unit/{id}',[AdminController::class, 'delete_unit']);
    Route::put('/update-unit/{id}', [AdminController::class, 'update_unit']); // Update leave details
    Route::get('/edit-unit/{id}', [AdminController::class, 'edit_unit']); // Edit leave details


    Route::get('/view_unit_exams', [AdminController::class, 'view_unit_exam'])->name('admin.viewunit_exams');
    Route::post('/view_unit_exams', [AdminController::class, 'add_unit_exam']);
    Route::get('/delete-unit/{id}',[AdminController::class, 'destroy_unit_exam']);
    Route::put('/update-unit_exam/{id}', [AdminController::class, 'update_unit_exam']); // Update leave details
    Route::get('/edit-unit_exam/{id}', [AdminController::class, 'edit_unit_exam']); // Edit leave details


    Route::get('/view_exam_session', [AdminController::class, 'view_exam_session'])->name('admin.viewexam_sessions');
    Route::post('/view_exam_session', [AdminController::class, 'add_exam_session']);
    Route::get('/delete-exam_session/{id}',[AdminController::class, 'destroy_exam_session']);
    Route::put('/update-exam_session/{id}', [AdminController::class, 'update_exam_session']); // Update leave details
    Route::get('/edit-exam_session/{id}', [AdminController::class, 'edit_exam_session']); // Edit leave details


    // Route::get('/delete-department/{id}', ('App\Http\Controllers\Admin\DepartmentController@destroy'));
    // Route::put('/update-department/{id}', 'App\Http\Controllers\Admin\DepartmentController@update'); // Update leave details
    // Route::get('/edit-department/{id}', 'App\Http\Controllers\Admin\DepartmentController@edit'); // Edit leave details
});
