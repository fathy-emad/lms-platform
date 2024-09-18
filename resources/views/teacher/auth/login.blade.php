@extends('teacher_dashboard_layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" width="200" height="200" src="{{asset('build/img/instructor.webp')}}" alt="looginpage"></div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-start" href="#"><img class="img-fluid for-light" width="175" height="40" src="{{asset('build/img/logo.svg')}}" alt="looginpage"><img class="img-fluid for-dark" width="175" height="40" src="{{asset('build/img/logo_dark.svg')}}" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                  action="{{ url("api/teacher/auth/login") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label" for="email">Email Address</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="example@gmail.com" required/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="password">Password</label>
                                    <input class="form-control" id="password" type="password" name="password" placeholder="*********" required/>
                                    <div class="show-hide" style="margin-top: 15px !important;"><span class="show"></span></div>
                                </div>
                                <div class="form-group mb-0">
                                    <a class="link" href="{{ route('teacher.auth.forget-password') }}">Forgot password?</a>
                                    <button class="btn btn-primary btn-block" onclick="submitForm(this)" type="button">Sign in</button>
                                </div>
{{--                                <h6 class="text-muted mt-4 or">Or Sign in with</h6>--}}
{{--                                <div class="social mt-4">--}}
{{--                                    <div class="btn-showcase">--}}
{{--                                        <a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank">--}}
{{--                                            <i class="txt-google-plus" data-feather="chrome"></i> Google--}}
{{--                                        </a>--}}
{{--                                        <a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank">--}}
{{--                                            <i class="txt-twitter" data-feather="twitter"></i>twitter--}}
{{--                                        </a>--}}
{{--                                        <a class="btn btn-light" href="https://www.facebook.com/" target="_blank">--}}
{{--                                            <i class="txt-fb" data-feather="facebook"></i>facebook--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="{{ route('teacher.auth.register') }}">Create Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/login.js')}}"></script>
@endsection
