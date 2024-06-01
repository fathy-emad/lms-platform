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
                            <a class="breadcrumb-item" href="{{url("admin/teacher/bank-question/")}}" data-bread="teacher">({{ __("attributes.teacher") }}) {{ request("teacher") }}</a>
                            <a class="breadcrumb-item" href="" data-bread="curriculum">({{ __("attributes.curriculum") }})</a>
                            <a class="breadcrumb-item" href="" data-bread="chapter">({{ __("attributes.chapter") }})</a>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.lesson") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.lesson") }}</th>
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
        let datatableUri = `{{ url("api")."/admin/setting-education/lesson?where=chapter_id:" . request('chapter_id') .",ActiveEnum:".\App\Enums\ActiveEnum::Active->value}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            { "data": "id" },
            { "data": "lesson.translate" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    let actions = `<div class="row justify-content-start">`;
                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button" href="{{url("/admin/teacher/bank-question/".request("teacher")."/" . request("teacher_id") ."/".request("curriculum_id")."/".request("chapter_id"))}}/${data.id}">
                                        <i class="fa fa-home"></i> Questions
                                    </a>
                                </div>`;
                    actions += `</div>`;
                    if(meta.row === 0){
                        $("[data-bread=curriculum]").text("({{ __("attributes.curriculum") }}) " + data.chapter.curriculum.curriculum.translate).attr("href", APP_URL + "/" + "admin/teacher/bank-question/{{request("teacher")}}/{{request("teacher_id")}}");
                        $("[data-bread=chapter]").text("({{ __("attributes.chapter") }}) " + data.chapter.chapter.translate).attr("href", APP_URL + "/" + "admin/teacher/bank-question/{{request("teacher")}}/{{request("teacher_id")."/".request("curriculum_id")}}");
                    }
                    return actions;
                }
            }
        ];

    </script>
@endsection
