@extends('teacher_dashboard_layouts.simple.master')

@section("phpScript") @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
    <h3>{{ __("lang.my_courses") }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item active">{{ __("lang.my_courses") }}</li>
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
                                    <th>#ID</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.cost") }}</th>
                                    <th>{{ __("attributes.percentage") }}</th>
                                    <th>{{ __("attributes.ActiveEnum") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.cost") }}</th>
                                    <th>{{ __("attributes.percentage") }}</th>
                                    <th>{{ __("attributes.ActiveEnum") }}</th>
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
            { "data": "id" },
            { "data": "curriculum.subject.year.stage.translate" },
            { "data": "curriculum.subject.year.year.translate" },
            { "data": "curriculum.curriculum.translate" },
            { "data": "cost",
                render: function (data){
                    let $return = "";
                    for (const i in data)  $return += i + ": " + data[i] + ', ';
                    return $return
                }
            },
            { "data": "percentage" },
            { "data": "ActiveEnum.translate" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" }
        ];
    </script>
@endsection
