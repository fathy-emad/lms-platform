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
                                    <th>{{ __("attributes.teacher") }}</th>
                                    <th>{{ __("attributes.TeacherCourseRequestStatusEnum") }}</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.subject") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __("attributes.teacher") }}</th>
                                    <th>{{ __("attributes.TeacherCourseRequestStatusEnum") }}</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.subject") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
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
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="teacher_id" value="">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        @php
                                             $enum = new \App\Http\Controllers\WebServices\Enums\EnumsController();
                                             $statuses = $enum->teacherCourseStatus()->getData(true)["data"];
                                         @endphp
                                        <div class="col-form-label">{{ __("attributes.TeacherCourseRequestStatusEnum") }}</div>
                                        <select class="form-control" name="TeacherCourseRequestStatusEnum" id="TeacherCourseRequestStatusEnum">
                                            @foreach($statuses as $status)
                                                <option value="{{$status["key"]}}">{{ $status["translate"] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" onclick="submitForm(this, $('#data-table-ajax'))" type="button">{{ __("lang.update") }}</button>
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
        let datatableUri = `{{ url("api")."/admin/request/course"}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;
        let datatableColumns = [
            { "data": "id" },
            { "data": "teacher.name" },
            { "data": "TeacherCourseRequestStatusEnum",
                "render": function (data) {
                    if (data.key === "pending")
                        return `<span class="badge rounded-pill badge-primary">${data.translate}</span>`;

                    if (data.key === "rejected")
                        return `<span class="badge rounded-pill badge-danger">${data.translate}</span>`;

                    if (data.key === "approved")
                        return `<span class="badge rounded-pill badge-success">${data.translate}</span>`;
                }
            },
            { "data": "curriculum.subject.year.stage.stage.translate" },
            { "data": "curriculum.subject.year.year.translate" },
            { "data": "curriculum.subject.subject.translate" },
            { "data": "curriculum", render: function (data) {
                    let curriculum = data.curriculum.translate
                    let types = data.EduTypesEnums.map(function(item) {
                        return item.translate;
                    }).join(', ');
                    let terms = data.EduTermsEnums.map(function(item) {
                        return item.translate;
                    }).join(', ');

                    return curriculum + "(" + terms +") (" + types + ")";
                }
            },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data) {
                    const dataString = JSON.stringify(data).replace(/"/g, '&quot;');
                    let actions = `<div class="row justify-content-start">`;
                    if(pageData.actions.update === 1 && data.TeacherCourseRequestStatusEnum.key === "{{ \App\Enums\TeacherCourseRequestStatusEnum::Pending->value }}"){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-warning" type="button" onclick="openModalUpdate(${dataString})"
                                            data-bs-original-title="{{ __('lang.update') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.update') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-edit"></i></button>
                                    </button>
                                </div>`;
                    }
                    actions += `</div>`;
                    return actions;
                }
            }
        ];

        function openModalUpdate(data) {
            let modal = $(".update_modal");
            let form = modal.find("form");
            form[0].reset();
            modal.find("[name=id]").val(data.id);
            modal.find("[name=teacher_id]").val(data.teacher.id);
            modal.modal("show");
        }
    </script>
@endsection
