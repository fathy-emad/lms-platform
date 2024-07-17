<?php

use App\Http\Controllers\WebServices\Enums\EnumsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api admin auth" middleware group. Make something great!
|
*/

Route::prefix("enums")->controller(EnumsController::class)->group(function (){
    Route::get("active-status", "activeStatus");
    Route::get("admin-role", "adminRole");
    Route::get("admin-status", "adminStatus");
    Route::get("gender-status", "genderStatus");
    Route::get("teacher-status", "teacherStatus");
    Route::get("months", "months");
    Route::get("edu-terms", "EduTerms");
    Route::get("edu-types", "EduTypes");
    Route::get("name-prefix", "NamePrefix");
    Route::get("teacher-course-request-status", "teacherCourseStatus");
});
