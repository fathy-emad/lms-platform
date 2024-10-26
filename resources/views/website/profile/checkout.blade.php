@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.checkout") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.checkout") }}
        @endslot
        @slot('item1')
            {{ __("lang.profile") }}
        @endslot
        @slot('item2')
            {{ __("lang.checkout") }}
        @endslot
    @endcomponent
    <!-- Cart -->
    <section class="course-content checkout-widget">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- cart data -->
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
                                                        $course_image = \Illuminate\Support\Facades\URL::asset(isset($item->course->image['file']) ? 'uploads/'.$item->course->image['file'] : '/build/img/course.png');
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
                                                                        <h3 class="title"><a href="{{ route("student.course", ["course_id" => $course_id]) }}">{{ $course_title }}</a></h3>
                                                                    </div>
                                                                    <div class="head-course-title">
                                                                        <h5 class="title"><a href="{{ route("student.courses", ["curriculum_id" => $curriculum_id]) }}">
                                                                                {{ $stage_title }}, {{ $curriculum_title }}, {{ $subject_title }}
                                                                            </a></h5>
                                                                    </div>
                                                                    <div class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                        <div class="rating-img d-flex align-items-center">
                                                                            <img src="{{ URL::asset('/build/img/icon/icon-01.svg') }}" alt="">
                                                                            <p>{{ $course_lessons }} {{ __("lang.lessons") }}</p>
                                                                        </div>
                                                                        <div class="course-view d-flex align-items-center">
                                                                            <img src="{{ URL::asset('/build/img/icon/icon-02.svg') }}" alt="">
                                                                            <p>{{ $course_duration }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="rating">
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star filled"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="d-inline-block average-rating"><span>4.0</span>(15)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="cart-remove">
                                                                    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                                          authorization="{{session("student_data")["jwtToken"] ?? ""}}"
                                                                          action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input type="hidden" name="id" value="{{ $item->id ?? ""}}">
                                                                        <a href="#" class="btn btn-primary" onclick="submitForm(this, null, location.reload())">{{ __("lang.remove") }}</a>
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
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="condinue-shop">
                                                        <a href="{{ route('student.website') }}" class="btn btn-primary">{{ __("lang.continue_shopping") }}</a>
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
                    <!-- /cart data -->

                    <!-- /Payment Method -->
                    <div class="student-widget pay-method">
                        <div class="student-widget-group add-course-info">
                            <div class="cart-head">
                                <h4>{{ __("lang.payment_method") }}</h4>
                            </div>
                            <div class="checkout-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="wallet-method">
                                            <label class="radio-inline custom_radio me-4">
                                                <input type="radio" name="payment_service" value="manual" checked="">
                                                <span class="checkmark"></span> {{ __("lang.manual") }}
                                            </label>
                                            <label class="radio-inline custom_radio">
                                                <input type="radio" name="payment_service" value="paytabs">
                                                <span class="checkmark"></span>{{ __("lang.credit_and_debit") }}
                                            </label>
                                        </div>
                                    </div>

                                    <!-- manual -->
                                    <form action="cart" form-type="manual">
                                        <div class="row">
                                            <div class="input-block" data-select2-id="8">
                                                <label for="phoneNumber" class="add-course-label">{{ __("lang.choose_phone_number") }}</label>
                                                <select id="phoneNumber" class="form-control select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" dir="ltr">
                                                    <option value="+201275075161" dir="ltr">+20 127-507-5161</option>
                                                    <option value="+201275075162" dir="ltr">+20 127-507-5162</option>
                                                    <option value="+201113060460" dir="ltr">+20 111-306-0460</option>
                                                    <option value="+201113222537" dir="ltr">+20 111-322-2537</option>
                                                    <option value="+201158517707" dir="ltr">+20 115-851-7707</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="condinue-shop">
                                                    <a id="callButton" href="tel:+201275075161" class="btn btn-primary" type="submit">
                                                        <i class="fa fa-phone"></i>
                                                        {{ __("lang.manual") }}
                                                        <span id="number" dir="ltr"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- payTabs -->
                                    <form action="cart" form-type="paytabs" style="display: none">
                                        <div class="row">
                                            @include("website_layouts.components.errors.coming_soon")
{{--                                            <div class="col-lg-12">--}}
{{--                                                <div class="input-block">--}}
{{--                                                    <label class="form-control-label">{{ __("lang.card_number") }}</label>--}}
{{--                                                    <input type="text" class="form-control"--}}
{{--                                                           placeholder="XXXX XXXX XXXX XXXX">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="input-block">--}}
{{--                                                    <label class="form-label">{{ __("lang.month") }}</label>--}}
{{--                                                    <select class="form-select select" name="sellist1">--}}
{{--                                                        <option>Month</option>--}}
{{--                                                        <option>Jun</option>--}}
{{--                                                        <option>Feb</option>--}}
{{--                                                        <option>March</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="input-block">--}}
{{--                                                    <label class="form-label">{{ __("lang.year") }}</label>--}}
{{--                                                    <select class="form-select select" name="sellist1">--}}
{{--                                                        <option>Year</option>--}}
{{--                                                        <option>2023</option>--}}
{{--                                                        <option>2022</option>--}}
{{--                                                        <option>2021</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <div class="input-block">--}}
{{--                                                    <label class="form-control-label">CVV</label>--}}
{{--                                                    <input type="text" class="form-control" placeholder="XXXX">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-12">--}}
{{--                                                <div class="input-block">--}}
{{--                                                    <label class="form-control-label">{{ __("lang.name_on_card") }}</label>--}}
{{--                                                    <input type="text" class="form-control" placeholder="Address">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-12 col-md-12">--}}
{{--                                                <div class="condinue-shop">--}}
{{--                                                    <button class="btn btn-primary" type="submit">{{ __("lang.pay") }}</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Payment Method -->

                </div>
            </div>
        </div>
    </section>
    <!-- /Cart -->
@endsection


@section("script")
    <script>
        $(function () {
            $("[name=payment_service]").on("click", function () {
                $("[form-type]").hide();
                $("[form-type='" + $(this).val() +"']").show();
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            // Update the call button's href attribute when the user selects a different phone number
            $('#phoneNumber').on('change', function() {
                var selectedNumber = $(this).val();
                $('#callButton').attr('href', 'tel:' + selectedNumber);
                $('#number').text(" (" + selectedNumber + ") ");
            }).trigger("change");
        });
    </script>
@endsection
