@extends('dashboard_layouts.authentication.master')
@section('title', 'Forget password')

@section('css') @endsection

@section('style') @endsection

@section('content')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <div>
                            <div><a class="logo" href="#"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
                            <div class="login-main">
                                <form novalidate="" class="theme-form needs-validation mb-5" id="form" method="POST"
                                      action="{{ url("api/admin/auth/forget-password") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                    <h4>Reset Your Password</h4>
                                    <div class="form-group">
                                        <label class="col-form-label" for="email">Enter Your Email</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="email" class="form-control mb-1" id="email" name="email" placeholder=example@example.com">
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block m-t-10" id="forget" type="button" onclick="submitForm(this, null)">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                      action="{{ url("api/admin/auth/new-password") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                    <div class="form-group mb-5">
                                        <label class="col-form-label pt-0">Enter OTP</label>
                                        <div class="row">
                                            <div class="col">
                                                <label>
                                                    <input class="form-control text-center opt-text" name="verifyToken[0]" type="text" value="00" maxlength="2">
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label>
                                                    <input class="form-control text-center opt-text" name="verifyToken[1]" type="text" value="00" maxlength="2">
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label>
                                                    <input class="form-control text-center opt-text" name="verifyToken[2]" type="text" value="00" maxlength="2">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="mt-4">Create Your Password</h6>
                                    <div class="form-group">
                                        <input type="hidden" name="email" id="newPasswordEmail">
                                        <label class="col-form-label" for="password">New Password</label>
                                        <input class="form-control" type="password" id="password" name="password" required="" placeholder="*********">
                                        <div class="show-hide" style="margin-top: 15px !important;"><span class="show"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="password_confirmation">Retype Password</label>
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required="" placeholder="*********">
                                        <div class="show-hide" style="margin-top: 15px !important;"><span class="show"></span></div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary btn-block" type="button" onclick="submitForm(this, null, onNewPasswordSuccess)">Done</button>
                                    </div>
                                    <p class="mt-4 mb-0">Already have an password?<a class="ms-2" href="{{ route('admin.auth.login') }}">Sign in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/login.js')}}"></script>
    <script>

        let onNewPasswordSuccess = function () {
            window.location = APP_URL + "/admin/auth/login";
        };

        $("#email").on("input", function (){
            let value = $(this).val();
            $("#newPasswordEmail").val(value);
        })

        $(function (){

            $('.show-hide').show();
            $('.show-hide span').addClass('show');

            $('.show-hide span').click(function () {

                let name = $(this).parent().prev().attr("name");

                if ($(this).hasClass('show')) {
                    $('input[name="' + name + '"]').attr('type', 'password');
                    $(this).addClass('show');
                } else {
                    $('input[name="' + name + '"]').attr('type', 'text');
                    $(this).removeClass('show');
                }
            });
        })
    </script>
@endsection
