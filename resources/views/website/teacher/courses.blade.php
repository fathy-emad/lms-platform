@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.teacher_courses") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.teacher_courses") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.teacher_courses") }}
        @endslot
    @endcomponent

    @php
        $teacher = \App\Models\Teacher::with(["courses" => function ($query) {
                        $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value);
                    }])
                    ->where("TeacherStatusEnum", \App\Enums\TeacherStatusEnum::Active->value)
                    ->find(request("teacher_id"));
    @endphp

        <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

                @component('website_layouts.components.sidebar_teacher', ["teacher" => $teacher]) @endcomponent

                <!-- Student Courses -->
                <div class="col-xl-9 col-lg-9">
                    <div class="settings-widget card-info">
                        <div class="settings-menu p-0">
                            <div class="profile-heading">
                                <h3>{{ __("lang.teacher_courses") }}</h3>
                            </div>
                            <div class="checkout-form pb-0">
                                @if($teacher->courses->count())
                                    <div class="row">
                                        @foreach($teacher->courses as $course)
                                            <div class="col-lg-4 col-md-6 d-flex">
                                                <div class="course-box course-design d-flex ">
                                                    <div class="product">
                                                        <div class="product-img">
                                                            <a href="{{ route('student.course', ["course_id" => $course->id]) }}">
                                                                <img class="img-fluid" alt=""
                                                                     src="{{ URL::asset(isset($course->image['file']) ? 'uploads/'.$course->image['file'] : '/build/img/course.png') }}">
                                                            </a>
                                                            <div class="price">
                                                                <h3>{{$course->cost["course"]}} LE<span>{{$course->cost["course"] * 2}} LE</span></h3>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="course-group d-flex">
                                                                <div class="course-group-img d-flex">

                                                                    <div class="course-nameبي">
                                                                        <h4>
                                                                            <a href="{{ route('student.course', ["course_id" => $course->id]) }}">
                                                                                {{ $course->titleTranslate->translates[app()->getLocale()] }}
                                                                            </a>
                                                                        </h4>
                                                                        <p>
                                                                            {{ $course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }}
                                                                            -
                                                                            {{ $course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="course-share d-flex align-items-center justify-content-center">
                                                                    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                                          authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                                                          action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                                        <input type="hidden" name="student_id" value="{{ auth("student")->id() }}">
                                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                                        <input type="hidden" name="id"
                                                                               value="{{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $course->id)->exists() ? (auth('student')->user()->carts()->where('course_id', $course->id)->first())->id : "" }}">
                                                                        <a href="#" onclick="cartFunctions(this)"><i class="fa-regular fa-heart {{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $course->id)->exists() ? "color-active" : "" }}"></i></a>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <div class="course-info d-flex align-items-center">
                                                                <div class="rating-img d-flex align-items-center">
                                                                    <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                                                    <p>{{ array_sum(array_column($course->curriculum->chapters->loadCount("lessons")->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                                </div>
                                                                <div class="course-view d-flex align-items-center">
                                                                    <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="">
                                                                    <p>{{ floor($course->loadSum("materials", "video_duration")->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $course->loadSum("materials", "video_duration")->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                                                </div>
                                                            </div>
                                                            @if(auth('student')->user() && auth('student')->user()->enrollments && auth('student')->user()->enrollments()->where('course_id', $course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->exists())
                                                                <small class="web-badge bg-danger mb-3">exp: {{auth('student')->user()->enrollments()->where('course_id', $course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->latest()->first()->expired_at}}</small>
                                                            @endif
                                                            <div class="rating mt-3">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                                                            </div>
                                                            <div class="all-btn all-category d-flex align-items-center">
                                                                <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                                      authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                                                      action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                                    <input type="hidden" name="student_id" value="{{ auth("student")?->id() }}">
                                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                                    <a role="button" class="btn btn-primary" onclick="submitForm(this,null,window.location=APP_URL+'/profile/checkout',window.location=APP_URL+'/profile/checkout')">{{ __("lang.enroll_now") }}</a>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    @include("website_layouts.components.errors.coming_soon")
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Student Courses -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->

@endsection

@section('script')
    <script>
        function cartFunctions(element) {
            let form = $(element).parent("form");

            if($(element).find("i").hasClass("color-active"))
                form.find("[name=_method").remove();
            else
                form.append('<input type="hidden" name="_method" value="DELETE">')

            submitForm($(element), null, location.reload());

        }
    </script>
@endsection
