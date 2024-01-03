<?php

use App\Http\Controllers\Admin\Employees\Administrator\AdministratorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api admin employees" middleware group. Make something great!
|
*/

Route::middleware('apiAuth:admin')->group(function (){

    //Employee
    Route::controller(AdministratorController::class)->group(function (){
        Route::get('administrator', 'read');
        Route::post('administrator', 'create');
        Route::put('administrator', 'update');
    });
});
