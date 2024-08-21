@if (!Route::is(['student.auth.login', 'new-password', 'student.auth.forget-password', 'student.auth.register', 'verification-code']))
    <!-- Login Banner -->
    <div class="col-lg-4 col-md-6 login-bg">
        <div class="owl-carousel login-slide owl-theme">
            <div class="welcome-login register-step">
                <div class="login-banner">
                    <img src="{{ URL::asset('/build/img/register-img.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Welcome to <br>DreamsLMS Courses.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
            <div class="welcome-login register-step">
                <div class="login-banner">
                    <img src="{{ URL::asset('/build/img/register-img.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Welcome to <br>DreamsLMS Courses.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
            <div class="welcome-login register-step">
                <div class="login-banner">
                    <img src="{{ URL::asset('/build/img/register-img.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Welcome to <br>DreamsLMS Courses.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /Login Banner -->
@endif
@if (Route::is(['student.auth.login', 'new-password', 'student.auth.forget-password', 'student.auth.register', 'verification-code']))
    <!-- Login Banner -->
    <div class="col-md-6 login-bg">
        <div class="owl-carousel login-slide owl-theme">
            <div class="welcome-login">
                <div class="login-banner">
                    <img src="{{ URL::asset('/build/img/register-img.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Welcome to <br>DreamsLMS Courses.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
            <div class="welcome-login">
                <div class="login-banner">
                    <img src="{{ URL::asset('/build/img/login-img.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Welcome to <br>DreamsLMS Courses.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
            <div class="welcome-login">
                <div class="login-banner">
                    <img src="{{ URL::asset('/build/img/login-img.png') }}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Welcome to <br>DreamsLMS Courses.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /Login Banner -->
@endif
