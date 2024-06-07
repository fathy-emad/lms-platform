<?php

use App\Http\Controllers\AuthStudent\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api student auth" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function (){

    //Guest
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('reset-password', 'resetPassword'); //->middleware('apiThrottle:1,5')
    Route::post('verify-token', 'verifyToken'); //->middleware('apiThrottle:3,1')
    Route::post('new-password', 'newPassword');

    //Auth
    Route::middleware('apiAuth:admin')->group(function (){
        Route::post('logout', 'logout');
        Route::post('change-password', 'changePassword');
    });
});
