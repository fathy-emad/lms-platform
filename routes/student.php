<?php

use App\Concretes\CheckoutPaytabs;
use App\Http\Controllers\AuthStudent\AuthController;
use App\Http\Controllers\Student\Cart\CartController;
use App\Http\Controllers\Student\Checkout\CheckoutController;
use App\Http\Controllers\Student\Invoice\InvoiceController;
use App\Http\Controllers\Student\Register\RegisterController;
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


//Paytabs callback
Route::controller(CheckoutPaytabs::class)->group(function (){
    // Route for handling the return URL (redirects user back after payment)
    Route::get('/payment/callback/{invoice_id}', 'handleReturnPaytabs')
        ->name('payment.callback');

    // Route for handling the callback URL (used by PayTabs to notify your server)
    Route::post('/payment/paytabs/callback', 'handleCallbackPaytabs')
        ->name('payment.paytabs.callback');
});

Route::prefix('auth')->controller(AuthController::class)->group(function (){

    //Guest
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forget-password', 'forgetPassword');//->middleware('apiThrottle:3,5');
    Route::post('new-password', 'newPassword');//->middleware('apiThrottle:3,5');

    //Auth
    Route::middleware('apiAuth:student')->group(function (){
        Route::post('logout', 'logout');
        Route::post('change-password', 'changePassword');
    });
});

Route::middleware(['apiAuth:student'])->group(function () {

    //Cart
    Route::controller(CartController::class)->group(function (){
        Route::post('cart', 'create');
        Route::get('cart', 'read');
        Route::delete('cart', 'delete');
    });

    //Checkout
    Route::controller(CheckoutController::class)->group(function (){
        Route::post('checkout', 'create');
        Route::get('checkout', 'read');
        Route::get('checkout/callback', 'callback');
    });

    //Invoice
    Route::controller(InvoiceController::class)->group(function (){
        Route::post('invoice', 'create');
        Route::get('Invoice', 'read');
    });

    //Register
    Route::controller(RegisterController::class)->group(function (){
        Route::get('register', 'read');
        Route::put('register', 'update');
    });

});



