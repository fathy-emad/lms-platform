@if (Route::is([
    'student.website',
    'student.profile',
    'student.website',
    'student.curricula',
    'student.courses',
    'student.course',
    'student.cart',
    'student.invoices',
    'student.enrolled_courses',
    'student.profile.settings.edit-profile',
    'student.terms_condition',
    'student.privacy_policy',
    'student.faqs',
    'student.lesson',
    'student.support',
    'student.teacher.profile',
    'student.teacher.courses'
]))
    <!-- Footer -->
    <footer class="footer">

        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <!-- Footer Widget -->
                        <div class="footer-widget footer-about">
                            <div class="footer-logo">
                                <img src="{{ URL::asset('/build/img/logo.svg') }}" alt="logo">
                            </div>
                            <div class="footer-about-content">
                                <p>{{ __("lang.website_bio") }}</p>
                            </div>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-1 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">{{ __("lang.teacher") }}</h2>
                            <ul>
                                <li><a href="{{ Route('teacher.dashboard') }}">{{ __("lang.dashboard") }}</a></li>
                                <li><a href="{{ route('teacher.auth.login') }}">{{ __("lang.login") }}</a></li>
                                <li><a href="{{ route('teacher.auth.register') }}">{{ __("lang.register") }}</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-1 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">{{ __("lang.student") }}</h2>
                            <ul>
                                <li><a href="{{ Route('student.profile') }}">{{ __("lang.profile") }}</a></li>
                                <li><a href="{{ route('student.profile.settings.edit-profile') }}">{{ __("lang.settings") }}</a></li>
                                <li><a href="{{ route('student.auth.login') }}">{{ __("lang.login") }}</a></li>
                                <li><a href="{{ route('student.auth.register') }}">{{ __("lang.register") }}</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-2 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">Loomyedu</h2>
                            <ul>
                                <li><a href="{{ Route('student.profile') }}">{{ __("lang.blogs") }}</a></li>
                                <li><a href="{{ Route('student.faqs') }}">{{ __("lang.faqs") }}</a></li>
                                <li><a href="{{ Route('student.support') }}">{{ __("lang.support") }}</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-4 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-contact">
                            <h2 class="footer-title">{{ __("lang.find_us") }}</h2>
                            <div class="footer-contact-info">
                                <div class="footer-address">
                                    <img src="{{ URL::asset('/build/img/icon/icon-20.svg') }}" alt=""
                                        class="img-fluid">
                                    <p> 3556 Omer ibn alkhatab Street, Cairo,<br> Egypte, CA 94108 </p>
                                </div>
                                <p>
                                    <img src="{{ URL::asset('/build/img/icon/icon-19.svg') }}" alt=""
                                        class="img-fluid">
                                    loomyacademy@loomyacademy.com
                                </p>
                                <p class="mb-0">
                                    <img src="{{ URL::asset('/build/img/icon/icon-21.svg') }}" alt=""
                                        class="img-fluid">
                                    <span dir="ltr">+20 111-322-2537</span>
                                </p>
                            </div>
                            <div class="social-icon-soon mt-3 justify-content-start">
                                <ul class="justify-content-start">
                                    <li><a href="javascript:;"><i class="fa-brands fa-youtube you-tube"></i></a></li>
                                    <li><a href="javascript:;"><i class="fa-brands fa-facebook face-book"></i></a></li>
                                    <li><a href="javascript:;"><i class="fa-brands fa-twitter twit-ter"></i></a></li>
                                    <li><a href="javascript:;"><i class="fa-brands fa-instagram insta-gram"></i></a></li>
                                    <li><a href="javascript:;"><i class="fa-brands fa-tiktok"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                </div>
            </div>
        </div>
        <!-- /Footer Top -->

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">

                <!-- Copyright -->
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="privacy-policy">
                                <ul>
                                    <li><a href="{{ Route('student.terms_condition') }}">{{ __("lang.terms_condition") }}</a></li>
                                    <li><a href="{{ Route('student.privacy_policy') }}">{{ __("lang.privacy_policy") }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="copyright-text">
                                <p class="mb-0">&copy;
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> Loomyedu. {{ __("lang.all_rights") }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Copyright -->

            </div>
        </div>
        <!-- /Footer Bottom -->

    </footer>
    <!-- /Footer -->
@endif
