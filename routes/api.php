<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TrainerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-courses-of-trainer', [CourseController::class, 'getCoursesOfTrainer'])->name('get-courses-of-trainer');

Route::post('/create-admin', [AdminController::class, 'create'])->name('create-admin');
Route::post('/create-attendee', [AttendeeController::class, 'create'])->name('create-attendee');
Route::post('/create-course', [CourseController::class, 'create'])->name('create-course');
Route::post('/create-trainer', [TrainerController::class, 'create'])->name('create-trainer');
Route::post('/link-course-trainer', [CourseController::class, 'linkCourseToTrainer'])->name('link-course-trainer');
Route::post('/link-attendee-course', [AttendanceController::class, 'linkAttendeeToCourse'])->name('link-attendee-course');