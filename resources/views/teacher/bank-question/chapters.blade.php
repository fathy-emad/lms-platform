@extends('teacher_dashboard_layouts.simple.master')

@section("phpScript") @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
    <h3>{{ __("lang.bank_questions") }} - {{ __("lang.chapters") }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item">{{ __("lang.bank_questions") }}</li>
    <li class="breadcrumb-item active">{{ __("lang.chapters") }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <nav class="breadcrumb breadcrumb-icon"><a class="breadcrumb-item" href="" data-bread="curriculum">({{ __("attributes.curriculum") }})</a>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.chapter") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.chapter") }}</th>
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
        let datatableUri = `{{ url("api")."/teacher/chapter?where=curriculum_id:" . request('curriculum_id') .",ActiveEnum:".\App\Enums\ActiveEnum::Active->value}}`;
        let datatableAuthToken = "{{session("teacher_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;

        let datatableColumns = [
            { "data": "id" },
            { "data": "chapter.translate" },
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function (data, type, row, meta) {
                    let actions = `<div class="row justify-content-start">`;
                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button" href="{{url("/teacher/bank-question/".request("curriculum_id"))}}/${data.id}">
                                        <i class="fa fa-home"></i> Lessons
                                    </a>
                                </div>`;
                    actions += `</div>`;
                    if (meta.row === 0){
                        $("[data-bread=curriculum]").text("({{ __("attributes.curriculum") }}) " + data.curriculum.curriculum.translate).attr("href", APP_URL + "/teacher/bank-question");

                    }
                    return actions;
                }
            }
        ];

    </script>
@endsection
