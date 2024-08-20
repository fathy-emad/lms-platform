@extends('website_layouts.mainlayout')
@section('title') register @endsection
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
                            <a class="text-primary" href="{{ route('student.website') }}">Back to Home</a>
                        </div>
                    </div>
                    <h1>Sign up</h1>
                    <form action="" method="POST">
                        <div class="input-block">
                            <label class="form-control-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter your Full Name">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label class="add-course-label">Country</label>
                                    @php $countries = \App\Models\Country::with("countryTranslate")->get(); @endphp
                                    <select class="form-select select">
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->countryTranslate->translates[app()->getLocale()]}} ({{ $country->phone_prefix  }})</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Phone</label>
                                <input type="number" step="1" maxlength="10" id="phone"  minlength="10" class="form-control" placeholder="Please enter your phone"/>
                            </div>
                        </div>

                        <div class="input-block">
                            <label class="form-control-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="input-block">
                            <label class="form-control-label">Password</label>
                            <div class="pass-group" id="passwordInput">
                                <input type="password" class="form-control pass-input" placeholder="Enter your password">
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

                        <div class="form-check remember-me">
                            <label class="form-check-label mb-0">
                                <input class="form-check-input" type="checkbox" name="remember"> I agree to the <a
                                    href="{{ url('term-condition') }}">Terms of Service</a> and <a
                                    href="{{ url('privacy-policy') }}">Privacy Policy.</a>
                            </label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-start" type="submit">Create Account</button>
                        </div>
                    </form>
                </div>
                <div class="google-bg text-center">
                    <span><a href="#">Or sign in with</a></span>
                    <div class="sign-google">
                        <ul>
                            <li><a href="#"><img src="{{ URL::asset('/build/img/net-icon-01.png') }}"
                                                 class="img-fluid" alt="Logo"> Sign In using Google</a></li>
                            <li><a href="#"><img src="{{ URL::asset('/build/img/net-icon-02.png') }}"
                                                 class="img-fluid" alt="Logo">Sign In using Facebook</a></li>
                        </ul>
                    </div>
                    <p class="mb-0">Already have an account? <a href="{{ url('login') }}">Sign in</a></p>
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
    </script>
@endsection
