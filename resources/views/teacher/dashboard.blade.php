@extends('teacher_dashboard_layouts.simple.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ __("lang.dashboard") }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">{{ __("lang.dashboard") }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <h3>{{ __("lang.withdraw") }}</h3>
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-danger b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div class="media-body">
                                <span class="m-0">{{ __("lang.pending") }}</span>
                                <h5 class="mb-0 counter" data-cost="pending">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="pending">0 ({{ __("lang.items") }})</h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock icon-bg">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-warning b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                            <div class="media-body">
                                <span class="m-0">{{ __("lang.in_review") }}</span>
                                <h5 class="mb-0 counter" data-cost="in_review">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="in_review">0 ({{ __("lang.items") }})</h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-bg">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </div>
                            <div class="media-body">
                                <span class="m-0">{{ __("lang.on_way") }}</span>
                                <h5 class="mb-0 counter" data-cost="on_way">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="on_way">0 ({{ __("lang.items") }})</h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck icon-bg">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-success b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 1 1 0 7H6"></path>
                                </svg>
                            </div>
                            <div class="media-body">
                                <span class="m-0">{{ __("lang.paid") }}</span>
                                <h5 class="mb-0 counter" data-cost="paid">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="paid">0 ({{ __("lang.items") }})</h6>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign icon-bg">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 1 1 0 7H6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="statistics">


        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
        $(document).ready(function() {
            //Get payments for auth teacher
            $.ajax({
                url: APP_URL + "/api/teacher/payments?where=teacher_id:{{ session("teacher_data")["id"] }}",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'Authorization': 'Bearer ' + "{{ session("teacher_data")["jwtToken"] }}",
                    'locale': "{{ session("locale") }}",
                },
                success: function(response) {
                    let data = response.data;
                    $("[data-cost='pending']").text(data.pending.cost + " LE");
                    $("[data-count='pending']").text(data.pending.count + " (items)");
                    $("[data-cost='in_review']").text(data.in_review.cost + " LE");
                    $("[data-count='in_review']").text(data.in_review.count + " (items)");
                    $("[data-cost='on_way']").text(data.on_way.cost + " LE");
                    $("[data-count='on_way']").text(data.on_way.count + " (items)");
                    $("[data-cost='paid']").text(data.paid.cost + " LE");
                    $("[data-count='paid']").text(data.paid.count + " (items)");

                    for (const i in data.statistics) {
                        let state = data.statistics[i];
                        let types = state.types.map((item) => item.translate).join(', ');
                        let terms = state.terms.map((item) => item.translate).join(', ');
                        let src = state.image && state.image.file ? APP_URL+"/uploads/" + state.image.file : APP_URL+"/build/img/logo.svg";
                        $("#statistics").
                        append(`<div class="col-12">
                            <div class="prooduct-details-box">
                                <div class="media">
                                    <img class="align-self-center img-fluid" width="369" height="271" src="${src}" alt="#">
                                        <div class="media-body ms-3">
                                            <div class="product-name">
                                                <h3><a href="#" data-bs-original-title="" title="">${state.course.translate}</a></h3>
                                                <h5>${state.stage.translate} - ${state.year.translate} - ${state.curriculum.translate}</h5>
                                                <h6>${terms} - ${types}</h6>
                                            </div>
                                            <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                            <div class="price d-flex">
                                                <div class="text-muted me-2">{{ __("lang.total") }}</div>: ${state.cost} LE
                                            </div>
                                            <div class="price d-flex">
                                                <div class="text-muted me-2">{{ __("lang.times") }}</div>: ${state.count}
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>`);
                    }
                },
                error: function(xhr, status, error) {

                    let title = JSON.parse(xhr.responseText).message || "Something Went Wrong";
                    let message = JSON.parse(xhr.responseText).errors.where || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });
        });
    </script>
@endsection
