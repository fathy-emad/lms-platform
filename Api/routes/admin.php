<?php

use App\Http\Controllers\Admin\Administrator\AdministratorController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Country\CountryController;
use App\Http\Controllers\Admin\Language\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth
Route::controller(AuthController::class)->group(function (){
    Route::post('login', 'login');
//    Route::post('forget-password', 'forgetPassword');
//    Route::post('verify-token', 'verifyToken');
//    Route::post('new-password', 'newPassword');

    Route::post('logout', 'logout')->middleware('apiAuth:admin');
//    Route::post('change-password', 'changePassword')->middleware('apiAuth:admin');
//    Route::post('change-email', 'changeEmail')->middleware('apiAuth:admin');
});

Route::middleware('apiAuth:admin')->group(function (){

    //Language
    Route::controller(LanguageController::class)->group(function (){
        Route::get('language', 'read');
        Route::post('language', 'create');
        Route::put('language', 'update');
    });

    //Country
    Route::controller(CountryController::class)->group(function (){
        Route::get('country', 'read');
        Route::post('country', 'create');
        Route::put('country', 'update');
    });

    //Admin
    Route::controller(AdministratorController::class)->group(function (){
        Route::get('administrator', 'read');
        Route::post('administrator', 'create');
        Route::put('administrator', 'update');
    });
});
