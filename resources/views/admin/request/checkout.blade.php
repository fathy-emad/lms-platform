@extends('dashboard_layouts.simple.master')

@section("phpScript") @php $pageData = checkPermission(request()->path(), session("admin_data")["permission"]["permissions"]) @endphp @endsection

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
    <h3>{{ $pageData["page"] }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item">{{ $pageData["route"] }}</li>
    <li class="breadcrumb-item active">{{ $pageData["page"] }}</li>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __("attributes.name") }}</th>
                                    <th>{{ __("attributes.email") }}</th>
                                    <th>{{ __("attributes.phone") }}</th>
                                    <th>{{ __("attributes.course") }}</th>
                                    <th>{{ __("attributes.teacher") }}</th>
                                    <th>{{ __("attributes.cost") }}</th>
                                    <th>{{ __("attributes.total") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __("attributes.name") }}</th>
                                    <th>{{ __("attributes.email") }}</th>
                                    <th>{{ __("attributes.phone") }}</th>
                                    <th>{{ __("attributes.course") }}</th>
                                    <th>{{ __("attributes.teacher") }}</th>
                                    <th>{{ __("attributes.cost") }}</th>
                                    <th>{{ __("attributes.total") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        <div class="modal fade update_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.update') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation" id="form2" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                              action="{{ url($pageData["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <input type="hidden" name="PaymentServiceEnum" value="CheckoutManual">
                            <input type="hidden" name="PaymentMethodEnum" value="Manual">
                            <input type="hidden" name="student_id" value="">
                            <div class="form-group">
                                <div class="row">
                                    <h3>1 - Are you sure you want to enroll courses cart?</h3>
                                    <h3>2 - For <span class="text-danger" id="for_student"></span></h3>
                                    <h3>3 - With total <span class="text-danger" id="with_total"></span></h3>
                                    <div class="col-12 mb-3">
                                        <label for="transactionTo">{{ __("attributes.transactionTo") }}</label>
                                        <input type="text" name="transactionTo" class="form-control" id="transactionTo">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" onclick="submitForm(this, $('#data-table-ajax'), successCallback)" type="button">{{ __("lang.update") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade delete_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.delete') }} {{ $pageData["page"]  }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation" id="form3" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                              action="{{ url($pageData["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="form-group">
                                <div class="row">
                                    <div class="alert alert-danger" role="alert">
                                        <h4 class="alert-heading">Well done!</h4>
                                        <p>Aww yeah, you successfully read this important alert message.</p>
                                        <hr>
                                        <p data-type="message" class="mb-0">Are you sure you want to delete this record</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-danger btn-block" onclick="submitForm(this, $('#data-table-ajax'))" type="button">{{ __("lang.delete") }}</button>
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
        let pageData = @json($pageData);
        let datatableUri = `{{ url("api")."/admin/request/checkout?orderBy=student_id:desc"}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;
        let datatableColumns = [
            { "data": "id", "orderable": false, "searchable": false },
            { "data": "student.name", "orderable": false, "searchable": true },
            { "data": "student.email", "orderable": false, "searchable": true },
            { "data": "student.phone", "orderable": false, "searchable": true },
            { "data": "course.title.translate", "orderable": false, "searchable": true},
            { "data": "course.teacher.name", "orderable": false, "searchable": true},
            { "data": "course", "render": (data) => data.cost["course"] + " LE" , "orderable": false, "searchable": false},
            { "data": "total", "render": (data) => data + " LE" , "orderable": false, "searchable": false},
            { "data": "created_at.dateTime", "orderable": false, "searchable": false },
            { "data": "updated_at.dateTime", "orderable": false, "searchable": false },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data) {
                    const dataString = JSON.stringify(data).replace(/"/g, '&quot;');
                    let actions = `<div class="row justify-content-start">`;
                    if(pageData.actions.create === 1){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-warning" type="button" onclick="openModalUpdate(${dataString})"
                                            data-bs-original-title="{{ __('lang.update') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.update') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-edit"></i></button>
                                    </button>
                                </div>`;
                    }
                    if(pageData.actions.delete === 1){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="openModalDelete(${dataString})"
                                            data-bs-original-title="{{ __('lang.delete') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.delete') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-trash"></i></button>
                                    </button>
                                </div>`;
                    }
                    actions += `</div>`;
                    return actions;
                }
            }
        ];

        let successCallback = function (){
            location.reload();
        }


        function openModalUpdate(data) {
            let modal = $(".update_modal");
            let form = modal.find("form");
            form[0].reset();
            modal.find("[name=student_id]").val(data.student.id);
            modal.find("#for_student").text(data.student.name);
            modal.find("#with_total").text(data.total + "LE");
            modal.modal("show");
        }

        function openModalDelete(data) {
            let modal = $(".delete_modal");
            $(modal).find("[name=id]").val(data.id);
            $(modal).find("[data-type=message]").html(`Are you sure you want to delete <strong>(${data.student.name}) - (${data.course.title.translate})</strong> Cart?`);
            modal.modal("show");
        }


    </script>
@endsection
