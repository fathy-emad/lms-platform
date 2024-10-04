@extends('website_layouts.mainlayout')
@section('title') loomy edu @endsection
@section('content')
    
    <!-- Home Banner -->
    @include("website_layouts.home_sections.hero")
    <!-- /Home Banner -->

    <!-- statistics -->
    @include("website_layouts.home_sections.statistics")
    <!-- /statistics -->

    <!-- Top Categories -->
    @include("website_layouts.home_sections.category")
    <!-- /Top Categories -->

    <!-- Feature Course -->
    @include("website_layouts.home_sections.featured")
    <!-- /Feature Course -->

    <!-- Master Skill -->
    <section class="section master-skill">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="section-header aos" data-aos="fade-up">
                        <div class="section-sub-head">
                            <span>What’s New</span>
                            <h2>Master the skills to drive your career</h2>
                        </div>
                    </div>
                    <div class="section-text aos" data-aos="fade-up">
                        <p>Get certified, master modern tech skills, and level up your career — whether you’re starting out
                            or a seasoned pro. 95% of eLearning learners report our hands-on content directly helped their
                            careers.</p>
                    </div>
                    <div class="career-group aos" data-aos="fade-up">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{ URL::asset('/build/img/icon/icon-1.svg') }}" alt="Img"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Stay motivated with engaging instructors</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{ URL::asset('/build/img/icon/icon-2.svg') }}" alt="Img"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Keep up with in the latest in cloud</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{ URL::asset('/build/img/icon/icon-3.svg') }}" alt="Img"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Get certified with 100+ certification courses</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{ URL::asset('/build/img/icon/icon-4.svg') }}" alt="Img"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Build skills your way, from labs to courses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 d-flex align-items-end">
                    <div class="career-img aos" data-aos="fade-up">
                        <img src="{{ URL::asset('/build/img/join.png') }}" alt="Img" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Master Skill -->

    <!-- Trending Course -->
    @include("website_layouts.home_sections.trending")
    <!-- /Trending Course -->

    <!-- Leading Companies -->
    <section class="section lead-companies">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <span>Trusted By</span>
                    <h2>500+ Leading Universities And Companies</h2>
                </div>
            </div>
            <div class="lead-group aos" data-aos="fade-up">
                <div class="lead-group-slider owl-carousel owl-theme">
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt="Img" src="{{ URL::asset('/build/img/lead-01.png') }}">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt="Img" src="{{ URL::asset('/build/img/lead-02.png') }}">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt="Img" src="{{ URL::asset('/build/img/lead-03.png') }}">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt="Img" src="{{ URL::asset('/build/img/lead-04.png') }}">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt="Img" src="{{ URL::asset('/build/img/lead-05.png') }}">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt="Img" src="{{ URL::asset('/build/img/lead-06.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Leading Companies -->

    <!-- Share Knowledge -->
    <section class="section share-knowledge">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="knowledge-img aos" data-aos="fade-up">
                        <img src="{{ URL::asset('/build/img/share.png') }}" alt="Img" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="join-mentor aos" data-aos="fade-up">
                        <h2>Want to share your knowledge? Join us a Mentor</h2>
                        <p>High-definition video is video of higher resolution and quality than standard-definition. While
                            there is no standardized meaning for high-definition, generally any video.</p>
                        <ul class="course-list">
                            <li><i class="fa-solid fa-circle-check"></i>Best Courses</li>
                            <li><i class="fa-solid fa-circle-check"></i>Top rated Instructors</li>
                        </ul>
                        <div class="all-btn all-category d-flex align-items-center">
                            <a href="{{ url('instructor-list') }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Share Knowledge -->

    <!-- Users Love -->
    <section class="section user-love">
        <div class="container">
            <div class="section-header white-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <span>Check out these real reviews</span>
                    <h2>Users-love-us Don't take it from us.</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- /Users Love -->

    <!-- Say testimonial Four -->
    <section class="testimonial-four">
        <div class="review">
            <div class="container">
                <div class="testi-quotes">
                    <img src="{{ URL::asset('/build/img/qute.png') }}" alt="Img">
                </div>
                <div class="mentor-testimonial lazy slider aos" data-aos="fade-up" data-sizes="50vw ">
                    <div class="d-flex justify-content-center">
                        <div class="testimonial-all d-flex justify-content-center">
                            <div class="testimonial-two-head text-center align-items-center d-flex">
                                <div class="testimonial-four-saying ">
                                    <div class="testi-right">
                                        <img src="{{ URL::asset('/build/img/qute-01.png') }}" alt="Img">
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                    <div class="four-testimonial-founder">
                                        <div class="fount-about-img">
                                            <a href="{{ url('instructor-profile') }}"><img
                                                    src="{{ URL::asset('/build/img/user/user1.jpg') }}" alt="Img"
                                                    class="img-fluid"></a>
                                        </div>
                                        <h3><a href="{{ url('instructor-profile') }}">Daziy Millar</a></h3>
                                        <span>Founder of Awesomeux Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="testimonial-all d-flex justify-content-center">
                            <div class="testimonial-two-head text-center align-items-center d-flex">
                                <div class="testimonial-four-saying ">
                                    <div class="testi-right">
                                        <img src="{{ URL::asset('/build/img/qute-01.png') }}" alt="Img">
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                    <div class="four-testimonial-founder">
                                        <div class="fount-about-img">
                                            <a href="{{ url('instructor-profile') }}"><img
                                                    src="{{ URL::asset('/build/img/user/user3.jpg') }}" alt="Img"
                                                    class="img-fluid"></a>
                                        </div>
                                        <h3><a href="{{ url('instructor-profile') }}">john smith</a></h3>
                                        <span>Founder of Awesomeux Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="testimonial-all d-flex justify-content-center">
                            <div class="testimonial-two-head text-center align-items-center d-flex">
                                <div class="testimonial-four-saying ">
                                    <div class="testi-right">
                                        <img src="{{ URL::asset('/build/img/qute-01.png') }}" alt="Img">
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                    <div class="four-testimonial-founder">
                                        <div class="fount-about-img">
                                            <a href="{{ url('instructor-profile') }}"><img
                                                    src="{{ URL::asset('/build/img/user/user2.jpg') }}" alt="Img"
                                                    class="img-fluid"></a>
                                        </div>
                                        <h3><a href="{{ url('instructor-profile') }}">David Lee</a></h3>
                                        <span>Founder of Awesomeux Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Say testimonial Four -->

    <!-- Become An Instructor -->
    <section class="section become-instructors aos" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 d-flex">
                    <div class="student-mentor cube-instuctor ">
                        <h4>Become An Instructor</h4>
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <div class="top-instructors">
                                    <p>Top instructors from around the world teach millions of students on Mentoring.</p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mentor-img">
                                    <img class="img-fluid" alt="Img"
                                        src="{{ URL::asset('/build/img/icon/become-02.svg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex">
                    <div class="student-mentor yellow-mentor">
                        <h4>Transform Access To Education</h4>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="top-instructors">
                                    <p>Create an account to receive our newsletter, course recommendations and promotions.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mentor-img">
                                    <img class="img-fluid" alt="Img"
                                        src="{{ URL::asset('/build/img/icon/become-01.svg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Become An Instructor -->

    <!-- Latest Blog -->
    <section class="section latest-blog">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center mb-0">
                    <h2>Latest Blogs</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan
                            bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel blogs-slide owl-theme aos" data-aos="fade-up">
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-01.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">Attract More Attention Sales And Profits</a></h5>
                        <p>Marketing</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jun 15, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">11 Tips to Help You Get New Clients</a></h5>
                        <p>Sales Order</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 20, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">An Overworked Newspaper Editor</a></h5>
                        <p>Design</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-04.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">A Solution Built for Teachers</a></h5>
                        <p>Seo</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jul 15, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">Attract More Attention Sales And Profits</a></h5>
                        <p>Marketing</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Sep 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">An Overworked Newspaper Editor</a></h5>
                        <p>Marketing</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-04.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">A Solution Built for Teachers</a></h5>
                        <p>Analysis</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 15, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">11 Tips to Help You Get New Clients</a></h5>
                        <p>Development</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jun 20, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">An Overworked Newspaper Editor</a></h5>
                        <p>Sales</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="{{ url('blog-list') }}">
                            <img class="img-fluid" alt="Img"
                                src="{{ URL::asset('/build/img/blog/blog-04.jpg') }}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="{{ url('blog-list') }}">A Solution Built for Teachers</a></h5>
                        <p>Marketing</p>
                        <div class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>April 15, 2022</span>
                        </div>
                    </div>
                </div>
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
                                <h3><span class="counterUp">253,085</span></h3>
                                <p>STUDENTS ENROLLED</p>
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
                                <h3><span class="counterUp">1,205</span></h3>
                                <p>TOTAL COURSES</p>
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
                                <h3><span class="counterUp">127</span></h3>
                                <p>COUNTRIES</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lab-course">
                <div class="section-header aos" data-aos="fade-up">
                    <div class="section-sub-head feature-head text-center">
                        <h2>Unlimited access to 360+ courses <br>and 1,600+ hands-on labs</h2>
                    </div>
                </div>
                <div class="icon-group aos" data-aos="fade-up">
                    <div class="offset-lg-1 col-lg-12">
                        <div class="row">
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-09.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-10.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-16.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-12.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-13.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-14.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-15.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-16.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-17.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img src="{{ URL::asset('/build/img/icon/icon-18.svg') }}" alt="Img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Latest Blog -->
@endsection

@section('script')
    <script>
        function getCurriculaOfYear() {
           let year_id = $("#years").val();
           window.location = APP_URL + "/curricula/" + year_id;
        }

        function onChangeYears(element)
        {
            if($(element).val() != "-1")
                $("#buttonSelectYear").prop("disabled", false)
            else
                $("#buttonSelectYear").prop("disabled", true)
        }

        function selectYears() {
            // Get the selected stage ID
            let stage_id = $("#stages").val();

            // Disable all year options initially
            $("#years option").each(function() {
                let yearStage = $(this).data("stage");
                if (yearStage == stage_id) {
                    $(this).prop("disabled", false);
                } else {
                    $(this).prop("disabled", true);
                }
            });
        }

        $(document).ready(function () {
            selectYears();
        });

    </script>
@endsection
