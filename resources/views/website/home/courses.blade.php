@extends('website_layouts.mainlayout')

@section('title') {{ __("lang.courses") }} @endsection
@section('style')
@endsection

@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.courses") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.courses") }}
        @endslot
    @endcomponent

    @php
        $perPage = 9;
        $filter = request("filter");

        if (!$filter || $filter == "newest")
        {
            $column = "id";
            $order = "desc";
        } elseif ($filter == "oldest") {
            $column = "id";
            $order = "asc";
        } else {
            $column = \Illuminate\Support\Facades\DB::raw("CAST(JSON_UNQUOTE(JSON_EXTRACT(cost, '$.course')) AS UNSIGNED)");
            $order = $filter == "price_low" ? "asc" : "desc";
        }

        $courses = \App\Models\Course::with(["curriculum.chapters" => function ($query) {
                        $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
                        ->withCount(["lessons" => function ($query) {
                            $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value);
                        }]);
                }])
                ->withSum("materials", "video_duration")
                ->where("curriculum_id", request("curriculum_id"))
                ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
                ->orderBy($column, $order)
                ->paginate($perPage);

        $curriculum = \App\Models\Curriculum::find(request("curriculum_id"));
        $current_year_id = $curriculum->subject->year->id;
        $current_subject_id = $curriculum->subject->id;

        $latestCoursesData = \App\Models\Course::whereHas('curriculum.subject.year', function ($query) use ($current_year_id) {
                $query->where('id', $current_year_id);
            })
            ->whereHas('curriculum.subject', function ($query) use ($current_subject_id) {
                $query->where('id', '!=', $current_subject_id); // Exclude the current subject
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
            ->with(['curriculum.subject.subject.subjectTranslate', 'curriculum.curriculumTranslate'])
            ->get();

    @endphp

    @if($courses->count())

        <!-- Course -->
        <section class="course-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @component('website_layouts.components.filter_courses')
                            @slot('total') {{ $courses->total() }} @endslot
                            @slot('perPage') {{ $perPage }} @endslot
                            @slot('result') {{ $courses->count() }} @endslot
                        @endcomponent
                        <div class="row">

                            @foreach($courses as $course)
                                <div class="col-lg-4 col-md-6 d-flex">
                                    <div class="course-box course-design d-flex ">
                                        <div class="product">
                                            <div class="product-img">
                                                <a href="{{ route('student.course', ["course_id" => $course->id]) }}">
                                                    <img class="img-fluid" alt=""
                                                         src="{{ URL::asset('/build/img/course/course-10.jpg') }}">
                                                </a>
                                                <div class="price">
                                                    <h3>{{$course->cost["course"]}} LE<span>1000.00 LE</span></h3>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="course-group d-flex">
                                                    <div class="course-group-img d-flex">
                                                        <a href="{{ url('instructor-profile') }}"><img
                                                                src="{{ URL::asset($course->teacher->image["file"] ? "uploads/".$course->teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt=""
                                                                class="img-fluid"></a>
                                                        <div class="course-name">
                                                            <h4><a href="{{ url('instructor-profile') }}">{{ $course->teacher->prefix }}/ {{ $course->teacher->name }}</a></h4>
                                                            <p>{{ __("lang.teacher") }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="course-share d-flex align-items-center justify-content-center">
                                                        <a href="#rate"><i class="fa-regular fa-heart"></i></a>
                                                    </div>
                                                </div>
                                                <h3 class="title"><a href="{{ route('student.course', ["course_id" => $course->id]) }}">
                                                        {{ $course->titleTranslate->translates[app()->getLocale()] }}
                                                    </a></h3>

                                                <div class="course-info d-flex align-items-center">
                                                    <div class="rating-img d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                                        <p>{{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                    </div>
                                                    <div class="course-view d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="">
                                                        <p>{{ floor($course->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $course->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                                    </div>
                                                </div>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                                                </div>
                                                <div class="all-btn all-category d-flex align-items-center">
                                                    <a href="{{ url('checkout') }}" class="btn btn-primary">{{ __("lang.buy_now") }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @component('website_layouts.components.pagination', ["data" => $courses]) @endcomponent

                    </div>

                    @if($latestCourses->count())
                        <div class="col-lg-3 theiaStickySidebar">
                            <div class="filter-clear">
                                <!-- Latest Posts -->
                                <div class="card post-widget ">
                                    <div class="card-body">
                                        <div class="latest-head">
                                            <h4 class="card-title">{{ __("lang.latest_for_you") }}</h4>
                                        </div>

                                        <ul class="latest-posts">

                                                @foreach($latestCourses as $latest)
                                                    <li>
                                                        <div class="post-thumb">
                                                            <a href="{{ route('student.course', ["course_id" => $latest->id]) }}">
                                                                <img class="img-fluid"
                                                                     src="{{ URL::asset('/build/img/blog/blog-01.jpg') }}"
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
                                                                    ({{ $latest->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}) -
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

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- /Course -->
    @else
        @include("website_layouts.components.errors.coming_soon")
    @endif
@endsection
