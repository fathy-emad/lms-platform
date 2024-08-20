@extends('website_layouts.mainlayout')
@section('title') login @endsection
@section('style')
@endsection

@section('content')
    <div class="row">
        @component('website_layouts.components.loginbanner') @endcomponent
        <div class="col-md-6 login-wrap-bg">
            <!-- Login -->
            <div class="login-wrapper">
                <div class="loginbox">
                    <div class="w-100">
                        <div class="img-logo">
                            <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                            <div class="back-home">
                                <a href="{{ route('student.website') }}" class="text-primary">Back to Home</a>
                            </div>
                        </div>
                        <h1>Sign in to Your Account</h1>

                        <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                              action="{{ url("api/student/auth/login") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">

                            <div class="input-block">
                                <label class="form-control-label">Email</label>
                                <input type="email" class="form-control" value="" name="email"
                                       id="email"/>
                            </div>
                            <div class="input-block">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" value="" name="password"
                                           id="password">
                                    <span class="feather-eye-off toggle-password"></span>
                                </div>
                            </div>
                            <div class="forgot">
                                <span><a class="forgot-link" href="{{ url('forgot-password') }}">Forgot Password?</a></span>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-start" type="button" onclick="submitForm(this, null)">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="google-bg text-center" style="height: 34%">
{{--                    <span><a href="#" class="text-black">Or sign in with</a></span>--}}
                    <div class="sign-google">
{{--                        <ul>--}}
{{--                            <li><a href="#"><img src="{{ URL::asset('/build/img/net-icon-01.png') }}"--}}
{{--                                                 class="img-fluid" alt="Logo"> Sign In using Google</a></li>--}}
{{--                            <li><a href="#"><img src="{{ URL::asset('/build/img/net-icon-02.png') }}"--}}
{{--                                                 class="img-fluid" alt="Logo">Sign In using Facebook</a></li>--}}
{{--                        </ul>--}}
                    </div>
                    <p class="mb-0"><span class="text-black"> New student ?</span> <a href="{{ route('student.auth.register') }}">Create an Account</a></p>
                </div>
            </div>
            <!-- /Login -->

        </div>
    </div>
@endsection

@section('script')
@endsection
