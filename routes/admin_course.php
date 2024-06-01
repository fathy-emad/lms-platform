<?php

use App\Http\Controllers\Course\Material\MaterialController;
use App\Http\Controllers\Course\Register\CourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api course" middleware group. Make something great!
|
*/

Route::middleware(['apiAuth:admin', 'apiPermission'])->group(function (){

    //Register
    Route::controller(CourseController::class)->group(function (){
        Route::get('register', 'read');
        Route::post('register', 'create');
        Route::put('register', 'update');
    });

    //Material
    Route::controller(MaterialController::class)->group(function (){
        Route::get('material', 'read');
        Route::post('material', 'create');
        Route::put('material', 'update');
    });

});
