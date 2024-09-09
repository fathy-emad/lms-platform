@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.enrolled_courses") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.enrolled_courses") }}
        @endslot
        @slot('item1')
            {{ __("lang.profile") }}
        @endslot
        @slot('item2')
            {{ __("lang.enrolled_courses") }}
        @endslot
    @endcomponent

    @php
        $student = auth("student")->user();
        $enrollments = $student->enrollments();
        $all_enrollments = $enrollments->orderBy('id', 'desc')->get();
        $active_enrollments = $enrollments->whereDate("expired_at", ">=", \Carbon\Carbon::now($student->country->timezone))->orderBy('id', 'desc')->get();
        $completed_enrollments = $all_enrollments->diff($active_enrollments);
    @endphp

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

                @component('website_layouts.components.sidebar') @endcomponent

                <!-- Student Courses -->
                <div class="col-xl-9 col-lg-9">

                    <div class="settings-widget card-info">
                        <div class="settings-menu p-0">
                            <div class="profile-heading">
                                <h3>{{ __("lang.enrolled_courses") }}</h3>
                            </div>
                            <div class="checkout-form pb-0">
                                <div class="wishlist-tab">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="active" data-bs-toggle="tab" data-bs-target="#active-courses">{{ __("lang.active_courses") }} ({{ $active_enrollments ? $active_enrollments->count() : 0 }})</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#enrolled-courses">{{ __("lang.all_courses") }} ({{ $all_enrollments ? $all_enrollments->count() : 0 }})</a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#completed-courses">{{ __("lang.completed_courses") }} ({{ $completed_enrollments ? $completed_enrollments->count() : 0 }})</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="active-courses">
                                        <div class="row">
                                            @foreach($active_enrollments as $active_enrollment)
                                                <div class="col-xxl-4 col-md-6 d-flex">
                                                    <div class="course-box flex-fill">
                                                        <div class="product">
                                                            <div class="product-img">
                                                                <a href="{{ route('student.course', ["course_id" => $active_enrollment->course->id]) }}">
                                                                    <img class="img-fluid" alt="Img" src="{{URL::asset('/build/img/course/course-02.jpg')}}">
                                                                </a>
                                                                <div class="price">
                                                                    <h3>{{$active_enrollment->payment->cost}} LE</h3>
                                                                </div>
                                                            </div>
                                                            <div class="product-content">
                                                                <div class="course-group d-flex">
                                                                    <div class="course-group-img d-flex">
                                                                        <a href="{{url('instructor-profile')}}"><img src="{{ URL::asset($active_enrollment->course->teacher->image["file"] ? "uploads/".$active_enrollment->course->teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt="Img" class="img-fluid"></a>
                                                                        <div class="course-name">
                                                                            <h4><a href="{{url('instructor-profile')}}">{{ $active_enrollment->course->teacher->prefix }}/ {{ $active_enrollment->course->teacher->name }}</a></h4>
                                                                            <p>{{ __("lang.teacher") }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h3 class="title instructor-text"><a href="{{ route('student.course', ["course_id" => $active_enrollment->course->id]) }}">
                                                                        {{ $active_enrollment->course->titleTranslate->translates[app()->getLocale()] }}
                                                                    </a></h3>
                                                                <div class="course-info d-flex align-items-center">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="{{URL::asset('/build/img/icon/icon-01.svg')}}" alt="Img">
                                                                        <p>{{ array_sum(array_column($active_enrollment->course->curriculum->chapters->loadCount(["lessons" => fn($query) => $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)])->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="{{URL::asset('/build/img/icon/icon-02.svg')}}" alt="Img">
                                                                        <p>{{ floor($active_enrollment->course->loadSum("materials", "video_duration")->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $active_enrollment->course->loadSum("materials", "video_duration")->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                                                    </div>
                                                                </div>

                                                                <small class="web-badge bg-danger mb-3">exp: {{ $active_enrollment->expired_at}}</small>
                                                                <div class="rating mb-0 mt-3">
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <span class="d-inline-block average-rating"><span>5.0</span> (20)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="enrolled-courses">
                                        <div class="row">

                                            @foreach($all_enrollments as $all_enrollment)
                                                <div class="col-xxl-4 col-md-6 d-flex">
                                                    <div class="course-box flex-fill">
                                                        <div class="product">
                                                            <div class="product-img">
                                                                <a href="{{ route('student.course', ["course_id" => $all_enrollment->course->id]) }}">
                                                                    <img class="img-fluid" alt="Img" src="{{URL::asset('/build/img/course/course-02.jpg')}}">
                                                                </a>
                                                                <div class="price">
                                                                    <h3>{{$all_enrollment->payment->cost}} LE</h3>
                                                                </div>
                                                            </div>
                                                            <div class="product-content">
                                                                <div class="course-group d-flex">
                                                                    <div class="course-group-img d-flex">
                                                                        <a href="{{url('instructor-profile')}}"><img src="{{ URL::asset($all_enrollment->course->teacher->image["file"] ? "uploads/".$all_enrollment->course->teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt="Img" class="img-fluid"></a>
                                                                        <div class="course-name">
                                                                            <h4><a href="{{url('instructor-profile')}}">{{ $all_enrollment->course->teacher->prefix }}/ {{ $all_enrollment->course->teacher->name }}</a></h4>
                                                                            <p>{{ __("lang.teacher") }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h3 class="title instructor-text"><a href="{{ route('student.course', ["course_id" => $all_enrollment->course->id]) }}">
                                                                        {{ $all_enrollment->course->titleTranslate->translates[app()->getLocale()] }}
                                                                    </a></h3>
                                                                <div class="course-info d-flex align-items-center">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="{{URL::asset('/build/img/icon/icon-01.svg')}}" alt="Img">
                                                                        <p>{{ array_sum(array_column($all_enrollment->course->curriculum->chapters->loadCount(["lessons" => fn($query) => $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)])->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="{{URL::asset('/build/img/icon/icon-02.svg')}}" alt="Img">
                                                                        <p>{{ floor($all_enrollment->course->loadSum("materials", "video_duration")->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $all_enrollment->course->loadSum("materials", "video_duration")->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                                                    </div>
                                                                </div>
                                                                <small class="web-badge bg-danger mb-3">exp:  {{ $all_enrollment->expired_at }}</small>
                                                                <div class="rating mb-0 mt-3">
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <span class="d-inline-block average-rating"><span>5.0</span> (20)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="completed-courses">
                                        <div class="row">

                                            @foreach($completed_enrollments as $completed_enrollment)
                                                <div class="col-xxl-4 col-md-6 d-flex">
                                                    <div class="course-box flex-fill">
                                                        <div class="product">
                                                            <div class="product-img">
                                                                <a href="{{ route('student.course', ["course_id" => $completed_enrollment->course->id]) }}">
                                                                    <img class="img-fluid" alt="Img" src="{{URL::asset('/build/img/course/course-02.jpg')}}">
                                                                </a>
                                                                <div class="price">
                                                                    <h3>{{$completed_enrollment->payment->cost}} LE</h3>
                                                                </div>
                                                            </div>
                                                            <div class="product-content">
                                                                <div class="course-group d-flex">
                                                                    <div class="course-group-img d-flex">
                                                                        <a href="{{url('instructor-profile')}}"><img src="{{ URL::asset($completed_enrollment->course->teacher->image["file"] ? "uploads/".$completed_enrollment->course->teacher->image["file"] : '/build/img/user/user1.jpg') }}" alt="Img" class="img-fluid"></a>
                                                                        <div class="course-name">
                                                                            <h4><a href="{{url('instructor-profile')}}">{{ $completed_enrollment->course->teacher->prefix }}/ {{ $completed_enrollment->course->teacher->name }}</a></h4>
                                                                            <p>{{ __("lang.teacher") }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h3 class="title instructor-text"><a href="{{ route('student.course', ["course_id" => $completed_enrollment->course->id]) }}">
                                                                        {{ $completed_enrollment->course->titleTranslate->translates[app()->getLocale()] }}
                                                                    </a></h3>
                                                                <div class="course-info d-flex align-items-center">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="{{URL::asset('/build/img/icon/icon-01.svg')}}" alt="Img">
                                                                        <p>{{ array_sum(array_column($completed_enrollment->course->curriculum->chapters->loadCount(["lessons" => fn($query) => $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)])->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="{{URL::asset('/build/img/icon/icon-02.svg')}}" alt="Img">
                                                                        <p>{{ floor($completed_enrollment->course->loadSum("materials", "video_duration")->materials_sum_video_duration / 60) }} {{__("lang.hr")}} {{ $completed_enrollment->course->loadSum("materials", "video_duration")->materials_sum_video_duration % 60 }} {{__("lang.min")}}</p>
                                                                    </div>
                                                                </div>
                                                                <small class="web-badge bg-danger mb-3">exp: {{ $completed_enrollment->expired_at }}</small>
                                                                <div class="rating mb-0 mt-3">
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <span class="d-inline-block average-rating"><span>5.0</span> (20)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
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
