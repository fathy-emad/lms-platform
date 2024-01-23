<?php

use App\Http\Controllers\Setting\Country\CountryController;
use App\Http\Controllers\Setting\Enumeration\EnumerationController;
use App\Http\Controllers\Setting\Language\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api settings" middleware group. Make something great!
|
*/

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


    //Enumeration
    Route::controller(EnumerationController::class)->group(function (){
        Route::get('enumeration', 'read');
        Route::post('enumeration', 'create');
        Route::put('enumeration', 'update');
    });
});
