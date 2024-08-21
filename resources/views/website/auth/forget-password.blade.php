@extends('website_layouts.mainlayout')
@section('title') Forget password @endsection
@section('style')
@endsection

@section('content')
    <div class="row">
        @component('website_layouts.components.loginbanner') @endcomponent
        <div class="col-md-6 login-wrap-bg">
            <!-- Login -->
            <div class="login-wrapper">
                <div class="loginbox">
                    <div class="img-logo">
                        <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                        <div class="back-home">
                            <a class="text-primary" href="{{ url('student.website') }}">Back to Home</a>
                        </div>
                    </div>
                    <h1>Forgot Password ?</h1>
                    <div class="reset-password">
                        <p>Enter your email to reset your password.</p>
                    </div>
                    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                          action="{{ url("api/student/auth/forget-password") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">

                        <div class="input-block">
                            <label class="form-control-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-start" type="button" onclick="submitForm(this)">Send OTP</button>
                        </div>
                    </form>

                    <h1 class="mt-5">Enter Verification Code</h1>
                    <div class="reset-password">
                        <p>We have just sent a verification code to your registered email</p>
                    </div>
                    <form novalidate="" class="theme-form needs-validation " id="form" method="POST"
                          action="{{ url("api/student/auth/new-password") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex digit-group">
                                    <input type="text" class="form-control" id="digit-1" name="verifyToken[0]"
                                           data-next="digit-2" value="" />

                                    <input type="text" class="form-control" id="digit-2" name="verifyToken[1]"
                                           data-next="digit-3" data-previous="digit-1" />

                                    <input type="text" class="form-control" id="digit-3" name="verifyToken[2]"
                                           data-next="digit-4" data-previous="digit-2" />

                                    <input type="text" class="form-control" id="digit-4" name="verifyToken[3]"
                                           data-next="digit-5" data-previous="digit-3" />

                                    <input type="text" class="form-control" id="digit-5" name="verifyToken[4]"
                                           data-next="digit-6" data-previous="digit-4" />

                                    <input type="text" class="form-control" id="digit-6" name="verifyToken[5]"
                                           data-next="digit-7" data-previous="digit-5" />
                                </div>
                            </div>
                        </div>

                        <div class="input-block mt-3">
                            <input type="hidden" name="email" id="newPasswordEmail">
                            <label class="form-control-label">Password</label>
                            <div class="pass-group" id="passwordInput">
                                <input type="password" name="password" class="form-control pass-input" placeholder="Enter your password">
                                <span class="toggle-password feather-eye-off"></span>
                                <span class="pass-checked"><i class="feather-check"></i></span>
                            </div>
                            <div class="password-strength" id="passwordStrength">
                                <span id="poor"></span>
                                <span id="weak"></span>
                                <span id="strong"></span>
                                <span id="heavy"></span>
                            </div>
                            <div id="passwordInfo"></div>
                        </div>

                        <div class="input-block">
                            <label class="form-control-label">Password confirmation</label>
                            <div class="pass-group" id="passwordInputConfirmation">
                                <input type="password" name="password_confirmation" class="form-control pass-input" placeholder="Enter your password confirmation">
                                <span class="toggle-password feather-eye-off"></span>
                                <span class="pass-checked"><i class="feather-check"></i></span>
                            </div>
                        </div>

                        <div class="form-check remember-me">
                            <label class="form-check-label mb-0">
                                <input class="form-check-input" type="checkbox" name="terms_of_service_and_privacy_policy" value="1" required> I agree to the <a
                                    href="{{ url('term-condition') }}">Terms of Service</a> and <a
                                    href="{{ url('privacy-policy') }}">Privacy Policy.</a>
                            </label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-start" type="button" onclick="submitForm(this, null, successCallback)">Create new Password</button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /Login -->

        </div>


    </div>
@endsection


@section('script')
    <script>

        $("#email").on("input", function (){
            let value = $(this).val();
            $("#newPasswordEmail").val(value);
        });

        let successCallback = function () {

            window.location = APP_URL + "/login";
        };
    </script>
@endsection
