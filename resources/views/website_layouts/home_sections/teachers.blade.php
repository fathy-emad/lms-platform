@php
    $teachers = \App\Models\Teacher::where("TeacherStatusEnum", \App\Enums\TeacherStatusEnum::Active->value)
        ->with(["stage.stageTranslate", "subject.subjectTranslate"])
        ->withCount(['courses as enrollments_count' => function ($query) {
            $query->join('enrollments', 'courses.id', '=', 'enrollments.course_id');
        }])
        ->get();
@endphp
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
