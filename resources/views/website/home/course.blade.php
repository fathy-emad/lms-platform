@extends('website_layouts.mainlayout')
@section('style')
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio (9 / 16 = 0.5625 or 56.25%) */
            height: 0;
            overflow: hidden;
            max-width: 100%; /* Ensures the video doesn't exceed the container width */
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .inner-banner{
            background-image: url("{{\Illuminate\Support\Facades\URL::asset('build/img/course_cover.png')}}");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
@endsection
@section('title')
    {{ __("lang.course_details") }}
@endsection

@section('style')
@endsection

@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.home") }}
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

    @php
        $course = \App\Models\Course::with([
                "teacher" => function ($query) {
                    $query->where("TeacherStatusEnum", \App\Enums\TeacherStatusEnum::Active->value) // Ensure the teacher is active
                          ->with("courses"); // Load teacher's other courses
                },
                "curriculum.chapters" => function ($query) {
                    $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
                          ->with(["lessons" => function ($query) {
                              $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value);
                          }])
                          ->withCount(["lessons" => function ($query) {
                              $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value);
                          }]);
                }
            ])
            ->withSum("materials", "video_duration")
            ->whereHas('teacher', function ($query) {
                $query->where('TeacherStatusEnum', \App\Enums\TeacherStatusEnum::Active->value); // Ensure the teacher is active
            })
            ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
            ->find(request("course_id"));


        if (isset($course))
        {
                $current_year_id = $course->curriculum->subject->year->id;
                $current_subject_id = $course->curriculum->subject->id;

                $latestCoursesData = \App\Models\Course::whereHas('curriculum.subject.year', function ($query) use ($current_year_id) {
                   $query->where('id', $current_year_id);
               })
               ->whereHas('curriculum.subject', function ($query) use ($current_subject_id) {
                   $query->where('id', '!=', $current_subject_id); // Exclude the current subject
               })
               ->whereHas('teacher', function ($query) {
                    $query->where('TeacherStatusEnum', \App\Enums\TeacherStatusEnum::Active->value); // Ensure the teacher is active
               })
               ->select('curriculum_id', \Illuminate\Support\Facades\DB::raw('MAX(created_at) as latest_course_date'))
               ->groupBy('curriculum_id')
               ->orderBy('latest_course_date', 'desc')
               ->get();

                $latestCourses = \App\Models\Course::whereIn(\Illuminate\Support\Facades\DB::raw('CONCAT(curriculum_id, created_at)'), function ($query) use ($latestCoursesData) {
                   $query->select(\Illuminate\Support\Facades\DB::raw('CONCAT(curriculum_id, MAX(created_at))'))
                     ->from('courses')
                     ->whereIn('curriculum_id', $latestCoursesData->pluck('curriculum_id')->toArray())
                     ->groupBy('curriculum_id');
                    })
                    ->whereHas('teacher', function ($query) {
                        $query->where('TeacherStatusEnum', \App\Enums\TeacherStatusEnum::Active->value); // Ensure the teacher is active
                    })
                   ->with(['curriculum.subject.subject.subjectTranslate', 'curriculum.curriculumTranslate'])
                   ->get();

                $student = auth("student")->user();
                $enrolled = $student && $student->enrollments()->exists() && $student->enrollments()
                 ->whereDate("expired_at", ">=", \Carbon\Carbon::now($student->country->timezone))
                 ->where("course_id", $course?->id)
                 ->exists();

                if ($enrolled)
                {
                    $course_enrollments = $student->enrollments()
                    ->whereDate("expired_at", ">=", \Carbon\Carbon::now($student->country->timezone))
                    ->where("course_id", $course?->id)->get();

                    $course_enrollment_ids = array_column($course_enrollments->toArray(), "id");
                }
        }

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
                                    <a href="{{ route('student.teacher.profile', ["teacher_id" => $course->teacher->id]) }}"><img
                                            src="{{ URL::asset($course->teacher->image ? "uploads/" . $course->teacher->image["file"] :'/build/img/user/user1.jpg') }}"
                                            alt="img"
                                            class="img-fluid"></a>
                                </div>
                                <div class="instructor-detail me-3">
                                    <h5><a href="{{ route('student.teacher.profile', ["teacher_id" => $course->teacher->id]) }}">{{ $course->teacher->prefix }}
                                            / {{ $course->teacher->name }}</a></h5>
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
                            <span
                                class="web-badge mb-3">{{ $course->teacher->subject->subjectTranslate->translates[app()->getLocale()] }}</span>
                        </div>
                        <h2>{{ $course->titleTranslate->translates[app()->getLocale()] }}</h2>
                        <p>
                            {{ $course->curriculum->subject->year->stage->stageTranslate->translates[app()->getLocale()] }}
                            , {{ $course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }}
                            , {{ $course->curriculum->curriculumTranslate->translates[app()->getLocale()] }}
                        </p>
                        <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                            <div class="cou-info">
                                <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                <p>{{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                            </div>
                            <div class="cou-info">
                                <img src="{{ URL::asset('/build/img/icon/timer-icon.svg') }}" alt="">
                                <p>{{ floor($course->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $course->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
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
                                <p>{{ $course->descriptionTranslate->translates[app()->getLocale()]}}</p>
                                <div class="row">
                                    <h6>{{ __("lang.belongs_to_terms") }}</h6>
                                    <div class="col-md-12 mb-3">
                                        @foreach($course->curriculum->EduTermsEnums as $term)
                                            <span class="web-badge mb-3">{{ $term->title() }}</span>
                                        @endforeach
                                    </div>

                                    <h6>{{ __("lang.belongs_to_types") }}</h6>
                                    <div class="col-md-12">
                                        @foreach($course->curriculum->EduTypesEnums as $type)
                                            <span class="web-badge bg-dark mb-3">{{ $type->title() }}</span>
                                        @endforeach
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
                                        <h6>
                                            ({{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }}
                                            ) {{ __("lang.lessons") }}
                                            {{ floor($course->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $course->materials_sum_video_duration % 60 }} {{__("lang.min")}}
                                        </h6>
                                    </div>
                                </div>

                                @if($course->curriculum->chapters->count())
                                    @foreach($course->curriculum->chapters as $chapter)
                                        <div class="course-card">
                                            <h6 class="cou-title">
                                                <a class="collapsed" data-bs-toggle="collapse"
                                                   href="#collapseOne_{{$chapter->id}}"
                                                   aria-expanded="false">{{$chapter->chapterTranslate->translates[app()->getLocale()]}}</a>
                                            </h6>

                                            <div id="collapseOne_{{$chapter->id}}" class="card-collapse collapse"
                                                 style="">
                                                <ul>
                                                    @if($chapter->lessons->count())
                                                        @foreach($chapter->lessons as $lesson)
                                                            @php
                                                                $duration = "00:00";
                                                                $isFree = false;
                                                                if ($course->materials()->where("lesson_id", $lesson->id)->exists())
                                                                {
                                                                    $material = $course->materials->where("lesson_id", $lesson->id)->first();
                                                                    $duration = isset($material->video_duration) && $material->video_duration ? floor($material->video_duration / 60) . ":" . $material->video_duration % 60 : "00:00";
                                                                    $isFree = $material->FreeEnum->value == \App\Enums\FreeEnum::Free->value;
                                                                }
                                                            @endphp
                                                            <li>
                                                                <p>
                                                                    <img
                                                                        src="{{ URL::asset('/build/img/icon/play.svg') }}"
                                                                        alt=""
                                                                        class="me-2">{{ $lesson->lessonTranslate->translates[app()->getLocale()] }}
                                                                </p>
                                                                <div>
                                                                    @if($isFree)
                                                                        <span
                                                                            class="text-success">{{ (__("lang.free")) }}</span>
                                                                    @endif
                                                                    @if(($enrolled && !$isFree) || $isFree)
                                                                        <a href="{{ route("student.lesson", ["course_id" => $course->id, "lesson_id" => $lesson->id]) }}">{{ __("lang.preview") }}</a>
                                                                    @endif
                                                                    @if($enrolled)
                                                                        @php
                                                                            $lesson_views = \App\Models\StudentLessonView::where("lesson_id", $lesson->id)
                                                                                ->whereIn("enrollment_id", $course_enrollment_ids)->orderBy("id", "desc");
                                                                        @endphp
                                                                        <span class="text-danger">({{ $lesson_views->sum("views") . " : 3 " . __("lang.views") }})</span>
                                                                    @endif
                                                                    <span>{{ $duration }}</span>
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
                                    @include("website_layouts.components.errors.coming_soon")

                                @endif
                            </div>
                        </div>
                        <!-- /Course Content -->

                        <!-- Instructor -->
                        <div class="card instructor-sec">
                            <div class="card-body">
                                <h5 class="subs-title">{{ __("lang.about_the_instructor") }}</h5>
                                <div class="instructor-wrap">
                                    <div class="about-instructor">
                                        <div class="abt-instructor-img">
                                            <a href="{{ route('student.teacher.profile', ["teacher_id" => $course->teacher->id]) }}"><img
                                                    src="{{ URL::asset($course->teacher->image ? "uploads/" . $course->teacher->image["file"] :'/build/img/user/user1.jpg') }}"
                                                    alt="img"
                                                    class="img-fluid"></a>
                                        </div>
                                        <div class="instructor-detail">
                                            <h5><a href="{{ route('student.teacher.profile', ["teacher_id" => $course->teacher->id]) }}">{{ $course->teacher->prefix }}
                                                    / {{ $course->teacher->name }}</a></h5>
                                            <p>{{ __("lang.teacher") }}</p>
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
                                        <p>{{ $course->teacher->courses->count() }} {{ __("lang.courses") }}</p>
                                    </div>
                                    <div class="cou-info">
                                        @php
                                            $lessonsCount = $course->teacher->courses->load('curriculum.chapters.lessons')->sum(function ($course) {
                                                return $course->curriculum->chapters->sum(function ($chapter) {
                                                    return $chapter->lessons->count();
                                                });
                                            });
                                        @endphp
                                        <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                        <p>{{ $lessonsCount }} {{ __("lang.lessons") }}</p>
                                    </div>
                                    <div class="cou-info">
                                        @php $sum_duration = array_sum(array_column($course->teacher->courses->loadSum("materials", "video_duration")->toArray(), "materials_sum_video_duration")) @endphp
                                        <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="">
                                        <p>{{ floor($sum_duration / 60) }} {{__("lang.hr")}} {{ $sum_duration % 60 }} {{__("lang.min")}}</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="{{ URL::asset('/build/img/icon/people.svg') }}" alt="">
                                        <p>{{ array_sum(array_column($course->teacher->courses->loadCount("enrollments")->toArray(), "enrollments_count")) }} {{ __("lang.student_enrolled") }}</p>
                                    </div>
                                </div>
                                <p>{{ $course->teacher->bio ?? "teacher bio" }}</p>
                            </div>
                        </div>
                        <!-- /Instructor -->

                        <!-- other Instructor courses -->
                        <div class="card instructor-sec">
                            <div class="card-body">
                                <h5 class="subs-title">{{ __("lang.more_instructor_courses") }}</h5>
                                <div class="all-btn all-category d-flex align-items-center">
                                    <a href="{{ route('student.teacher.courses', ["teacher_id" => $course->teacher->id]) }}"
                                       class="btn btn-primary">{{ __("lang.all_courses") }}</a>
                                </div>
                                <div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">
                                    @foreach($course->teacher->courses as $teacher_course)
                                        <div class="course-box trend-box">
                                            <div class="product trend-product">
                                                <div class="product-img">
                                                    <a href="{{ route('student.course', ["course_id" => $teacher_course->id]) }}">
                                                        <img class="img-fluid" alt="Img"
                                                             src="{{ URL::asset(isset($teacher_course->image['file']) ? 'uploads/'.$teacher_course->image['file'] : '/build/img/course.png') }}">
                                                    </a>
                                                    <div class="price">
                                                        <h3>{{$teacher_course->cost["course"]}} LE
                                                            <span>{{$teacher_course->cost["course"] * 2}} LE</span></h3>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="course-group d-flex">
                                                        <div class="course-group-img d-flex">

                                                            <div class="course-name">
                                                                <h4>
                                                                    <a href="{{ route('student.course', ["course_id" => $teacher_course->id]) }}">
                                                                        {{ $teacher_course->titleTranslate->translates[app()->getLocale()] }}
                                                                    </a>
                                                                </h4>
                                                                <p>
                                                                    {{ $teacher_course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }}
                                                                    -
                                                                    {{ $teacher_course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="course-share d-flex align-items-center justify-content-center">
                                                            <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                                  authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                                                  action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                                <input type="hidden" name="student_id" value="{{ auth("student")->id() }}">
                                                                <input type="hidden" name="course_id" value="{{ $teacher_course->id }}">
                                                                <input type="hidden" name="id"
                                                                       value="{{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $teacher_course->id)->exists() ? (auth('student')->user()->carts()->where('course_id', $teacher_course->id)->first())->id : "" }}">
                                                                <a href="#" onclick="cartFunctions(this)"><i class="fa-regular fa-heart {{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $teacher_course->id)->exists() ? "color-active" : "" }}"></i></a>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="course-info d-flex align-items-center">
                                                        <div class="rating-img d-flex align-items-center">
                                                            <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}"
                                                                 alt="Img"
                                                                 class="img-fluid">
                                                            <p>{{ array_sum(array_column($teacher_course->curriculum->chapters->loadCount("lessons")->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                        </div>
                                                        <div class="course-view d-flex align-items-center">
                                                            <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}"
                                                                 alt="Img"
                                                                 class="img-fluid">
                                                            <p>{{ floor($teacher_course->loadSum("materials", "video_duration")->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $teacher_course->loadSum("materials", "video_duration")->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                                        </div>
                                                    </div>
                                                    @if(auth('student')->user() && auth('student')->user()->enrollments && auth('student')->user()->enrollments()->where('course_id', $teacher_course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->exists())
                                                        <small class="web-badge bg-danger mb-3">exp: {{auth('student')->user()->enrollments()->where('course_id', $teacher_course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->latest()->first()->expired_at}}</small>
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /other Instructor courses -->

                        <!-- Reviews -->
{{--                        <div class="card review-sec">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="subs-title">Reviews</h5>--}}
{{--                                <div class="instructor-wrap">--}}
{{--                                    <div class="about-instructor">--}}
{{--                                        <div class="abt-instructor-img">--}}
{{--                                            <a href="{{ url('instructor-profile') }}"><img--}}
{{--                                                    src="{{ URL::asset('/build/img/user/user1.jpg') }}" alt="img"--}}
{{--                                                    class="img-fluid"></a>--}}
{{--                                        </div>--}}
{{--                                        <div class="instructor-detail">--}}
{{--                                            <h5><a href="{{ url('instructor-profile') }}">Nicole Brown</a></h5>--}}
{{--                                            <p>UX/UI Designer</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="rating">--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <span class="d-inline-block average-rating">5 Instructor Rating</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="rev-info">“ This is the second Photoshop course I have completed with--}}
{{--                                    Cristian. Worth--}}
{{--                                    every penny and recommend it highly. To get the most out of this course, its--}}
{{--                                    best to to take--}}
{{--                                    the Beginner to Advanced course first. The sound and video quality is of a good--}}
{{--                                    standard.--}}
{{--                                    Thank you Cristian. “</p>--}}
{{--                                <a href="javascript:;" class="btn btn-reply"><i class="feather-corner-up-left"></i>--}}
{{--                                    Reply</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /Reviews -->

                        <!-- Comment -->
{{--                        <div class="card comment-sec">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="subs-title">Post A comment</h5>--}}
{{--                                <form>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="input-block">--}}
{{--                                                <input type="text" class="form-control" placeholder="Full Name">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="input-block">--}}
{{--                                                <input type="email" class="form-control" placeholder="Email">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="input-block">--}}
{{--                                        <input type="email" class="form-control" placeholder="Subject">--}}
{{--                                    </div>--}}
{{--                                    <div class="input-block">--}}
{{--                                        <textarea rows="4" class="form-control"--}}
{{--                                                  placeholder="Your Comments"></textarea>--}}
{{--                                    </div>--}}
{{--                                    <div class="submit-section">--}}
{{--                                        <button class="btn submit-btn" type="submit">Submit</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /Comment -->
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar-sec">

                            <!-- Video -->
                            <div class="video-sec vid-bg">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="video-container">
                                            <iframe
                                                width="560"
                                                height="315"
                                                src="https://www.youtube.com/embed/{{$course->video}}?rel=0"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                        <div class="video-details">
                                            <div class="course-fee">
                                                <h2>{{ $course->cost["course"] }} LE</h2>
                                                <p><span>{{ $course->cost["course"] * 2 }} LE</span> 50% off</p>
                                            </div>
                                            <div class="row gx-2">
                                                <div class="col-md-6">
                                                    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                          authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                                          action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                        <input type="hidden" name="student_id" value="{{ auth("student")?->id() }}">
                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                        <input type="hidden" name="id"
                                                               value="{{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $course->id)->exists() ? (auth('student')->user()->carts()->where('course_id', $course->id)->first())->id : "" }}">
                                                        <a href="javascript:void(0);" onclick="cartFunctions(this)"
                                                           class="btn btn-wish w-100">
                                                            <i class="feather-heart {{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $course->id)->exists() ? "color-active" : "" }}"></i>
                                                            {{ __("lang.add_to_cart") }}
                                                        </a>
                                                    </form>

                                                </div>
                                                <div class="col-md-6">
                                                    <a href="javascript:;" class="btn btn-wish w-100"><i class="feather-share-2"></i> Share</a>
                                                </div>
                                            </div>
                                            <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                  authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                                  action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                <input type="hidden" name="student_id" value="{{ auth("student")?->id() }}">
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <a role="button" class="btn btn-enroll w-100 mb-3" onclick="submitForm(this,null,window.location=APP_URL+'/profile/checkout',window.location=APP_URL+'/profile/checkout')">{{ __("lang.enroll_now") }}</a>
                                            </form>
                                            @if(auth('student')->user() && auth('student')->user()->enrollments && auth('student')->user()->enrollments()->where('course_id', $course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->exists())
                                                <small class="web-badge bg-danger mb-3 mt-3">exp: {{auth('student')->user()->enrollments()->where('course_id', $course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->latest()->first()->expired_at}}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Video -->

                            <!-- Features -->
                            <div class="card feature-sec">
                                <div class="card-body">
                                    <div class="cat-title">
                                        <h4>{{ __("lang.course_features") }}</h4>
                                    </div>
                                    <ul>
                                        <li><img src="{{ URL::asset('/build/img/icon/play.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.non_downloadable") }}
                                        </li>
                                        <li><img src="{{ URL::asset('/build/img/icon/mobile.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.Access_from_any_device") }}
                                        </li>
                                        <li><img src="{{ URL::asset('/build/img/icon/cloud.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.assignments") }}
                                        </li>
                                        <li><img src="{{ URL::asset('/build/img/icon/key.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.watch_times") }}:<span> 3 </span>
                                        </li>
                                        <li><img src="{{ URL::asset('/build/img/icon/users.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.enrolled") }}:
                                            <span>{{ isset($course->enrollments) ? $course->enrollments->count() : 0 }} {{ __("lang.students") }}</span>
                                        </li>
                                        <li><img src="{{ URL::asset('/build/img/icon/timer.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.duration") }}:
                                            <span>{{ floor($course->materials_sum_video_duration / 60) }} {{__("lang.hours")}}</span>
                                        </li>
                                        <li><img src="{{ URL::asset('/build/img/icon/chapter.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.chapters") }}:
                                            <span>{{ $course->curriculum->chapters->count() }}</span></li>
                                        <li><img src="{{ URL::asset('/build/img/icon/video.svg') }}" class="me-2"
                                                 alt=""> {{ __("lang.lessons") }}
                                            :<span> {{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Features -->

                            <!-- other courses -->
                            @if($latestCourses->count())
                                <!-- Latest Posts -->
                                <div class="card post-widget">
                                    <div class="card-body">
                                        <div class="latest-head">
                                            <h4 class="card-title">{{ __("lang.latest_for_you") }}</h4>
                                        </div>

                                        <ul class="latest-posts">

                                            @foreach($latestCourses as $latest)
                                                <li>
                                                    <div class="post-thumb" @if(app()->getLocale() == "ar") style="float: right" @endif>
                                                        <a href="{{ route('student.course', ["course_id" => $latest->id]) }}">
                                                            <img class="img-fluid"
                                                                 src="{{ URL::asset(isset($latest->image['file']) ? 'uploads/'.$latest->image['file'] : '/build/img/course.png') }}"
                                                                 alt="">
                                                        </a>
                                                    </div>
                                                    <div class="post-info free-color">
                                                        <h4>
                                                            <a href="{{ route('student.course', ["course_id" => $latest->id]) }}">
                                                                {{ $latest->titleTranslate->translates[app()->getLocale()] }}
                                                            </a>
                                                        </h4>
                                                        <small>
                                                            <a href="{{ route('student.courses', ["curriculum_id" => $latest->curriculum->id]) }}">
                                                                ({{ $latest->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}
                                                                ) -
                                                                {{ $latest->curriculum->curriculumTranslate->translates[app()->getLocale()] }}
                                                            </a>
                                                        </small>
                                                        <p>{{ $latest->cost["course"] }} LE</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                                <!-- /Latest Posts -->

                            @endif
                            <!-- /end other courses -->

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
