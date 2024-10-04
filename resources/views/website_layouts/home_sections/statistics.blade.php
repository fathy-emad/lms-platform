@php
    $students_count = \App\Models\Student::count();
    $courses_count = \App\Models\Course::count();
    $teachers_count = \App\Models\Teacher::count();
@endphp
<section class="section student-course">
    <div class="container">
        <div class="course-widget">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="course-full-width">
                        <div class="blur-border course-radius align-items-center aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{ URL::asset('/build/img/pencil-icon.svg') }}" alt="Img">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{ $courses_count }}</span></h4>
                                    <p>{{ __("lang.online_courses") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="course-full-width">
                        <div class="blur-border course-radius aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{ URL::asset('/build/img/cources-icon.svg') }}" alt="Img">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{ $teachers_count }}</span>+</h4>
                                    <p>{{ __("lang.expert_tutors") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="course-full-width">
                        <div class="blur-border course-radius aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{ URL::asset('/build/img/certificate-icon.svg') }}" alt="Img">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>100</span>+</h4>
                                    <p>{{ __("lang.certified_courses") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="course-full-width">
                        <div class="blur-border course-radius aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{ URL::asset('/build/img/gratuate-icon.svg') }}" alt="Img">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{ $students_count }}</span>+</h4>
                                    <p>{{ __("lang.online_students") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
