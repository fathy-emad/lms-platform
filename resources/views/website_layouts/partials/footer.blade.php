@if (Route::is(['student.website', 'student.profile', 'student.website', 'student.curricula', 'student.courses', 'student.course', 'student.cart', 'student.invoices', 'student.enrolled_courses']))
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consequat mauris Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit. Ut consequat mauris</p>
                            </div>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-2 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Instructor</h2>
                            <ul>
                                <li><a href="{{ url('instructor-profile') }}">Profile</a></li>
                                <li><a href="{{ url('login') }}">Login</a></li>
                                <li><a href="{{ url('register') }}">Register</a></li>
                                <li><a href="{{ url('instructor-list') }}">Instructor</a></li>
                                <li><a href="{{ url('instructor-dashboard') }}"> Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-2 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Student</h2>
                            <ul>
                                <li><a href="{{ url('student-profile') }}">Profile</a></li>
                                <li><a href="{{ url('login') }}">Login</a></li>
                                <li><a href="{{ url('register') }}">Register</a></li>
                                <li><a href="{{ url('students-list') }}">Student</a></li>
                                <li><a href="{{ url('student-dashboard') }}"> Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->

                    </div>

                    <div class="col-lg-4 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-contact">
                            <h2 class="footer-title">News letter</h2>
                            <div class="news-letter">
                                <form>
                                    <input type="text" class="form-control" placeholder="Enter your email address"
                                        name="email">
                                </form>
                            </div>
                            <div class="footer-contact-info">
                                <div class="footer-address">
                                    <img src="{{ URL::asset('/build/img/icon/icon-20.svg') }}" alt=""
                                        class="img-fluid">
                                    <p> 3556 Beech Street, San Francisco,<br> California, CA 94108 </p>
                                </div>
                                <p>
                                    <img src="{{ URL::asset('/build/img/icon/icon-19.svg') }}" alt=""
                                        class="img-fluid">
                                    dreamslms@example.com
                                </p>
                                <p class="mb-0">
                                    <img src="{{ URL::asset('/build/img/icon/icon-21.svg') }}" alt=""
                                        class="img-fluid">
                                    +19 123-456-7890
                                </p>
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
                                    <li><a href="{{ url('term-condition') }}">Terms</a></li>
                                    <li><a href="{{ url('privacy-policy') }}">Privacy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="copyright-text">
                                <p class="mb-0">&copy;
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> DreamsLMS. All rights reserved.
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
