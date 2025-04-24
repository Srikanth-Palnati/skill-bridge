<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    //To list all courses for Admin
    Route::get('/listcourses', [CourseController::class, 'listcourses'])->name('listcourses');
    //To view course for Admin
    Route::get('/courses/{course}/view', [CourseController::class, 'view'])->name('courses.view'); 
    //To download course certificate
    Route::post('/downloadcertificate', [CourseController::class, 'downloadcertificate'])->name('downloadcertificate'); 
    //To pay & process course for student
    Route::post('/payment/create', [PaymentController::class, 'paymentcreate'])->name('payment.create');
    
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
