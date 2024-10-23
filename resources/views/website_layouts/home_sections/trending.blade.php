@php
    $trendingCourses = \App\Models\Course::withCount(['enrollments' => function ($query) {
            $query->whereYear('created_at', \Carbon\Carbon::now()->year);
        }])
        ->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)  // Course must be active
        ->withSum('materials', 'video_duration')  // Sum the video duration from materials
        ->whereHas('enrollments', function ($query) {
            $query->whereYear('created_at', \Carbon\Carbon::now()->year);
        })
        ->orderBy('enrollments_count', 'desc')
        ->limit(20)
        ->get()
        ->map(function ($course) {
            $course->lessons_count = $course->curriculum->chapters->sum(function ($chapter) {
                return $chapter->lessons->count();
            });

            return $course;
        });

        $teachers = \App\Models\Teacher::where("TeacherStatusEnum", \App\Enums\TeacherStatusEnum::Active->value)
        ->with(["stage.stageTranslate", "subject.subjectTranslate"])
        ->withCount(['courses as enrollments_count' => function ($query) {
            $query->join('enrollments', 'courses.id', '=', 'enrollments.course_id');
        }])
        ->get();
@endphp
<section class="section trend-course">
    <div class="container">
        @if($trendingCourses->count())
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head">
                    <span>{{ __("lang.whats_new") }}</span>
                    <h2>{{ __("lang.trending_courses") }}</h2>
                </div>
            </div>
            <div class="section-text aos" data-aos="fade-up">
                <p class="mb-0">
                    {{ __("lang.trending_courses_description") }}
                </p>
            </div>
            <div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">
                @foreach($trendingCourses as $trend_course)
                    <div class="course-box trend-box">
                        <div class="product trend-product">
                            <div class="product-img">
                                <a href="{{ Route('student.course', ["course_id" => $trend_course->id]) }}">
                                    <img class="img-fluid" alt="Img"
                                         src="{{ URL::asset(isset($trend_course->image) ? 'uploads/'.$trend_course->image["file"] : '/build/img/course/course-01.jpg') }}">
                                </a>
                                <div class="price">
                                    <h3>{{ $trend_course->cost["course"] }} LE<span>{{ $trend_course->cost["course"] * 2 }} LE</span></h3>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="course-group d-flex">
                                    <div class="course-group-img d-flex">
                                        <a href="{{ route('student.teacher.profile', ["teacher_id" => $trend_course->teacher->id]) }}"><img
                                                src="{{ URL::asset($trend_course->teacher->image["file"] ? "uploads/".$trend_course->teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt=""
                                                class="img-fluid"></a>
                                        <div class="course-name">
                                            <h4><a href="{{ route('student.teacher.profile', ["teacher_id" => $trend_course->teacher->id]) }}">{{ $trend_course->teacher->prefix }}/ {{ $trend_course->teacher->name }}</a></h4>
                                            <p>{{ __("lang.teacher") }}</p>
                                        </div>
                                    </div>
                                    <div class="course-share d-flex align-items-center justify-content-center">
                                        <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                              authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                              action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                            <input type="hidden" name="student_id" value="{{ auth("student")->id() }}">
                                            <input type="hidden" name="course_id" value="{{ $trend_course->id }}">
                                            <input type="hidden" name="id"
                                                   value="{{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $trend_course->id)->exists() ? (auth('student')->user()->carts()->where('course_id', $trend_course->id)->first())->id : "" }}">
                                            <a href="#" onclick="cartFunctions(this)"><i class="fa-regular fa-heart {{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $trend_course->id)->exists() ? "color-active" : "" }}"></i></a>
                                        </form>
                                    </div>
                                </div>
                                <h3 class="title">
                                    <a href="{{ route('student.course', ["course_id" => $trend_course->id]) }}">
                                        {{ $trend_course->titleTranslate->translates[app()->getLocale()] }}
                                    </a>
                                </h3>
                                <div class="course-info d-flex align-items-center">
                                    <div class="rating-img d-flex align-items-center">
                                        <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="Img">
                                        <p>{{ $trend_course->lessons_count }} {{ __("lang.lessons") }}</p>
                                    </div>
                                    <div class="course-view d-flex align-items-center">
                                        <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="Img">
                                        <p>{{ floor($trend_course->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $trend_course->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    @if(auth('student')->user() && auth('student')->user()->enrollments && auth('student')->user()->enrollments()->where('course_id', $trend_course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->exists())
                                        <small class="web-badge bg-danger mb-3">exp: {{auth('student')->user()->enrollments()->where('course_id', $trend_course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->latest()->first()->expired_at}}</small>
                                    @endif
                                    <div class="rating m-0">
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
                                            <input type="hidden" name="course_id" value="{{ $trend_course->id }}">
                                            <a role="button" class="btn btn-primary" onclick="submitForm(this,null,window.location=APP_URL+'/profile/checkout',window.location=APP_URL+'/profile/checkout')">{{ __("lang.enroll_now") }}</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Feature Instructors -->
        <div class="feature-instructors">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <h2>{{ __("lang.featured_instructor") }}</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">
                            {{ __("lang.featured_instructor_description") }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
                @foreach($teachers as $teacher)
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="{{ route('student.teacher.profile', ["teacher_id" => $teacher->id]) }}"><img
                                    src="{{ URL::asset($teacher->image["file"] ? "uploads/".$teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt=""
                                    class="img-fluid"></a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="{{ route('student.teacher.profile', ["teacher_id" => $teacher->id]) }}">{{ $teacher->prefix }}/ {{ $teacher->name }}</a></h5>
                            <p>{{ $teacher->stage->stageTranslate->translates[app()->getLocale()] }}</p>
                            <p>{{ $teacher->subject->subjectTranslate->translates[app()->getLocale()] }}</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>{{ $teacher->enrollments_count }} {{ __("lang.students") }}</span>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <!-- /Feature Instructors -->
    </div>
</section>
