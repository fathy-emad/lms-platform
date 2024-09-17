@extends('website_layouts.mainlayout')
@section('title')
    {{ __("lang.cart") }}
@endsection
@section('content')

    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.cart") }}
        @endslot
        @slot('item1')
            {{ __("lang.profile") }}
        @endslot
        @slot('item2')
            {{ __("lang.cart") }}
        @endslot
    @endcomponent

    <!-- Cart -->
    <section class="course-content cart-widget">
        <div class="container">
            <div class="student-widget">
                <div class="student-widget-group">
                    <div class="row">
                        <div class="col-lg-12">

                            @if($items = auth("student")->user()->carts)
                                <div class="cart-head">
                                    <h4>{{ __("lang.your_cart") }} ({{ $items->count() }} {{ __("lang.items") }})</h4>
                                </div>
                                <div class="cart-group">
                                    <div class="row">
                                        @php $total = 0 @endphp
                                        @foreach($items as $item)
                                            @php
                                                $cost = $item->course->cost["course"];
                                                $total += $cost;
                                                $course_id = $item->course->id;
                                                $course_image = \Illuminate\Support\Facades\URL::asset(isset($item->course->image?->file) ? 'uploads/'.$item->course->image?->file : '/build/img/course.png');
                                                $course_title = $item->course->titleTranslate->translates[app()->getLocale()];
                                                $stage_title = $item->course->curriculum->subject->year->stage->stageTranslate->translates[app()->getLocale()];
                                                $curriculum_title = $item->course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()];
                                                $curriculum_id = $item->course->curriculum->id;
                                                $subject_title = $item->course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()];
                                                $course_lessons = array_sum(array_column($item->course->curriculum->chapters->loadCount("lessons")->toArray(), "lessons_count"));
                                                $course_duration = floor($item->course->loadSum("materials", "video_duration")->materials_sum_video_duration / 60) . __("lang.hr") . "  " . $item->course->loadSum("materials", "video_duration")->materials_sum_video_duration % 60 . __("lang.min");
                                            @endphp
                                            <div class="col-lg-12 col-md-12 d-flex">
                                                <div class="course-box course-design list-course d-flex">
                                                    <div class="product">
                                                        <div class="product-img">
                                                            <a href="{{ route("student.course", ["course_id" => $course_id]) }}">
                                                                <img class="img-fluid" alt=""
                                                                     src="{{ $course_image }}">
                                                            </a>
                                                            <div class="price">
                                                                <h3 class="free-color">{{ $cost }} LE</h3>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="head-course-title mb-2">
                                                                <h3 class="title"><a
                                                                        href="{{ route("student.course", ["course_id" => $course_id]) }}">{{ $course_title }}</a>
                                                                </h3>
                                                            </div>
                                                            <div class="head-course-title">
                                                                <h5 class="title"><a
                                                                        href="{{ route("student.courses", ["curriculum_id" => $curriculum_id]) }}">
                                                                        {{ $stage_title }}, {{ $curriculum_title }}
                                                                        , {{ $subject_title }}
                                                                    </a></h5>
                                                            </div>
                                                            <div
                                                                class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                <div class="rating-img d-flex align-items-center">
                                                                    <img
                                                                        src="{{ URL::asset('/build/img/icon/icon-01.svg') }}"
                                                                        alt="">
                                                                    <p>{{ $course_lessons }} {{ __("lang.lessons") }}</p>
                                                                </div>
                                                                <div class="course-view d-flex align-items-center">
                                                                    <img
                                                                        src="{{ URL::asset('/build/img/icon/icon-02.svg') }}"
                                                                        alt="">
                                                                    <p>{{ $course_duration }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="rating">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span
                                                                    class="d-inline-block average-rating"><span>4.0</span>(15)</span>
                                                            </div>
                                                        </div>
                                                        <div class="cart-remove">
                                                            <form novalidate="" class="theme-form needs-validation"
                                                                  id="form" method="POST"
                                                                  authorization="{{session("student_data")["jwtToken"] ?? ""}}"
                                                                  action="{{ url("api/student/cart") }}"
                                                                  locale="{{app()->getLocale()}}"
                                                                  csrf="{{ csrf_token()}}">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="id"
                                                                       value="{{ $item->id ?? ""}}">
                                                                <a href="#" class="btn btn-primary"
                                                                   onclick="submitForm(this, null, location.reload())">{{ __("lang.remove") }}</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="cart-total">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="cart-subtotal">
                                                <p>{{ __("lang.total") }} <span>{{ $total }} LE</span></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="check-outs">
                                                <a href="{{ route('student.checkout') }}"
                                                   class="btn btn-primary">{{ __("lang.checkout") }}</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="condinue-shop">
                                                <a href="{{ route('student.website') }}"
                                                   class="btn btn-primary">{{ __("lang.continue_shopping") }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @include("website_layouts.components.errors.empty_cart")
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Cart -->
@endsection
