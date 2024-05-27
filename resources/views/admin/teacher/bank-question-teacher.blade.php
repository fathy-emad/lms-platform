@extends('dashboard_layouts.simple.master')

@section("phpScript") @php $pageData = checkPermission(request()->path(), session("admin_data")["permission"]["permissions"]) @endphp @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
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
                                    <th>{{ __("attributes.image") }}</th>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.name") }}</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.subject") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.created_by") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.updated_by") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ __("attributes.image") }}</th>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.name") }}</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.subject") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.created_by") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.updated_by") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
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
        let datatableUri = APP_URL+"/api/admin/teacher/register?where=TeacherStatusEnum:" + "{{\App\Enums\TeacherStatusEnum::Active->value}}";
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            {
                "data": "image.file",
                "render": function(data) {
                    return data ? `<img src="${APP_URL}/uploads/${data}" style="height: 25px; width: auto;">` : '-';
                }
            },
            { "data": "id" },
            { "data": null,
                render: function (data){
                    return data.prefix + "/ " + data.name;
                }
            },
            { "data": "stage.stage.translate" },
            { "data": "subject.subject.translate" },
            { "data": "created_at.dateTime"},
            { "data": "created_by.name"},
            { "data": "updated_at.dateTime" },
            { "data": "updated_by.name",
                render:function (data) {
                    if (data) return data;
                    return "-";
                }
            },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data) {
                    let actions = `<div class="row justify-content-start">`;
                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button" href="{{url("/admin/teacher/bank-question")}}/${data.id}">
                                        <i class="fa fa-home"></i> Courses
                                    </a>
                                </div>`;
                    actions += `</div>`;
                    return actions;
                }
            }
        ];
    </script>
@endsection
