@extends('website_layouts.mainlayout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">

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

            if($lesson_video_view = $course_lesson_views->sum("views") < ($course_enrollments->count() * 3))
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
                                            <span @if(app()->getLocale() == "ar") style="float: left" @endif>{{ $chapter->lessons->count() }} {{ __("lang.lessons") }}</span> </a>
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
                                                     $lesson_views = \App\Models\StudentLessonView::where("lesson_id", $lesson->id)
                                                                                ->whereIn("enrollment_id", $course_enrollment_ids ?? [])->orderBy("id", "desc");
                                                 @endphp
                                                <li>

                                                    @if($enrolled || $is_free)
                                                        <a href="{{ route("student.lesson", ["course_id" => $course->id, "lesson_id" => $lesson->id]) }}"
                                                           class="{{ $lesson->id == request("lesson_id") ? 'play-intro' : '' }}">
                                                            {{ $lesson->lessonTranslate->translates[app()->getLocale()] }}
                                                            <small>({{floor($duration / 60) }} {{ __("lang.hr") }} {{floor($duration % 60) }} {{ __("lang.min") }})</small>
                                                            @if($enrolled)<small>({{ $lesson_views->sum("views") . " : 3 " .  __("lang.views") }})</small>@endif
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
                                        {{ $course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }},
                                        <a href="{{ route('student.curricula', ["year_id" => $course->curriculum->subject->year->id]) }}"
                                            style="font-weight: bolder;color: #f66962">
                                            {{ $course->curriculum->curriculumTranslate->translates[app()->getLocale()] }},
                                        </a>
                                        <a href="{{ route('student.course', ["course_id" => $course->id]) }}"
                                           style="font-weight: bolder;color: #f66962">
                                            {{ $course->titleTranslate->translates[app()->getLocale()] }}
                                        </a>
                                    </p>
                                    <p>
                                        {{floor($lesson_duration / 60) }} {{ __("lang.hr") }} {{floor($lesson_duration % 60) }} {{ __("lang.min") }}
                                        <span class="text-danger">&nbsp;({{ isset($course_lesson_views) ? $course_lesson_views->sum("views") . " : 3" : "0 : 3" }} {{ __("lang.views") }})</span>
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
{{--                            @if($enrolled)--}}
{{--                                <div class="settings-widget card-info mt-3">--}}
{{--                                    <div class="settings-menu p-0">--}}
{{--                                        <div class="profile-heading">--}}
{{--                                            <h3>{{ __("lang.attachments") }}</h3>--}}
{{--                                        </div>--}}
{{--                                        <div class="checkout-form pb-0">--}}
{{--                                            <div class="wishlist-tab">--}}
{{--                                                <ul class="nav">--}}
{{--                                                    <li class="nav-item">--}}
{{--                                                        <a href="javascript:void(0);" class="active" data-bs-toggle="tab" data-bs-target="#files">{{ __("lang.files") }}</a>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="nav-item">--}}
{{--                                                        <a href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#images">{{ __("lang.images") }}</a>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}

{{--                                            <div class="tab-content">--}}
{{--                                                <div class="tab-pane fade show active" id="files">--}}
{{--                                                    <div class="row">--}}
{{--                                                        @if(count($lesson_material->files ?? []))--}}
{{--                                                            @foreach($lesson_material->files as $file)--}}
{{--                                                                <div class="col-4 d-flex">--}}
{{--                                                                    <div class="course-box course-design d-flex">--}}
{{--                                                                        <div class="product">--}}
{{--                                                                            <div class="product-img">--}}
{{--                                                                                <a href="javascript:void(0);" role="button">--}}
{{--                                                                                    <img class="img-fluid" alt=""--}}
{{--                                                                                         src="{{ URL::asset('/build/img/document.png') }}">--}}
{{--                                                                                </a>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="product-content">--}}
{{--                                                                                <h3 class="title">--}}
{{--                                                                                    <a href="javascript:void(0);" role="button"> {{ $file["title"] }} </a>--}}
{{--                                                                                </h3>--}}
{{--                                                                                <div class="all-btn all-category d-flex align-items-center mt-3">--}}
{{--                                                                                    <a role="button" class="btn btn-primary">{{ __("lang.download") }}</a>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            @endforeach--}}
{{--                                                        @else--}}
{{--                                                            <p>no files found</p>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="tab-pane fade" id="images">--}}
{{--                                                    <div class="row justify-content-around">--}}
{{--                                                        @if(count($lesson_material->images ?? []))--}}
{{--                                                            <div class="my-gallery card-body row gallery-with-description p-0" itemscope="">--}}
{{--                                                                @foreach($lesson_material->images as $image)--}}
{{--                                                                <figure class="col-4" itemprop="associatedMedia" itemscope="">--}}
{{--                                                                    <a href="{{asset("uploads/$image[file]")}}" itemprop="contentUrl" data-size="1600x950">--}}
{{--                                                                        <img src="{{asset("uploads/$image[file]")}}" itemprop="thumbnail" alt="Image description">--}}
{{--                                                                        <div class="caption">--}}
{{--                                                                            <h4>{{ $image["title"] ?? "" }}</h4>--}}
{{--                                                                        </div>--}}
{{--                                                                    </a>--}}
{{--                                                                    <figcaption itemprop="caption description">--}}
{{--                                                                        <h4>{{ $image["title"] ?? "" }}</h4>--}}
{{--                                                                    </figcaption>--}}
{{--                                                                </figure>--}}
{{--                                                                @endforeach--}}
{{--                                                            </div>--}}

{{--                                                            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">--}}
{{--                                                                <!----}}
{{--                                                                    Background of PhotoSwipe.--}}
{{--                                                                    It's a separate element, as animating opacity is faster than rgba().--}}
{{--                                                                    -->--}}
{{--                                                                <div class="pswp__bg"></div>--}}
{{--                                                                <!-- Slides wrapper with overflow:hidden.-->--}}
{{--                                                                <div class="pswp__scroll-wrap">--}}
{{--                                                                    <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->--}}
{{--                                                                    <!-- don't modify these 3 pswp__item elements, data is added later on.-->--}}
{{--                                                                    <div class="pswp__container">--}}
{{--                                                                        <div class="pswp__item"></div>--}}
{{--                                                                        <div class="pswp__item"></div>--}}
{{--                                                                        <div class="pswp__item"></div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->--}}
{{--                                                                    <div class="pswp__ui pswp__ui--hidden">--}}
{{--                                                                        <div class="pswp__top-bar">--}}
{{--                                                                            <!-- Controls are self-explanatory. Order can be changed.-->--}}
{{--                                                                            <div class="pswp__counter"></div>--}}
{{--                                                                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>--}}
{{--                                                                            <button class="pswp__button pswp__button--share" title="Share"></button>--}}
{{--                                                                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>--}}
{{--                                                                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>--}}
{{--                                                                            <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->--}}
{{--                                                                            <!-- element will get class pswp__preloader--active when preloader is running-->--}}
{{--                                                                            <div class="pswp__preloader">--}}
{{--                                                                                <div class="pswp__preloader__icn">--}}
{{--                                                                                    <div class="pswp__preloader__cut">--}}
{{--                                                                                        <div class="pswp__preloader__donut"></div>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">--}}
{{--                                                                            <div class="pswp__share-tooltip"></div>--}}
{{--                                                                        </div>--}}
{{--                                                                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>--}}
{{--                                                                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>--}}
{{--                                                                        <div class="pswp__caption">--}}
{{--                                                                            <div class="pswp__caption__center"></div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        @else--}}
{{--                                                            <p>no images found</p>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="settings-widget card-info mt-3">--}}
{{--                                    <div class="settings-menu p-0">--}}
{{--                                        <div class="profile-heading">--}}
{{--                                            <h3>{{ __("lang.assignments") }}</h3>--}}
{{--                                        </div>--}}
{{--                                        <div class="checkout-form pb-0">--}}
{{--                                            <div class="row">--}}
{{--                                                @if(count($lesson_material->assignment ?? []))--}}
{{--                                                    @php $results = \App\Models\AssignmentResult::where(["lesson_id" => request("lesson_id"), "student_id" => auth("student")->id()])->get() @endphp--}}
{{--                                                    @if($results->count())--}}

{{--                                                    @else--}}
{{--                                                        <form>--}}
{{--                                                            <input type="hidden" name="lesson_id" value="{{ request("lesson_id") }}">--}}
{{--                                                            @foreach($lesson_material->questions as $question)--}}
{{--                                                                <div class="col-12">--}}
{{--                                                                    <p>{{ $question->question }}</p>--}}
{{--                                                                </div>--}}
{{--                                                            @endforeach--}}
{{--                                                        </form>--}}
{{--                                                    @endif--}}

{{--                                                @else--}}
{{--                                                    <p>no assignment found</p>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
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

@section("script")
    <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
@endsection

