<?php

use App\Http\Controllers\Admin\EducationSystem\EducationStage\EducationStageController;
use App\Http\Controllers\Admin\EducationSystem\EducationYear\EducationYearController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api admin education system" middleware group. Make something great!
|
*/

Route::middleware('apiAuth:admin')->group(function (){

    //Education Stage
    Route::controller(EducationStageController::class)->group(function (){
        Route::get('education-stage', 'read');
        Route::post('education-stage', 'create');
        Route::put('education-stage', 'update');
    });

    //Education year
    Route::controller(EducationYearController::class)->group(function (){
        Route::get('education-year', 'read');
        Route::post('education-year', 'create');
        Route::put('education-year', 'update');
    });

});
