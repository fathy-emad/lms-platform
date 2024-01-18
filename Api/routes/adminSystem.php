<?php

use App\Http\Controllers\Admin\System\Curriculum\CurriculumController;
use App\Http\Controllers\Admin\System\Stage\StageController;
use App\Http\Controllers\Admin\System\Subject\SubjectController;
use App\Http\Controllers\Admin\System\Branch\BranchController;
use App\Http\Controllers\Admin\System\Year\YearController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api admin system" middleware group. Make something great!
|
*/

Route::middleware('apiAuth:admin')->group(function (){

    //Stage
    Route::controller(StageController::class)->group(function (){
        Route::get('stage', 'read');
        Route::post('stage', 'create');
        Route::put('stage', 'update');
    });

    //Year
    Route::controller(YearController::class)->group(function (){
        Route::get('year', 'read');
        Route::post('year', 'create');
        Route::put('year', 'update');
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
    Route::controller(BranchController::class)->group(function (){
        Route::get('branch', 'read');
        Route::post('branch', 'create');
        Route::put('branch', 'update');
    });
});
