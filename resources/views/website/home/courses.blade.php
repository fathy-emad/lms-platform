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

    @php $courses = \App\Models\Course::with(["curriculum.chapters" => function ($query) {
                            $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
                            ->withCount(["lessons" => function ($query) {
                                $query->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value);
                            }]);
                    }])
                    ->where("curriculum_id", request("curriculum_id"))
                    ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
                    ->orderBy("id", "desc")
                    ->get();
    @endphp

    @if($courses->count())

        <!-- Course -->
        <section class="course-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @component('website_layouts.components.filter') @endcomponent
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
                                                            <p>Instructor</p>
                                                        </div>
                                                    </div>
                                                    <div class="course-share d-flex align-items-center justify-content-center">
                                                        <a href="#rate"><i class="fa-regular fa-heart"></i></a>
                                                    </div>
                                                </div>
                                                <h3 class="title"><a href="{{ route('student.course', ["course_id" => $course->id]) }}">
                                                        {{ $course->title ?: "Course title" }}
                                                    </a></h3>

                                                <div class="course-info d-flex align-items-center">
                                                    <div class="rating-img d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                                        <p>{{ array_sum(array_column($course->curriculum->chapters->toArray(), "lessons_count")) }} {{ __("lang.lessons") }}</p>
                                                    </div>
                                                    <div class="course-view d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="">
                                                        <p>9hr 30min</p>
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

                        @component('website_layouts.components.pagination') @endcomponent

                    </div>
                    <div class="col-lg-3 theiaStickySidebar">
                        <div class="filter-clear">
                            <div class="clear-filter d-flex align-items-center">
                                <h4><i class="feather-filter"></i>Filters</h4>
                                <div class="clear-text">
                                    <p>CLEAR</p>
                                </div>
                            </div>

                            <!-- Search Filter -->
                            <div class="card search-filter">
                                <div class="card-body">
                                    <div class="filter-widget mb-0">
                                        <div class="categories-head d-flex align-items-center">
                                            <h4>Course categories</h4>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Backend (3)

                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> CSS (2)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Frontend (2)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist" checked>
                                                <span class="checkmark"></span> General (2)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist" checked>
                                                <span class="checkmark"></span> IT & Software (2)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Photography (2)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Programming Language (3)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check mb-0">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Technology (2)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search Filter -->

                            <!-- Search Filter -->
                            <div class="card search-filter">
                                <div class="card-body">
                                    <div class="filter-widget mb-0">
                                        <div class="categories-head d-flex align-items-center">
                                            <h4>Instructors</h4>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Keny White (10)

                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> Hinata Hyuga (5)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="select_specialist">
                                                <span class="checkmark"></span> John Doe (3)
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check mb-0">
                                                <input type="checkbox" name="select_specialist" checked>
                                                <span class="checkmark"></span> Nicole Brown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search Filter -->

                            <!-- Search Filter -->
                            <div class="card search-filter ">
                                <div class="card-body">
                                    <div class="filter-widget mb-0">
                                        <div class="categories-head d-flex align-items-center">
                                            <h4>Price</h4>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                        <div>
                                            <label class="custom_check custom_one">
                                                <input type="radio" name="select_specialist">
                                                <span class="checkmark"></span> All (18)

                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check custom_one">
                                                <input type="radio" name="select_specialist">
                                                <span class="checkmark"></span> Free (3)

                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check custom_one mb-0">
                                                <input type="radio" name="select_specialist" checked>
                                                <span class="checkmark"></span> Paid (15)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search Filter -->

                            <!-- Latest Posts -->
                            <div class="card post-widget ">
                                <div class="card-body">
                                    <div class="latest-head">
                                        <h4 class="card-title">Latest Courses</h4>
                                    </div>
                                    <ul class="latest-posts">
                                        <li>
                                            <div class="post-thumb">
                                                <a href="{{ url('course-details') }}">
                                                    <img class="img-fluid"
                                                         src="{{ URL::asset('/build/img/blog/blog-01.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="post-info free-color">
                                                <h4>
                                                    <a href="{{ url('course-details') }}">Introduction LearnPress – LMS
                                                        plugin</a>
                                                </h4>
                                                <p>FREE</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb">
                                                <a href="{{ url('course-details') }}">
                                                    <img class="img-fluid"
                                                         src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <h4>
                                                    <a href="{{ url('course-details') }}">Become a PHP Master and Make
                                                        Money</a>
                                                </h4>
                                                <p>$200</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb">
                                                <a href="{{ url('course-details') }}">
                                                    <img class="img-fluid"
                                                         src="{{ URL::asset('/build/img/blog/blog-03.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="post-info free-color">
                                                <h4>
                                                    <a href="{{ url('course-details') }}">Learning jQuery Mobile for
                                                        Beginners</a>
                                                </h4>
                                                <p>FREE</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb">
                                                <a href="{{ url('course-details') }}">
                                                    <img class="img-fluid"
                                                         src="{{ URL::asset('/build/img/blog/blog-01.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <h4>
                                                    <a href="{{ url('course-details') }}">Improve Your CSS Workflow with
                                                        SASS</a>
                                                </h4>
                                                <p>$200</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb ">
                                                <a href="{{ url('course-details') }}">
                                                    <img class="img-fluid"
                                                         src="{{ URL::asset('/build/img/blog/blog-02.jpg') }}"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="post-info free-color">
                                                <h4>
                                                    <a href="{{ url('course-details') }}">HTML5/CSS3 Essentials in 4-Hours</a>
                                                </h4>
                                                <p>FREE</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Latest Posts -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Course -->
    @else
        @include("website_layouts.components.errors.coming_soon")
    @endif
@endsection
