@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.register") }} @endsection
@section('style')
    <style>
        /* Hide the arrow of the number input */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Disable the mouse wheel */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            /* Disable mouse wheel */
            -moz-appearance: textfield;
            -webkit-appearance: none;
            appearance: textfield;
        }

        input[type=number] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
            appearance: textfield;
            /* Disable mouse wheel on focus */
            overflow: hidden;
        }

    </style>
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
                            <a class="text-primary" href="{{ route('student.website') }}">{{ __("lang.back_to_home") }}</a>
                        </div>
                    </div>
                    <h1>{{ __("lang.create_an_account") }}</h1>
                    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                          action="{{ url("api/student/auth/register") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">

                        <div class="input-block">
                            <label class="form-control-label">{{ __("attributes.name") }}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __("lang.place_name") }}" required>
                        </div>

                        <div class="input-block">
                            <label class="add-course-label">{{ __("attributes.gender") }}</label>
                            <select class="form-control form-select" name="GenderEnum" style="border-color: rgba(255, 222, 218, 0.71);" required>
                                @foreach(\App\Enums\GenderEnum::cases() as $gender)
                                    <option value="{{$gender->value}}">{{ __("enum.GenderEnum.".$gender->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label class="add-course-label">{{ __("attributes.country") }}</label>
                                    @php $countries = \App\Models\Country::with("countryTranslate")->get(); @endphp
                                    <select class="form-control form-select" name="country_id" style="border-color: rgba(255, 222, 218, 0.71);">
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->countryTranslate->translates[app()->getLocale()]}} ({{ $country->phone_prefix  }})</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label class="form-control-label">{{ __("attributes.phone") }}</label>
                                    <input type="number" name="phone" step="1" maxlength="10" id="phone"  minlength="10" class="form-control" placeholder="{{ __("lang.place_phone") }}" required/>
                                </div>
                            </div>
                        </div>

                        <div class="input-block">
                            <label class="form-control-label">{{ __("attributes.email") }}</label>
                            <input type="email" name="email" class="form-control" placeholder="{{ __("lang.place_email") }}">
                            <div id="" class="text-primary">{{__("lang.correct_email")}}</div>
                        </div>

                        <div class="input-block">
                            <label class="form-control-label">{{ __("attributes.school") }}</label>
                            <input type="text" class="form-control" name="school" placeholder="{{ __("lang.place_school") }}" required>
                        </div>

                        <div class="input-block">
                            <label class="form-label">{{ __("attributes.born") }}</label>
                            <div class="datepicker-icon">
                                <span class="form-icon">
                                    <i class="bx bx-calendar"></i>
                                </span>
                                <input type="text" name="born" class="form-control datetimepicker">
                            </div>
                        </div>

                        <div class="input-block">
                            <label class="form-control-label">{{ __("attributes.password") }}</label>
                            <div class="pass-group" id="passwordInput">
                                <input type="password" name="password" class="form-control pass-input" placeholder="{{ __("lang.place_password") }}">
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
                            <label class="form-control-label">{{ __("attributes.password_confirmation") }}</label>
                            <div class="pass-group" id="passwordInputConfirmation">
                                <input type="password" name="password_confirmation" class="form-control pass-input" placeholder="{{ __("lang.place_password_confirmation") }}">
                                <span class="toggle-password feather-eye-off"></span>
                                <span class="pass-checked"><i class="feather-check"></i></span>
                            </div>
                        </div>

                        <div class="form-check remember-me">
                            <label class="form-check-label mb-0">
                                <input class="form-check-input" type="checkbox" name="terms_of_service_and_privacy_policy" value="1" required>{{ __("lang.agree") }} <a
                                    href="{{ url('term-condition') }}">{{ __("lang.terms_condition") }}</a> | <a
                                    href="{{ url('privacy-policy') }}">{{ __("lang.privacy_policy") }}.</a>
                            </label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-start" type="button" onclick="submitForm(this, null, successCallback)">{{ __("lang.register") }}</button>
                        </div>
                    </form>
                </div>
                <div class="google-bg text-center" style="height: 34%">
{{--                    <span><a href="#">Or sign in with</a></span>--}}
                    <div class="sign-google">
{{--                        <ul>--}}
{{--                            <li><a href="#"><img src="{{ URL::asset('/build/img/net-icon-01.png') }}"--}}
{{--                                                 class="img-fluid" alt="Logo"> Sign In using Google</a></li>--}}
{{--                            <li><a href="#"><img src="{{ URL::asset('/build/img/net-icon-02.png') }}"--}}
{{--                                                 class="img-fluid" alt="Logo">Sign In using Facebook</a></li>--}}
{{--                        </ul>--}}
                    </div>
                    <p class="mb-0"><span class="text-black">{{ __("lang.have_account") }}</span> <a href="{{ url('login') }}">{{ __("lang.sign_in") }}</a></p>
                </div>
            </div>
            <!-- /Login -->

        </div>

    </div>
@endsection

@section('script')
    <script>
        $("#phone").on("input", function () {
            let value = $(this).val();

            // Regular expression to remove leading zeros
            let newValue = value.replace(/^0+/, '');

            // Limit the length to 10 digits
            newValue = newValue.slice(0, 10);

            // Update the input value if it has changed
            if (value !== newValue) {
                $(this).val(newValue);
            }

        });

        let successCallback = function () {

            window.location = APP_URL + "/login";
        };
    </script>
@endsection
