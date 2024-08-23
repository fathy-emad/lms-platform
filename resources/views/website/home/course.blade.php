@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.course_details") }} @endsection

@section('style')
@endsection

@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            Home
        @endslot
        @slot('item1')
            {{ __("lang.course_details") }}
        @endslot
        @slot('item2')
            {{ __("lang.home") }}
        @endslot
        @slot('item3')
            {{ __("lang.course_details") }}
        @endslot
    @endcomponent

    @php $course = \App\Models\Course::with(["curriculum.chapters" => function ($query) {
                            $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
                            ->withCount(["lessons" => function ($query) {
                                $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value);
                            }]);
                    }])
                    ->find(request("course_id"))
    @endphp

    @if(isset($course))
        <!-- Inner Banner -->
        <div class="inner-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="instructor-wrap border-bottom-0 m-0">
                            <div class="about-instructor align-items-center">
                                <div class="abt-instructor-img">
                                    <a href="{{ url('instructor-profile') }}"><img
                                            src="{{ URL::asset($course->teacher->image ? "uploads/" . $course->teacher->image["file"] :'/build/img/user/user1.jpg') }}" alt="img"
                                            class="img-fluid"></a>
                                </div>
                                <div class="instructor-detail me-3">
                                    <h5><a href="{{ url('instructor-profile') }}">{{ $course->teacher->prefix }}/ {{ $course->teacher->name }}</a></h5>
                                    <p>{{ __("lang.teacher") }}</p>
                                </div>
                                <div class="rating mb-0">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating"><span>4.5</span> (15)</span>
                                </div>
                            </div>
                            <span class="web-badge mb-3">{{ $course->teacher->subject->subjectTranslate->translates[app()->getLocale()] }}</span>
                        </div>
                        <h2>Course title</h2>
                        <p>{{ $course->curriculum->subject->year->stage->stageTranslate->translates[app()->getLocale()] }}, {{ $course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }},  {{ $course->curriculum->curriculumTranslate->translates[app()->getLocale()] }}</p>
                        <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                            <div class="cou-info">
                                <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                <p>{{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                            </div>
                            <div class="cou-info">
                                <img src="{{ URL::asset('/build/img/icon/timer-icon.svg') }}" alt="">
                                <p>9hr 30min</p>
                            </div>
                            <div class="cou-info">
                                <img src="{{ URL::asset('/build/img/icon/people.svg') }}" alt="">
                                <p>{{ isset($course->enrollments) ? $course->enrollments->count() : 0 }} {{ __("lang.student_enrolled") }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Inner Banner -->

        <!-- Course Content -->
        <section class="page-content course-sec">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8">

                        <!-- Overview -->
                        <div class="card overview-sec">
                            <div class="card-body">
                                <h5 class="subs-title">{{ __("lang.overview") }}</h5>
                                <h6>{{ __("lang.course_description") }}</h6>
                                <p>{{ $course->description ?? "Course description" }}</p>
                                <div class="row">
                                    <h6>{{ __("lang.belongs_to_terms") }}</h6>
                                    <div class="col-md-6">
                                        <ul>
                                            @foreach($course->curriculum->EduTermsEnums as $term)
                                                <li>{{ $term->title() }}.</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <h6>{{ __("lang.belongs_to_types") }}</h6>
                                    <div class="col-md-6">
                                        <ul>
                                            @foreach($course->curriculum->EduTypesEnums as $type)
                                                <li>{{ $type->title() }}.</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Overview -->

                        <!-- Course Content -->
                        <div class="card content-sec">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="subs-title">{{ __("lang.course_content") }}</h5>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <h6>{{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }} {{ __("lang.lesson") }} 10:56:11</h6>
                                    </div>
                                </div>
                                @php
                                    $curriculum = $course->curriculum->load(['chapters' => function ($query) {
                                        $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value) // Filtering active chapters
                                              ->with(['lessons' => function ($query) {
                                                  $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value); // Filtering active lessons
                                              }]);
                                    }]);
                                @endphp

                                @if($curriculum->chapters->count())
                                    @foreach($curriculum->chapters as $chapter)
                                        <div class="course-card">
                                            <h6 class="cou-title">
                                                <a class="collapsed" data-bs-toggle="collapse" href="#collapseOne_{{$chapter->id}}"
                                                   aria-expanded="false">{{$chapter->chapterTranslate->translates[app()->getLocale()]}}</a>
                                            </h6>
                                            <div id="collapseOne_{{$chapter->id}}" class="card-collapse collapse" style="">
                                                <ul>
                                                    @if($chapter->lessons->count())
                                                        @foreach($chapter->lessons as $lesson)
                                                            <li>
                                                                <p><img src="{{ URL::asset('/build/img/icon/play.svg') }}" alt=""
                                                                        class="me-2">{{ $lesson->lessonTranslate->translates[app()->getLocale()] }}</p>
                                                                <div>
                                                                    <a href="javascript:;">{{ __("lang.preview") }}</a>
                                                                    <span>{{ $lesson->material->video_duration ?? "22:50" }}</span>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        @include("website_layouts.components.errors.coming_soon")
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @include("website_layouts.components.errors.coming_soon")<div class="error-box">
                                @endif
                            </div>
                        </div>
                        <!-- /Course Content -->

                        <!-- Instructor -->
                        <div class="card instructor-sec">
                            <div class="card-body">
                                <h5 class="subs-title">About the instructor</h5>
                                <div class="instructor-wrap">
                                    <div class="about-instructor">
                                        <div class="abt-instructor-img">
                                            <a href="{{ url('instructor-profile') }}"><img
                                                    src="{{ URL::asset('/build/img/user/user1.jpg') }}" alt="img"
                                                    class="img-fluid"></a>
                                        </div>
                                        <div class="instructor-detail">
                                            <h5><a href="{{ url('instructor-profile') }}">Nicole Brown</a></h5>
                                            <p>UX/UI Designer</p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">4.5 Instructor Rating</span>
                                    </div>
                                </div>
                                <div class="course-info d-flex align-items-center">
                                    <div class="cou-info">
                                        <img src="{{ URL::asset('/build/img/icon/play.svg') }}" alt="">
                                        <p>5 Courses</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                        <p>12+ Lesson</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="">
                                        <p>9hr 30min</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="{{ URL::asset('/build/img/icon/people.svg') }}" alt="">
                                        <p>270,866 students enrolled</p>
                                    </div>
                                </div>
                                <p>UI/UX Designer, with 7+ Years Experience. Guarantee of High Quality Work.</p>
                                <p>Skills: Web Design, UI Design, UX/UI Design, Mobile Design, User Interface Design, Sketch,
                                    Photoshop, GUI, Html, Css, Grid Systems, Typography, Minimal, Template, English, Bootstrap,
                                    Responsive Web Design, Pixel Perfect, Graphic Design, Corporate, Creative, Flat, Luxury and
                                    much more.</p>
                                <p>Available for:</p>
                                <ul>
                                    <li>1. Full Time Office Work</li>
                                    <li>2. Remote Work</li>
                                    <li>3. Freelance</li>
                                    <li>4. Contract</li>
                                    <li>5. Worldwide</li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Instructor -->

                        <!-- Reviews -->
                        <div class="card review-sec">
                            <div class="card-body">
                                <h5 class="subs-title">Reviews</h5>
                                <div class="instructor-wrap">
                                    <div class="about-instructor">
                                        <div class="abt-instructor-img">
                                            <a href="{{ url('instructor-profile') }}"><img
                                                    src="{{ URL::asset('/build/img/user/user1.jpg') }}" alt="img"
                                                    class="img-fluid"></a>
                                        </div>
                                        <div class="instructor-detail">
                                            <h5><a href="{{ url('instructor-profile') }}">Nicole Brown</a></h5>
                                            <p>UX/UI Designer</p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <span class="d-inline-block average-rating">5 Instructor Rating</span>
                                    </div>
                                </div>
                                <p class="rev-info">“ This is the second Photoshop course I have completed with Cristian. Worth
                                    every penny and recommend it highly. To get the most out of this course, its best to to take
                                    the Beginner to Advanced course first. The sound and video quality is of a good standard.
                                    Thank you Cristian. “</p>
                                <a href="javascript:;" class="btn btn-reply"><i class="feather-corner-up-left"></i> Reply</a>
                            </div>
                        </div>
                        <!-- /Reviews -->

                        <!-- Comment -->
                        <div class="card comment-sec">
                            <div class="card-body">
                                <h5 class="subs-title">Post A comment</h5>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <input type="text" class="form-control" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <input type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-block">
                                        <input type="email" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="input-block">
                                        <textarea rows="4" class="form-control" placeholder="Your Comments"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn submit-btn" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Comment -->

                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar-sec">

                            <!-- Video -->
                            <div class="video-sec vid-bg">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="https://www.youtube.com/embed/1trvO6dqQUI" class="video-thumbnail"
                                           data-fancybox="">
                                            <div class="play-icon">
                                                <i class="fa-solid fa-play"></i>
                                            </div>
                                            <img class="" src="{{ URL::asset('/build/img/video.jpg') }}"
                                                 alt="">
                                        </a>
                                        <div class="video-details">
                                            <div class="course-fee">
                                                <h2>FREE</h2>
                                                <p><span>$99.00</span> 50% off</p>
                                            </div>
                                            <div class="row gx-2">
                                                <div class="col-md-6">
                                                    <a href="{{ url('course-details') }}" class="btn btn-wish w-100"><i
                                                            class="feather-heart"></i> Add to Wishlist</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="javascript:;" class="btn btn-wish w-100"><i
                                                            class="feather-share-2"></i> Share</a>
                                                </div>
                                            </div>
                                            <a href="{{ url('checkout') }}" class="btn btn-enroll w-100">Enroll Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Video -->

                            <!-- Include -->
                            <div class="card include-sec">
                                <div class="card-body">
                                    <div class="cat-title">
                                        <h4>Includes</h4>
                                    </div>
                                    <ul>
                                        <li><img src="{{ URL::asset('/build/img/icon/import.svg') }}" class="me-2"
                                                 alt=""> 11 hours on-demand video</li>
                                        <li><img src="{{ URL::asset('/build/img/icon/play.svg') }}" class="me-2"
                                                 alt=""> 69 downloadable resources</li>
                                        <li><img src="{{ URL::asset('/build/img/icon/key.svg') }}" class="me-2"
                                                 alt=""> Full lifetime access</li>
                                        <li><img src="{{ URL::asset('/build/img/icon/mobile.svg') }}" class="me-2"
                                                 alt=""> Access on mobile and TV</li>
                                        <li><img src="{{ URL::asset('/build/img/icon/cloud.svg') }}" class="me-2"
                                                 alt=""> Assignments</li>
                                        <li><img src="{{ URL::asset('/build/img/icon/teacher.svg') }}" class="me-2"
                                                 alt=""> Certificate of Completion</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Include -->

                            <!-- Features -->
                            <div class="card feature-sec">
                                <div class="card-body">
                                    <div class="cat-title">
                                        <h4>Includes</h4>
                                    </div>
                                    <ul>
                                        <li><img src="{{ URL::asset('/build/img/icon/users.svg') }}" class="me-2"
                                                 alt=""> Enrolled: <span>32 students</span></li>
                                        <li><img src="{{ URL::asset('/build/img/icon/timer.svg') }}" class="me-2"
                                                 alt=""> Duration: <span>20 hours</span></li>
                                        <li><img src="{{ URL::asset('/build/img/icon/chapter.svg') }}" class="me-2"
                                                 alt=""> Chapters: <span>15</span></li>
                                        <li><img src="{{ URL::asset('/build/img/icon/video.svg') }}" class="me-2"
                                                 alt=""> Video:<span> 12 hours</span></li>
                                        <li><img src="{{ URL::asset('/build/img/icon/chart.svg') }}" class="me-2"
                                                 alt=""> Level: <span>Beginner</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Features -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Pricing Plan -->
    @else
        @include("website_layouts.components.errors.coming_soon")
    @endif

@endsection
