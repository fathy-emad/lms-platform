@php
    $bestCourses = \App\Models\Course::whereHas('curriculum', function ($query) {
        $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
            ->whereHas('chapters', function ($chapterQuery) {
                $chapterQuery->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
                    ->whereHas('lessons', function ($lessonQuery) {
                        $lessonQuery->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value);
                    });
            })
            ->whereHas('subject', function ($subjectQuery) {
                $subjectQuery->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
                    ->whereHas('year', function ($yearQuery) {
                        $yearQuery->where('id', 1)
                            ->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value);
                    });
            });
        })
        ->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)  // Course must be active
        ->with(['teacher','curriculum.chapters.lessons' => function ($query) {
            $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value);  // Filter active lessons
        }])
        ->withSum('materials', 'video_duration')  // Sum the video duration from materials
        ->withCount('enrollments')  // Count the enrollments for each course
        ->get()
        ->map(function ($course) {
            // Count active lessons by traversing curriculum -> chapters -> lessons
            $course->lessons_count = $course->curriculum->chapters->sum(function ($chapter) {
                return $chapter->lessons->count();
            });

            return $course;
        })
        ->groupBy(function ($course) {
            return $course->curriculum->subject->id;
        })
        ->map(function ($courses) {
            return $courses->first();
        });

@endphp
<section class="section new-course">
    <div class="container">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head">
                <span>{{ __("lang.whats_new") }}</span>
                <h2>{{ __("lang.featured_courses") }}</h2>
            </div>
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p class="mb-0">
                {{ __("lang.featured_courses_description") }}
            </p>
        </div>
        <div class="course-feature">
            <div class="row">
                @foreach($bestCourses as $best_course)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="course-box d-flex aos" data-aos="fade-up">
                            <div class="product">
                                <div class="product-img">
                                    <a href="{{ Route('student.course', ["course_id" => $best_course->id]) }}">
                                        <img class="img-fluid" alt="Img"
                                             src="{{ URL::asset(isset($best_course->image) ? 'uploads/'.$best_course->image["file"] : '/build/img/course/course-01.jpg') }}">
                                    </a>
                                    <div class="price">
                                        <h3>{{ $best_course->cost["course"] }} LE<span>{{ $best_course->cost["course"] * 2 }} LE</span></h3>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="course-group d-flex">
                                        <div class="course-group-img d-flex">
                                            <a href="{{ route('student.teacher.profile', ["teacher_id" => $best_course->teacher->id]) }}"><img
                                                    src="{{ URL::asset($best_course->teacher->image["file"] ? "uploads/".$best_course->teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt=""
                                                    class="img-fluid"></a>
                                            <div class="course-name">
                                                <h4><a href="{{ route('student.teacher.profile', ["teacher_id" => $best_course->teacher->id]) }}">{{ $best_course->teacher->prefix }}/ {{ $best_course->teacher->name }}</a></h4>
                                                <p>{{ __("lang.teacher") }}</p>
                                            </div>
                                        </div>
                                        <div class="course-share d-flex align-items-center justify-content-center">
                                            <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                  authorization="{{session("student_data")["jwtToken"] ?? ''}}"
                                                  action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                <input type="hidden" name="student_id" value="{{ auth("student")->id() }}">
                                                <input type="hidden" name="course_id" value="{{ $best_course->id }}">
                                                <input type="hidden" name="id"
                                                       value="{{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $best_course->id)->exists() ? (auth('student')->user()->carts()->where('course_id', $best_course->id)->first())->id : "" }}">
                                                <a href="#" onclick="cartFunctions(this)"><i class="fa-regular fa-heart {{ auth('student')->user() && auth('student')->user()->carts && auth('student')->user()->carts()->where('course_id', $best_course->id)->exists() ? "color-active" : "" }}"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <h3 class="title">
                                        <a href="{{ route('student.course', ["course_id" => $best_course->id]) }}">
                                            {{ $best_course->titleTranslate->translates[app()->getLocale()] }}
                                        </a>
                                    </h3>
                                    <div class="course-info d-flex align-items-center">
                                        <div class="rating-img d-flex align-items-center">
                                            <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="Img">
                                            <p>{{ $best_course->lessons_count }} {{ __("lang.lessons") }}</p>
                                        </div>
                                        <div class="course-view d-flex align-items-center">
                                            <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="Img">
                                            <p>{{ floor($best_course->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $best_course->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        @if(auth('student')->user() && auth('student')->user()->enrollments && auth('student')->user()->enrollments()->where('course_id', $best_course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->exists())
                                            <small class="web-badge bg-danger mb-3">exp: {{auth('student')->user()->enrollments()->where('course_id', $best_course->id)->whereDate("expired_at", ">=", \Carbon\Carbon::now(auth('student')->user()->country->timezone))->latest()->first()->expired_at}}</small>
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
                                                <input type="hidden" name="course_id" value="{{ $best_course->id }}">
                                                <a role="button" class="btn btn-primary" onclick="submitForm(this,null,window.location=APP_URL+'/profile/checkout',window.location=APP_URL+'/profile/checkout')">{{ __("lang.enroll_now") }}</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
