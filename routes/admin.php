<?php

use App\Http\Controllers\Setting\FAQ\FAQController;
use App\Http\Controllers\Student\Checkout\CheckoutController;
use App\Http\Controllers\Teacher\CourseRequest\CourseRequestController;
use App\Http\Controllers\Teacher\PaymentRequest\PaymentRequestController;
use App\Http\Controllers\Teacher\Payments\PaymentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdmin\AuthController;
use App\Http\Controllers\Course\Material\MaterialController;
use App\Http\Controllers\Course\Register\CourseController;
use App\Http\Controllers\Employee\Permission\PermissionController;
use App\Http\Controllers\Employee\Register\RegisterController;
use App\Http\Controllers\Setting\Country\CountryController;
use App\Http\Controllers\Setting\Language\LanguageController;
use App\Http\Controllers\Setting\RouteItem\RouteItemController;
use App\Http\Controllers\Setting\RouteMenu\RouteMenuController;
use App\Http\Controllers\SettingEducation\Chapter\ChapterController;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumController;
use App\Http\Controllers\SettingEducation\EduSubject\EduSubjectController;
use App\Http\Controllers\SettingEducation\Lesson\LessonController;
use App\Http\Controllers\SettingEducation\Stage\StageController;
use App\Http\Controllers\SettingEducation\Subject\SubjectController;
use App\Http\Controllers\SettingEducation\Year\YearController;
use App\Http\Controllers\Teacher\BankQuestion\BankQuestionController;
use App\Http\Controllers\Teacher\Register\RegisterController as RegisterTeacherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api admin routes" middleware group. Make something great!
|
*/

Route::prefix('auth')->controller(AuthController::class)->group(function (){

    //Guest
    Route::post('login', 'login');
    Route::post('forget-password', 'forgetPassword');//->middleware('apiThrottle:3,5');
    Route::post('new-password', 'newPassword');//->middleware('apiThrottle:3,5');

    //Auth
    Route::middleware('apiAuth:admin')->group(function (){
        Route::post('logout', 'logout');
        Route::post('change-password', 'changePassword');
    });
});


Route::middleware(['apiAuth:admin', 'apiPermission'])->group(function (){

    //Setting routes
    Route::prefix('setting')->group(function (){

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

        //FAQS
        Route::controller(FAQController::class)->group(function (){
            Route::get('faq', 'read');
            Route::post('faq', 'create');
            Route::put('faq', 'update');
            Route::delete('faq', 'delete');
        });


    });

    //Setting Education
    Route::prefix('setting-education')->group(function (){

        //Edu Subjects
        Route::controller(EduSubjectController::class)->group(function (){
            Route::get('edu-subject', 'read');
            Route::post('edu-subject', 'create');
            Route::put('edu-subject', 'update');
        });

        //Stage
        Route::controller(StageController::class)->group(function (){
            Route::get('stage', 'read');
            Route::post('stage', 'create');
            Route::put('stage', 'update');
            Route::post('stage/reorder', 'reorder');
        });

        //Year
        Route::controller(YearController::class)->group(function (){
            Route::get('year', 'read');
            Route::post('year', 'create');
            Route::put('year', 'update');
            Route::post('year/reorder', 'reorder');
        });

        //Subject
        Route::controller(SubjectController::class)->group(function (){
            Route::get('subject', 'read');
            Route::post('subject', 'create');
            Route::put('subject', 'update');
        });

        //Curriculum
        Route::controller(CurriculumController::class)->group(function (){
            Route::get('curriculum', 'read');
            Route::post('curriculum', 'create');
            Route::put('curriculum', 'update');
        });

        //Chapter
        Route::controller(ChapterController::class)->group(function (){
            Route::get('chapter', 'read');
            Route::post('chapter', 'create');
            Route::put('chapter', 'update');
        });

        //Lesson
        Route::controller(LessonController::class)->group(function (){
            Route::get('lesson', 'read');
            Route::post('lesson', 'create');
            Route::put('lesson', 'update');
        });

        //Bank Questions
        Route::controller(BankQuestionController::class)->group(function (){
            Route::get('bank-question', 'read');
            Route::post('bank-question', 'create');
            Route::put('bank-question', 'update');
            Route::delete('bank-question', 'delete');
        });
    });

    //Employee
    Route::prefix('employee')->group(function (){

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

    //Teacher
    Route::prefix('teacher')->group(function (){

        //Register
        Route::controller(RegisterTeacherController::class)->group(function (){
            Route::get('register', 'read');
            Route::post('register', 'create');
            Route::put('register', 'update');
        });

        //Bank Questions
        Route::controller(BankQuestionController::class)->group(function (){
            Route::get('bank-question', 'read');
            Route::post('bank-question', 'create');
            Route::put('bank-question', 'update');
            Route::delete('bank-question', 'delete');
        });


        Route::controller(PaymentsController::class)->group(function (){
            Route::get('payments', 'read');
        });
    });

    //Course
    Route::prefix('course')->group(function (){

        //Register
        Route::controller(CourseController::class)->group(function (){
            Route::get('register', 'read');
            Route::post('register', 'create');
            Route::put('register', 'update');
        });

        //Material
        Route::controller(MaterialController::class)->group(function (){
            Route::get('material', 'read');
            Route::post('material', 'create');
            Route::put('material', 'update');
        });

    });


    //Requests
    Route::prefix('request')->group(function (){

        //Payment
        Route::controller(PaymentRequestController::class)->group(function (){
            Route::get('payment', 'read');
            Route::put('payment', 'update');
        });

        //Course
        Route::controller(CourseRequestController::class)->group(function (){
            Route::get('course', 'read');
            Route::put('course', 'update');
        });

        //Checkout
        Route::controller(CheckoutController::class)->group(function (){
            Route::post('checkout', 'create');
            Route::get('checkout', 'read');
            Route::delete('checkout', 'delete');
        });

    });
});





