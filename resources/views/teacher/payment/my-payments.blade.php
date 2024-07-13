@extends('teacher_dashboard_layouts.simple.master')

@section("phpScript")  @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}" xmlns="http://www.w3.org/1999/html">
    <style>
        [disabled] {
            pointer-events: none;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>My Payments</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item active">My Payments</li>
@endsection
@section('content')

    <div class="container-fluid">

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
                                <span class="m-0">Pending</span>
                                <h5 class="mb-0 counter" data-cost="pending">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="pending">0 (items)</h6>
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
                                <span class="m-0">In Review</span>
                                <h5 class="mb-0 counter" data-cost="in_review">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="in_review">0 (items)</h6>
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
                                <span class="m-0">On Way</span>
                                <h5 class="mb-0 counter" data-cost="on_way">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="on_way">0 (items)</h6>
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
                                <span class="m-0">Paid</span>
                                <h5 class="mb-0 counter" data-cost="paid">0 LE</h5>
                                <h6 class="mb-0 counter" data-count="paid">0 (items)</h6>
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


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                data-bs-original-title="{{ __('lang.send') }} Payment Request"
                                title="{{ __('lang.send') }} Payment Request">
                            {{ __('lang.send') }} Payment Request
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>{{ __("attributes.status") }}</th>
                                    <th>{{ __("attributes.totalAmount") }}</th>
                                    <th>{{ __("attributes.countItems") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ __("attributes.status") }}</th>
                                    <th>{{ __("attributes.totalAmount") }}</th>
                                    <th>{{ __("attributes.countItems") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create modal -->
        <div class="modal fade create_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.send') }} Payment Request</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="needs-validation" id="form1" method="POST" authorization="{{session("teacher_data")["jwtToken"]}}"
                              action="{{ url('api/teacher/payment-request') }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <div class="form-group">
                                <div class="row">
                                    <input type="hidden" name="teacher_id" value="{{ session("teacher_data")["id"] }}">
                                    <h1> are you sure you want to request your Payment</h1>

                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" onclick="submitForm(this, $('#data-table-ajax'), successCallback)" type="button">{{ __("lang.send") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')

    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        let datatableUri = `{{ url("api")."/teacher/payment-request?where=teacher_id:".session("teacher_data")["id"]."&orderBy=id:desc"}}`;
        let datatableAuthToken = "{{session("teacher_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;
        let datatableColumns = [
            { "data": "TeacherPaymentStatusEnum",
                "render": function (data) {
                    if (data.key === "pending")
                        return `<span class="badge rounded-pill badge-danger">${data.translate}</span>`;

                    if (data.key === "in-review")
                        return `<span class="badge rounded-pill badge-warning">${data.translate}</span>`;

                    if (data.key === "on-way")
                        return `<span class="badge rounded-pill badge-primary">${data.translate}</span>`;

                    if (data.key === "paid")
                        return `<span class="badge rounded-pill badge-success">${data.translate}</span>`;
                }
            },
            { "data": "totalAmount", "render": (data) => data + " LE" },
            { "data": "countItems",  "render": (data) => data + " (items)" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" }
        ];

        let successCallback = function (){
            location.reload();
        }

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();

        });

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
