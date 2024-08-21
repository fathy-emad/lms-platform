<!DOCTYPE html>
<html lang="{{ app()->getLocale() == "ar" ? "ar" : "en" }}">

<head>
    @include('website_layouts.partials.head')
</head>

<body dir="{{ app()->getLocale() == "ar" ? "rtl" : "ltr" }}">

@if (Route::is(['coming-soon', 'error-404', 'error-500', 'under-construction']))<body class="error-page" dir="{{ app()->getLocale() == "ar" ? "rtl" : "ltr" }}">@endif
@if (Route::is(['student-messages','instructor-chat']))<body class="chat-page main-chat-blk" dir="{{ app()->getLocale() == "ar" ? "rtl" : "ltr" }}">@endif
@if (Route::is(['student-messages','instructor-chat']))<div class="main-wrapper chat-wrapper">@endif
@if (!Route::is(['student.auth.login', 'student.auth.register','student-messages','instructor-chat']))<div class="main-wrapper">@endif
@if (Route::is(['student.auth.login', 'student.auth.register']))<div class="main-wrapper log-wrap">@endif
@if (!Route::is([
        'coming-soon',
        'error-404',
        'error-500',
        'student.auth.forget-password',
        'student.auth.login',
        'new-password',
        'register-step-five',
        'register-step-four',
        'register-step-one',
        'register-step-three',
        'register-step-two',
        'student.auth.register',
        'under-construction',
        'verification-code',
        'view-invoice'
    ]))
    @include('website_layouts.partials.header')
@endif
@yield('content')
@if(! Route::is([
        'coming-soon',
        'error-404',
        'error-500',
        'student.auth.forget-password',
        'student.auth.login',
        'new-password',
        'register-step-five',
        'register-step-four',
        'register-step-one',
        'register-step-three',
        'register-step-two',
        'student.auth.register',
        'under-construction',
        'verification-code',
    ]))
    @include('website_layouts.partials.footer')
@endif
</div>
<!-- /Main Wrapper -->
@include('website_layouts.partials.footer-scripts')

</body>

</html>
