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
    </style>
@endsection
@section("title")
    {{ __("lang.lesson") }}
@endsection
@section('content')

    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.lesson") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.lesson") }}
        @endslot
    @endcomponent

    @php
        $course = \App\Models\Course::whereHas('teacher', function ($query) {
                    $query->where('TeacherStatusEnum', \App\Enums\TeacherStatusEnum::Active->value); // Ensure the teacher is active
               })
               ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
               ->find(request("course_id"));
        $chapters = $course?->curriculum->chapters()->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)->get();
        $materials = $course?->materials()->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)->get();
        $student = auth("student")->user();
        $enrolled = $student && $student->enrollments()->exists() && $student->enrollments()
            ->whereDate("expired_at", ">=", \Carbon\Carbon::now($student->country->timezone))
            ->where("course_id", $course?->id)
            ->exists();
        $lesson_data = \App\Models\Lesson::find(request("lesson_id"));
        $lesson_material = $materials?->where("lesson_id", request("lesson_id"))->first();
        $lesson_duration = $lesson_material?->video_duration;
        $lesson_free = $lesson_material?->FreeEnum == \App\Enums\FreeEnum::Free;
        $lesson_video_view = false;

        if ($enrolled && isset($lesson_material) && $lesson_material && !$lesson_free)
        {
            $course_enrollments = $student->enrollments()
            ->whereDate("expired_at", ">=", \Carbon\Carbon::now($student->country->timezone))
            ->where("course_id", $course?->id)->get();

            $course_enrollment_ids = array_column($course_enrollments->toArray(), "id");

            $course_lesson_views = \App\Models\StudentLessonView::where("lesson_id", request("lesson_id"))
            ->whereIn("enrollment_id", $course_enrollment_ids)->orderBy("id", "desc");

            if($lesson_video_view = $course_lesson_views->sum("views") < ($course_enrollments->count() * 5))
            {
                $videoId = $lesson_material->video;
                $apiSecret = env("VDO_API_SECRET");

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => 'Apisecret ' . $apiSecret,
                ])->post('https://dev.vdocipher.com/api/videos/' . $videoId . '/otp', [
                    'ttl' => 300,
                    'annotate' => json_encode([
                        [
                           'type'=>'rtext',
                           'text'=> "$student->phone",
                           'alpha'=>'0.8',
                           'color'=>'0xFFFFFF',
                           'size'=>'35',
                           'interval'=> 3000,
                           'skip'=> 1000
                        ],
                        [
                           'type'=>'rtext',
                           'text'=> "$student->email",
                           'alpha'=>'0.8',
                           'color'=>'0xFFFFFF',
                           'size'=>'30',
                           'interval'=> 3000,
                           'skip'=> 1000
                        ],
                    ]),
                ]);

                if ($response->successful()) {
                    // Get the response data as JSON
                    $data = $response->json();
                    $otp = $data['otp'];
                    $playbackInfo = $data['playbackInfo'];

                    if ($course_lesson_views->count())
                        ($course_lesson_views->first())->increment("views", 1);

                    elseif (!$course_lesson_views->count())
                        \App\Models\StudentLessonView::create(["views" => 1, "lesson_id" => request("lesson_id"), "enrollment_id" => ($course_enrollments->last())->id]);
                } else {
                    $statusCode = $response->status();
                    $error = $response->body();
                    $lesson_video_view = false;
                }
            }
        }

        $watch_video = $lesson_free || $lesson_video_view;
    @endphp

    <!-- Course Lesson -->
    <section class="page-content course-sec course-lesson">
        <div class="container">
            <div class="row">
                @if($course && $chapters)
                    <div class="col-lg-4">
                        <!-- Course Lesson -->
                        <div class="lesson-group">

                            @foreach($chapters as $chapter)
                                @php
                                    $lessons_id = array_column($chapter->lessons->toArray(), "id");
                                    $materials_duration = array_sum(array_column($materials->whereIn('lesson_id', $lessons_id)->toArray(), "video_duration")) ?? 0;
                                @endphp
                                <div class="course-card">
                                    <h6 class="cou-title">
                                        <a class="{{ !$chapter->lessons()->where("id", request("lesson_id"))->exists() ? "collapsed" : "" }}"
                                           data-bs-toggle="collapse" href="#collapseOne_{{$chapter->id}}"
                                           aria-expanded="false">{{ $chapter->chapterTranslate->translates[app()->getLocale()] }}
                                            <span>{{ $chapter->lessons->count() }} {{ __("lang.lessons") }}</span> </a>
                                    </h6>
                                    <div id="collapseOne_{{$chapter->id}}" class="card-collapse collapse {{ $chapter->lessons()->where("id", request("lesson_id"))->exists() ? "show" : "" }}" style="">
                                        <div class="student-percent lesson-percent">
                                            <p>{{floor($materials_duration / 60) }} {{ __("lang.hr") }} {{floor($materials_duration % 60) }} {{ __("lang.min") }}</p>
                                        </div>
                                        <ul>
                                            @foreach($chapter->lessons as $lesson)
                                                @php
                                                     $material = $materials->where("lesson_id", $lesson->id)->first();
                                                     $duration = isset($material) ? $material->video_duration : 0;
                                                     $is_free = isset($material) && $material->FreeEnum == \App\Enums\FreeEnum::Free;
                                                 @endphp
                                                <li>

                                                    @if($enrolled || $is_free)
                                                        <a href="{{ route("student.lesson", ["course_id" => $course->id, "lesson_id" => $lesson->id]) }}"
                                                           class="{{ $lesson->id == request("lesson_id") ? 'play-intro' : '' }}">
                                                            {{ $lesson->lessonTranslate->translates[app()->getLocale()] }}
                                                            <small>({{floor($duration / 60) }} {{ __("lang.hr") }} {{floor($duration % 60) }} {{ __("lang.min") }})</small>
                                                        </a>
                                                        <div>
                                                            <img src="{{ URL::asset('/build/img/icon/play-icon.svg') }}" alt="">
                                                        </div>
                                                    @else
                                                        <p class="{{ $lesson->id == request("lesson_id") ? 'play-intro' : '' }}">
                                                            {{ $lesson->lessonTranslate->translates[app()->getLocale()] }}
                                                            <small>({{floor($duration / 60) }} {{ __("lang.hr") }} {{floor($duration % 60) }} {{ __("lang.min") }})</small>
                                                        </p>
                                                        <div>
                                                            <img src="{{ URL::asset('/build/img/icon/lock.svg') }}" alt="">
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- /Course Lesson -->

                    </div>
                    <div class="col-lg-8">
                        <!-- Introduction -->
                        @if($lesson_data)
                            <div class="student-widget lesson-introduction">
                                <div class="lesson-widget-group">
                                    <h4 class="tittle">
                                        {{ $lesson_data->lessonTranslate->translates[app()->getLocale()] }}
                                        <small class="text-dark">{{ $course->teacher->prefix->title() }}/ {{ $course->teacher->name }}</small>
                                    </h4>
                                    <p>
                                        {{ $course->curriculum->subject->year->stage->stageTranslate->translates[app()->getLocale()] }},
                                        {{ $course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }},
                                        {{ $course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}
                                    </p>
                                    <p>
                                        {{floor($lesson_duration / 60) }} {{ __("lang.hr") }} {{floor($lesson_duration % 60) }} {{ __("lang.min") }}
                                        <span class="text-danger">&nbsp;({{ isset($course_lesson_views) ? $course_lesson_views->sum("views") : 0 }} {{ __("lang.views") }})</span>
                                    </p>
                                    @if($watch_video)
                                        <div class="introduct-video">
                                            @if($lesson_free)
                                                <div class="video-container">
                                                    <iframe
                                                        width="560"
                                                        height="315"
                                                        src="https://www.youtube.com/embed/{{$lesson_material->video}}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @else
                                                <div class="video-container">
                                                    <iframe
                                                        src="https://player.vdocipher.com/v2/?otp={{$otp}}&playbackInfo={{$playbackInfo}}"
                                                        style="border:0;"
                                                        allow="encrypted-media"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        @include("website_layouts.components.errors.view", ["error" => $error ?? ""])
                                    @endif
                                </div>
                            </div>
                        @else
                            @include("website_layouts.components.errors.coming_soon")
                        @endif
                        <!-- /Introduction -->
                    </div>
                @else
                    @include("website_layouts.components.errors.coming_soon")
                @endif
            </div>
        </div>
    </section>
    <!-- /Course Lesson -->
@endsection

