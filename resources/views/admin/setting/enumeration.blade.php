@extends('dashboard_layouts.simple.master')

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <style>
        .select2-dropdown { z-index: 10000 !important; }
        /* CSS to set mouse pointer to none for disabled elements */
        [disabled] {
            pointer-events: none;
        }

    </style>
@endsection

@section('breadcrumb-title')
    <h3>{{ session("page_data")["title"]["translate"] }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item">{{ session("page_data")["route_title"] }}</li>
    <li class="breadcrumb-item active">{{ session("page_data")["title"]["translate"] }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        @if(("api/" . request()->path()) !== session("page_data")["link"])
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message.</p>
                <hr>
                <p class="mb-0">You are not auth to get here.</p>
            </div>
        @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        @if(session("page_data")["actions"]["create"])
                            <div class="card-header">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                        data-bs-original-title="{{ __('lang.create') }} {{ session("page_data")["title"]["translate"] }}"
                                        title="{{ __('lang.create') }} {{ session("page_data")["title"]["translate"] }}" fdprocessedid="pqwxqf">
                                    {{ __('lang.create') }} {{ session("page_data")["title"]["translate"] }}
                                </button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display datatables" id="data-table-ajax">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{ __("attributes.priority") }}</th>
                                        <th>{{ __("attributes.key") }}</th>
                                        <th>{{ __("attributes.value") }}</th>
                                        <th>{{ __("attributes.created_at") }}</th>
                                        <th>{{ __("attributes.created_by") }}</th>
                                        <th>{{ __("attributes.updated_at") }}</th>
                                        <th>{{ __("attributes.updated_by") }}</th>
                                        <th>{{ __("attributes.actions") }}</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#ID</th>
                                        <th>{{ __("attributes.priority") }}</th>
                                        <th>{{ __("attributes.key") }}</th>
                                        <th>{{ __("attributes.value") }}</th>
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


            <!-- Create modal -->
            <div class="modal fade create_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.create') }} {{ session("page_data")["title"]["translate"] }}</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            <form novalidate="" class="theme-form needs-validation" id="form1" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                                  action="{{ url(session("page_data")["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-12 mb-3" data-type="key">
                                            <label for="key">{{ __("attributes.key") }}</label>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="value">{{ __("attributes.value") }}</label>
                                            <input class="form-control" name="value" id="value" type="text" placeholder="" />
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" onclick="submitForm(this, $('#data-table-ajax'))" type="button">{{ __("lang.create") }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update modal -->
            <div class="modal fade update_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.update') }} {{ session("page_data")["title"]["translate"] }}</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            <form novalidate="" class="theme-form needs-validation" id="form2" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                                  action="{{ url(session("page_data")["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-12">
                                            <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" id="update-data-tab" data-bs-toggle="pill" href="#update-data" role="tab" aria-controls="update-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                                <li class="nav-item"><a class="nav-link" id="update-value-translate-tab" data-bs-toggle="pill" href="#update-value-translate" role="tab" aria-controls="update-value-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>value translates</a></li>
                                            </ul>
                                            <div class="tab-content" id="pills-infotabContent">

                                                <div class="tab-pane fade  active show" id="update-data" role="tabpanel" aria-labelledby="update-data-tab">

                                                    <div class="col-12 mb-3" data-type="key">
                                                        <label for="key">{{ __("attributes.key") }}</label>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="update-value-translate" role="tabpanel" aria-labelledby="update-country-translate-tab">
                                                    <div class="row update-value-translates"></div>
                                                </div>

                                            </div>
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
            <!-- View modal -->
            <div class="modal fade view_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.view') }} {{ session("page_data")["title"]["translate"] }}</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form novalidate="" class="theme-form needs-validation">
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-12">
                                                <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                                    <li class="nav-item"><a class="nav-link active" id="update-data-tab" data-bs-toggle="pill" href="#update-data" role="tab" aria-controls="update-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                                    <li class="nav-item"><a class="nav-link" id="view-value-translate-tab" data-bs-toggle="pill" href="#view-value-translate" role="tab" aria-controls="view-value-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>value translates</a></li>
                                                </ul>
                                                <div class="tab-content" id="pills-infotabContent">

                                                    <div class="tab-pane fade  active show" id="update-data" role="tabpanel" aria-labelledby="update-data-tab">

                                                        <div class="col-12 mb-3" data-type="key">
                                                            <label for="key">{{ __("attributes.key") }}</label>
                                                        </div>


                                                    </div>

                                                    <div class="tab-pane fade" id="view-value-translate" role="tabpanel" aria-labelledby="update-country-translate-tab">
                                                        <div class="row view-value-translates"></div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @endif
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/height-equal.js')}}"></script>
    <script>

        let valueTranslates = "";
        let selectKey = "";
        let pageData = @json(session('page_data'));
        let datatableUri = "{{ url("api")."/admin/setting/enumeration"}}";
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            { "data": "id" },
            { "data": "priority" },
            { "data": "key.translate" },
            { "data": "value.translate" },
            { "data": "created_at.dateTime" },
            { "data": "created_by.name" },
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
                    const dataString = JSON.stringify(data).replace(/"/g, '&quot;');
                    let actions = `<div class="row justify-content-start">`;
                    if(pageData.actions.update === 1){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-warning" type="button" onclick="openModalUpdate(${dataString})"
                                            data-bs-original-title="{{ __('lang.update') }} {{ session("page_data")["title"]["translate"] }}"
                                            title="{{ __('lang.update') }} {{ session("page_data")["title"]["translate"] }}" fdprocessedid="pqwxqf">
                                        <i class="fa fa-edit"></i></button>
                                    </button>
                                </div>`;
                    }
                    if(pageData.actions.read === 1 ){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="openModalView(${dataString})"
                                            data-bs-original-title="{{ __('lang.view') }} {{ session("page_data")["title"]["translate"] }}"
                                            title="{{ __('lang.view') }} {{ session("page_data")["title"]["translate"] }}" fdprocessedid="pqwxqf">
                                        <i class="fa fa-eye"></i></button>
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
            form.find("[name]").removeClass("is-invalid");
            modal.find("[name=id]").val(data.id);
            modal.find("[name=key]").val(data.key.key);
            modal.find(".update-value-translates").find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.value.translates[locale] || '');
            });
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            let form = modal.find("form");
            form[0].reset();
            modal.find("[name=key]").val(data.key.key).prop("disabled", true);
            modal.find(".view-value-translates").find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.value.translates[locale] || '').prop("disabled", true);
            });
            modal.modal("show");
        }

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            form.find("[name]").removeClass("is-invalid");
        });

        $(document).ready(function() {

            //Get languages
            $.ajax({
                url: APP_URL + "/api/admin/setting/language",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'Authorization': 'Bearer ' + "{{ session("admin_data")["jwtToken"] }}",
                    'locale': "{{ session("locale") }}",
                },
                success: function(response) {
                    let data = response.data;
                    for (const i in data) {
                        valueTranslates += `<div class="col-12 mb-3">
                                                    <label for="${data[i].locale}">${data[i].language.translate}</label>
                                                    <input data-locale="${data[i].locale}" class="form-control" id="${data[i].locale}" type="text" name="value[${data[i].locale}]" value="">
                                                </div>`;
                    }

                    $(".update_modal").find(".update-value-translates").append(valueTranslates);
                    $(".view_modal").find(".view-value-translates").append(valueTranslates);

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get system Constants
            $.ajax({
                url: APP_URL + "/api/web-services/enums/system-constants",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    //'Authorization': 'Bearer ' + "{{ session("admin_data")["jwtToken"] }}",
                    'locale': "{{ session("locale") }}",
                },
                success: function(response) {
                    let data = response.data;
                    selectKey += `<select name="key" class="col-12 mb-3">`;
                    for (const i in data) { selectKey += `<option value="${data[i].key}">${data[i].translate}</option>`; }
                    selectKey += `</select>`;
                    $(".create_modal").find("[data-type=key]").append(selectKey);
                    $(".update_modal").find("[data-type=key]").append(selectKey);
                    $(".view_modal").find("[data-type=key]").append(selectKey);
                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

        });

    </script>
@endsection
