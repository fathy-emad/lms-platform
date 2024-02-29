<?php

use App\Http\Controllers\Setting\Country\CountryController;
use App\Http\Controllers\Setting\Enumeration\EnumerationController;
use App\Http\Controllers\Setting\Language\LanguageController;
use App\Http\Controllers\Setting\RouteMenu\RouteMenuController;
use App\Http\Controllers\Setting\RouteItem\RouteItemController;
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

Route::middleware(['apiAuth:admin'])->group(function (){

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

    //Route Menu
    Route::controller(RouteMenuController::class)->group(function (){
        Route::get('route-menu', 'read');
        Route::post('route-menu', 'create');
        Route::put('route-menu', 'update');
    });

    //Route Items
    Route::controller(RouteItemController::class)->group(function (){
        Route::get('route-item', 'read');
        Route::post('route-item', 'create');
        Route::put('route-item', 'update');
    });

    Route::get("test", function (){
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            // Get the HTTP methods the route responds to
            $methods = implode(', ', $route->methods());

            // Get the URI
            $uri = $route->uri();

            // Get the action name
            $action = $route->getActionName();

            // Optionally, split the controller and method if specifically needed
            // Skip if the route does not have an associated controller action (e.g., closures)
            if (str_contains($action, '@')) {
                list($controller, $method) = explode('@', $action);
            } else {
                $controller = 'Closure';
                $method = '';
            }

            // Output or store the route information
            echo "Method: $methods, URI: $uri, Action: $action, Controller: $controller, Method: $method" . ">>>>>>>>>>>>>>>" . PHP_EOL;
        }
    });
});
