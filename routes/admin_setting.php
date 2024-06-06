<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setting\Country\CountryController;
use App\Http\Controllers\Setting\Language\LanguageController;
use App\Http\Controllers\Setting\RouteItem\RouteItemController;
use App\Http\Controllers\Setting\RouteMenu\RouteMenuController;

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

Route::middleware(['apiAuth:admin', 'apiPermission'])->group(function (){

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


    //Route Menu
    Route::controller(RouteMenuController::class)->group(function (){
        Route::get('route-menu', 'read');
        Route::post('route-menu', 'create');
        Route::put('route-menu', 'update');
        Route::post('route-menu/reorder', 'reorder');
    });

    //Route Items
    Route::controller(RouteItemController::class)->group(function (){
        Route::get('route-item', 'read');
        Route::post('route-item', 'create');
        Route::put('route-item', 'update');
        Route::post('route-item/reorder', 'reorder');
    });

});
