@extends('website_layouts.mainlayout')
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
        $course = \App\Models\Course::find(request("course_id"));
        $chapters = $course?->curriculum->chapters;
        $materials = $course?->materials;
        $enrolled = auth("student")->user() !== null && auth("student")->user()->enrollments->count() ?
            auth("student")->user()->enrollments()
            ->where("expired_at", ">=", \Carbon\Carbon::now(auth("student")->user()->country->timezone))
            ->where("course_id", $course?->id)
            ->exists() :
            false;
        $lesson_data = \App\Models\Lesson::find(request("lesson_id"));
        $lesson_material = $materials?->where("lesson_id", request("lesson_id"))->first();
        $lesson_duration = $lesson_material?->video_duration;
        $lesson_free = $lesson_material?->FreeEnum == \App\Enums\FreeEnum::Free;
        $watch_video = $lesson_free || $enrolled;
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
                                    <p>{{floor($lesson_duration / 60) }} {{ __("lang.hr") }} {{floor($lesson_duration % 60) }} {{ __("lang.min") }}</p>
                                    @if($watch_video)
                                        <div class="introduct-video">
                                            <a href="https://www.youtube.com/embed/1trvO6dqQUI" class="video-thumbnail"
                                               data-fancybox="">
                                                <div class="play-icon">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                                <img class="" src="{{ URL::asset('/build/img/video-img-01.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div>
                                    @else
                                        @include("website_layouts.components.errors.view")
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

