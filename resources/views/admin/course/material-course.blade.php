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
                    <div class="card-header">
                        <nav class="breadcrumb breadcrumb-icon">
                            <a class="breadcrumb-item" href="{{url("admin/course/material/")}}" data-bread="teacher">({{ __("attributes.teacher") }}) {{ request("teacher") }}</a>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.course") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.course") }}</th>
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
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        let pageData = @json($pageData);
        let datatableUri = `{{ url("api")."/admin/course/register?where=teacher_id:".request("teacher_id").",ActiveEnum:".\App\Enums\ActiveEnum::Active->value}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            { "data": "id" },
            { "data": "curriculum.subject.year.year.translate" },
            { "data": "curriculum.curriculum.translate" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data) {
                    console.log(data);
                    let actions = `<div class="row justify-content-start">`;
                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button"
                                     href="{{url("/admin/course/material/".request("teacher")."/" . request("teacher_id"))}}/${data.id}/${data.curriculum.id}">
                                        <i class="fa fa-home"></i> Chapters
                                    </a>
                                </div>`;
                    actions += `</div>`;
                    return actions;
                }
            }
        ];

    </script>
@endsection
