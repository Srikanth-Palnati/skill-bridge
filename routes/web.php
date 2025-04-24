<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])->group(function () {
    Route::get('/admin', function () { return view('admin');})->name('admin');
    //To list all courses for Admin
    Route::get('/listcourses', [CourseController::class, 'listcourses'])->name('listcourses');
    //To create course for Admin
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    //To view course for Admin
    Route::get('/courses/{course}/view', [CourseController::class, 'view'])->name('courses.view');
    //To store course for Admin
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    //To edit course for Admin
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    //To update course for Admin
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    //To destroy course for Admin
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    //To create certificate for Admin
    Route::get('/courses/{course}/users/certificate', [CourseController::class, 'generateCertificatesForCourse'])->name('courses.users.certificate');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:student'
])->group(function () {
    Route::get('/home', function () { return view('home');})->name('home');
    //To view course for student in grid
    Route::get('/liststudentcourses', [CourseController::class, 'liststudentcourses'])->name('liststudentcourses');
    //To view course for student
    Route::get('/courses/{course}/studentview', [CourseController::class, 'studentview'])->name('courses.studentview');
    //To pay & process course for student
    Route::post('/payment/create', [PaymentController::class, 'paymentcreate'])->name('payment.create');
    //To create pay for student
    Route::get('/payment/success', [PaymentController::class, 'paymentsuccess'])->name('payment.success');
});


