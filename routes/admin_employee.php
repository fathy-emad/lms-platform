<?php

use App\Http\Controllers\Employee\Permission\PermissionController;
use App\Http\Controllers\Employee\Register\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api employee" middleware group. Make something great!
|
*/

Route::middleware(['apiAuth:admin', 'apiPermission'])->group(function (){

    //Register
    Route::controller(RegisterController::class)->group(function (){
        Route::get('register', 'read');
        Route::post('register', 'create');
        Route::put('register', 'update');
    });

    //Permission
    Route::controller(PermissionController::class)->group(function (){
        Route::get('permission', 'read');
        Route::post('permission', 'create');
        Route::put('permission', 'update');
        Route::delete('permission', 'delete');
    });
});
