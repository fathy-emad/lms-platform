@php
    $students_count = \App\Models\Enrollment::count();
    $courses_count = \App\Models\Course::count();
@endphp
<section class="section latest-blog">
    <div class="container">
{{--        <div class="section-header aos" data-aos="fade-up">--}}
{{--            <div class="section-sub-head feature-head text-center mb-0">--}}
{{--                <h2>Latest Blogs</h2>--}}
{{--                <div class="section-text aos" data-aos="fade-up">--}}
{{--                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan--}}
{{--                        bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="owl-carousel blogs-slide owl-theme aos" data-aos="fade-up">--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-01.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">Attract More Attention Sales And Profits</a></h5>--}}
{{--                    <p>Marketing</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>Jun 15, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">11 Tips to Help You Get New Clients</a></h5>--}}
{{--                    <p>Sales Order</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>May 20, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">An Overworked Newspaper Editor</a></h5>--}}
{{--                    <p>Design</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>May 25, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-04.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">A Solution Built for Teachers</a></h5>--}}
{{--                    <p>Seo</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>Jul 15, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">Attract More Attention Sales And Profits</a></h5>--}}
{{--                    <p>Marketing</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>Sep 25, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">An Overworked Newspaper Editor</a></h5>--}}
{{--                    <p>Marketing</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>May 25, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-04.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">A Solution Built for Teachers</a></h5>--}}
{{--                    <p>Analysis</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>May 15, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">11 Tips to Help You Get New Clients</a></h5>--}}
{{--                    <p>Development</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>Jun 20, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">An Overworked Newspaper Editor</a></h5>--}}
{{--                    <p>Sales</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>May 25, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instructors-widget blog-widget">--}}
{{--                <div class="instructors-img">--}}
{{--                    <a href="{{ url('blog-list') }}">--}}
{{--                        <img class="img-fluid" alt="Img"--}}
{{--                             src="{{ URL::asset('/build/img/blog/blog-04.jpg') }}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="instructors-content text-center">--}}
{{--                    <h5><a href="{{ url('blog-list') }}">A Solution Built for Teachers</a></h5>--}}
{{--                    <p>Marketing</p>--}}
{{--                    <div class="student-count d-flex justify-content-center">--}}
{{--                        <i class="fa-solid fa-calendar-days"></i>--}}
{{--                        <span>April 15, 2022</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="lab-course">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <h2>Unlimited access to 360+ courses <br>and 1,600+ hands-on labs</h2>
                </div>
            </div>
            {{--            <div class="icon-group aos" data-aos="fade-up">--}}
            {{--                <div class="offset-lg-1 col-lg-12">--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-09.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-10.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-16.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-12.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-13.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-14.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-15.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-16.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-17.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-1 col-3">--}}
            {{--                            <div class="total-course d-flex align-items-center">--}}
            {{--                                <div class="blur-border">--}}
            {{--                                    <div class="enroll-img ">--}}
            {{--                                        <img src="{{ URL::asset('/build/img/icon/icon-18.svg') }}" alt="Img"--}}
            {{--                                             class="img-fluid">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="enroll-group aos" data-aos="fade-up">
            <div class="row ">
                <div class="col-lg-4 col-md-6">
                    <div class="total-course d-flex align-items-center">
                        <div class="blur-border">
                            <div class="enroll-img ">
                                <img src="{{ URL::asset('/build/img/icon/icon-07.svg') }}" alt="Img"
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="course-count">
{{--                            <h3><span class="counterUp">{{ __($students_count) }}</span></h3>--}}
                            <h3><span class="counterUp">25000</span>+</h3>
                            <p>{{ __("lang.student_enrolled") }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="total-course d-flex align-items-center">
                        <div class="blur-border">
                            <div class="enroll-img ">
                                <img src="{{ URL::asset('/build/img/icon/icon-08.svg') }}" alt="Img"
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="course-count">
{{--                            <h3><span class="counterUp">{{ __($courses_count) }}</span></h3>--}}
                            <h3><span class="counterUp">120</span>+</h3>
                            <p>{{ __("lang.courses") }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="total-course d-flex align-items-center">
                        <div class="blur-border">
                            <div class="enroll-img ">
                                <img src="{{ URL::asset('/build/img/icon/icon-09.svg') }}" alt="Img"
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="course-count">
                            <h3><span class="counterUp">1</span>+</h3>
                            <p>{{ __("lang.countries") }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
