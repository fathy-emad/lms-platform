<?php

use App\Http\Controllers\Admin\Administrator\AdministratorController;
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

//Language
Route::controller(LanguageController::class)->group(function (){
    Route::get('language', 'read');
    Route::post('language', 'create');
    Route::put('language', 'update');
    Route::delete('language', 'delete');
});

//Country
Route::controller(CountryController::class)->group(function (){
    Route::get('country', 'read');
    Route::post('country', 'create');
    Route::put('country', 'update');
    Route::delete('country', 'delete');
});

//Admin
Route::controller(AdministratorController::class)->group(function (){
   Route::get('Administrator', 'read');
   Route::post('Administrator', 'create');
   Route::put('Administrator', 'update');
   Route::delete('Administrator', 'delete');
});
