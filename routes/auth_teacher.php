<?php

use App\Http\Controllers\AuthTeacher\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api auth teacher" middleware group. Make something great!
|
*/

//Guest
Route::controller(AuthController::class)->group(function (){
    Route::post('login', 'login');
    //Route::post('forget-password', 'forgetPassword');
    //Route::post('verify-token', 'verifyToken');
    //Route::post('new-password', 'newPassword');

    //Auth
    Route::middleware('apiAuth:teacher')->group(function (){
        Route::post('logout', 'logout');
        //Route::post('change-password', 'changePassword');
        //Route::post('change-email', 'changeEmail');
    });
});
