<?php


use App\Http\Controllers\Teacher\Register\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api teacher" middleware group. Make something great!
|
*/

Route::middleware('apiAuth:admin')->group(function (){

    //Register
    Route::controller(RegisterController::class)->group(function (){
        Route::get('register', 'read');
        Route::post('register', 'create');
        Route::put('register', 'update');
    });

});
