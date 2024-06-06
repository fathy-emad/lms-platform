<?php

use App\Http\Controllers\SettingEducation\Chapter\ChapterController;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumController;
use App\Http\Controllers\SettingEducation\EduSubject\EduSubjectController;
use App\Http\Controllers\SettingEducation\Lesson\LessonController;
use App\Http\Controllers\SettingEducation\Stage\StageController;
use App\Http\Controllers\SettingEducation\Subject\SubjectController;
use App\Http\Controllers\SettingEducation\Year\YearController;
use App\Http\Controllers\Teacher\BankQuestion\BankQuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api settings education" middleware group. Make something great!
|
*/

Route::middleware(['apiAuth:admin', 'apiPermission'])->group(function (){

    //Edu Subjects
    Route::controller(EduSubjectController::class)->group(function (){
        Route::get('edu-subject', 'read');
        Route::post('edu-subject', 'create');
        Route::put('edu-subject', 'update');
    });

    //Stage
    Route::controller(StageController::class)->group(function (){
        Route::get('stage', 'read');
        Route::post('stage', 'create');
        Route::put('stage', 'update');
        Route::post('stage/reorder', 'reorder');
    });

    //Year
    Route::controller(YearController::class)->group(function (){
        Route::get('year', 'read');
        Route::post('year', 'create');
        Route::put('year', 'update');
        Route::post('year/reorder', 'reorder');
    });

    //Subject
    Route::controller(SubjectController::class)->group(function (){
        Route::get('subject', 'read');
        Route::post('subject', 'create');
        Route::put('subject', 'update');
    });

    //Curriculum
    Route::controller(CurriculumController::class)->group(function (){
        Route::get('curriculum', 'read');
        Route::post('curriculum', 'create');
        Route::put('curriculum', 'update');
    });

    //Branch
    Route::controller(ChapterController::class)->group(function (){
        Route::get('chapter', 'read');
        Route::post('chapter', 'create');
        Route::put('chapter', 'update');
    });

    //Lesson
    Route::controller(LessonController::class)->group(function (){
        Route::get('lesson', 'read');
        Route::post('lesson', 'create');
        Route::put('lesson', 'update');
    });

    //Bank Questions
    Route::controller(BankQuestionController::class)->group(function (){
        Route::get('bank-question', 'read');
        Route::post('bank-question', 'create');
        Route::put('bank-question', 'update');
        Route::delete('bank-question', 'delete');
    });
});
