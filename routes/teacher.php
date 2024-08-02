<?php

use App\Http\Controllers\AuthTeacher\AuthController;
use App\Http\Controllers\Course\Material\MaterialController;
use App\Http\Controllers\Course\Register\CourseController;
use App\Http\Controllers\Setting\Country\CountryController;
use App\Http\Controllers\Setting\Language\LanguageController;
use App\Http\Controllers\SettingEducation\Chapter\ChapterController;
use App\Http\Controllers\SettingEducation\EduSubject\EduSubjectController;
use App\Http\Controllers\SettingEducation\Lesson\LessonController;
use App\Http\Controllers\SettingEducation\Stage\StageController;
use App\Http\Controllers\Teacher\BankQuestion\BankQuestionController;
use App\Http\Controllers\Teacher\CourseRequest\CourseRequestController;
use App\Http\Controllers\Teacher\PaymentRequest\PaymentRequestController;
use App\Http\Controllers\Teacher\Payments\PaymentsController;
use App\Http\Controllers\Teacher\Register\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api Teacher routes" middleware group. Make something great!
|
*/


Route::prefix('auth')->controller(AuthController::class)->group(function (){

    //Guest
    Route::post('login', 'login');
    Route::post('register', [RegisterController::class, "create"]);
    Route::post('forget-password', 'forgetPassword');//->middleware('apiThrottle:3,5');
    Route::post('new-password', 'newPassword')->middleware('apiThrottle:3,5');

    //Auth
    Route::middleware('apiAuth:teacher')->group(function (){
        Route::post('logout', 'logout');
        Route::post('change-password', 'changePassword');
    });
});

//Guest APIs
Route::get('country', [CountryController::class, 'read']);
Route::get('stage', [StageController::class, 'read']);
Route::get('edu-subject', [EduSubjectController::class, 'read']);


Route::middleware('apiAuth:teacher')->group(function (){

    //Teacher Data
    Route::controller(RegisterController::class)->group(function (){
        Route::get('my-info', 'read');
        Route::put('my-info', 'update');
    });

    //Courses
    Route::get('course', [CourseController::class, 'read']);

    //Chapters
    Route::get('chapter', [ChapterController::class,'read']);

    //Lessons
    Route::get('lesson', [LessonController::class,'read']);

    //Language
    Route::get('language', [LanguageController::class, 'read']);

    Route::get('payments', [PaymentsController::class, 'read']);

    //Bank Questions
    Route::controller(BankQuestionController::class)->group(function (){
        Route::get('bank-question', 'read');
        Route::post('bank-question', 'create');
        Route::put('bank-question', 'update');
        Route::delete('bank-question', 'delete');
    });

    //Material
    Route::controller(MaterialController::class)->group(function (){
        Route::get('material', 'read');
        Route::post('material', 'create');
        Route::put('material', 'update');
    });

    //Payment Request
    Route::controller(PaymentRequestController::class)->group(function (){
        Route::get('payment-request', 'read');
        Route::post('payment-request', 'create');
    });

    //Payment Request
    Route::controller(CourseRequestController::class)->group(function (){
        Route::get('course-request', 'read');
        Route::post('course-request', 'create');
        Route::put('course-request', 'update');
    });

});

