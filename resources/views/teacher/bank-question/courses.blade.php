@extends('teacher_dashboard_layouts.simple.master')

@section("phpScript")  @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
    <h3>{{ __("lang.bank_questions") }} - {{ __("lang.courses") }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item">{{ __("lang.bank_questions") }}</li>
    <li class="breadcrumb-item active">{{ __("lang.courses") }}</li>
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
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.subject") }}</th>
                                    <th>{{ __("attributes.course") }}</th>
                                    <th>{{ __("attributes.ActiveEnum") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.subject") }}</th>
                                    <th>{{ __("attributes.course") }}</th>
                                    <th>{{ __("attributes.ActiveEnum") }}</th>
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
        let datatableUri = `{{ url("api")."/teacher/course?where=teacher_id:".session("teacher_data")["id"]}}`;
        let datatableAuthToken = "{{session("teacher_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;

        let datatableColumns = [
            { "data": "stage.translate" },
            { "data": "year.translate" },
            { "data": "subject.translate" },
            { "data": "curriculum.curriculum.translate" },
            { "data": "ActiveEnum.translate" },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    let actions = `<div class="row justify-content-start">`;
                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button" href="{{url("/teacher/bank-question")}}/${data.curriculum.id}">
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
