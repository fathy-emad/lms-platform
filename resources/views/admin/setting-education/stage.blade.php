@extends('dashboard_layouts.simple.master')

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <style>
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
                                        <th>{{ __("attributes.country") }}</th>
                                        <th>{{ __("attributes.stage") }}</th>
                                        <th>{{ __("attributes.ActiveEnum") }}</th>
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
                                        <th>{{ __("attributes.country") }}</th>
                                        <th>{{ __("attributes.stage") }}</th>
                                        <th>{{ __("attributes.ActiveEnum") }}</th>
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

                                        <div class="col-12 mb-3">
                                            <label for="country_id">{{ __("attributes.country") }}</label>
                                            <select name="country_id" class="col-12" id="country_id"></select>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="StageEnumTable">{{ __("attributes.stage") }}</label>
                                            <select name="StageEnumTable" class="col-12" id="StageEnumTable"></select>
                                        </div>

                                        <div class="col-sm-12 mb-3 media">
                                            <label class="col-form-label m-r-10">{{ __("attributes.ActiveEnum") }}</label>
                                            <div class="media-body icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="ActiveEnum" value="{{\App\Enums\ActiveEnum::Active->value}}"><span class="switch-state"></span>
                                                </label>
                                            </div>
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

                                        <div class="col-12 mb-3">
                                            <label for="country_id">{{ __("attributes.country") }}</label>
                                            <select name="country_id" class="col-12" id="country_id"></select>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="StageEnumTable">{{ __("attributes.stage") }}</label>
                                            <select name="StageEnumTable" class="col-12" id="StageEnumTable"></select>
                                        </div>

                                        <div class="col-sm-12 mb-3 media">
                                            <label class="col-form-label m-r-10">{{ __("attributes.ActiveEnum") }}</label>
                                            <div class="media-body icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="ActiveEnum" value="{{\App\Enums\ActiveEnum::Active->value}}"><span class="switch-state"></span>
                                                </label>
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
                                    <div class="row">

                                        <div class="col-12 mb-3">
                                            <label for="country_id">{{ __("attributes.country") }}</label>
                                            <select name="country_id" class="col-12" id="country_id"></select>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="StageEnumTable">{{ __("attributes.stage") }}</label>
                                            <select name="StageEnumTable" class="col-12" id="StageEnumTable"></select>
                                        </div>

                                        <div class="col-sm-12 mb-3 media">
                                            <label class="col-form-label m-r-10">{{ __("attributes.ActiveEnum") }}</label>
                                            <div class="media-body icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" name="ActiveEnum" value="{{\App\Enums\ActiveEnum::Active->value}}"><span class="switch-state"></span>
                                                </label>
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
    <script>
        let htmlCountries = "";
        let htmlStagesEnum = "";
        let pageData = @json(session('page_data'));
        let datatableUri = "{{ url("api")."/admin/setting-education/stage"}}";
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            { "data": "id" },
            { "data": "country.country.translate" },
            { "data": "stage.value.translate" },
            { "data": "ActiveEnum.translate"},
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
                    const dataString = JSON.stringify(data).replace(/"/g, '&quot;');
                    let actions = `<div class="row justify-content-start">`;

                    if(pageData.actions.update === 1){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-warning" type="button" onclick="openModalUpdate(${dataString})"
                                            data-bs-original-title="{{ __('lang.update') }} {{ session("page_data")["title"]["translate"] }}"
                                            title="{{ __('lang.update') }} {{ session("page_data")["title"]["translate"] }}">
                                        <i class="fa fa-edit"></i></button>
                                    </button>
                                </div>`;
                    }

                    if(pageData.actions.read === 1 ){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="openModalView(${dataString})"
                                            data-bs-original-title="{{ __('lang.view') }} {{ session("page_data")["title"]["translate"] }}"
                                            title="{{ __('lang.view') }} {{ session("page_data")["title"]["translate"] }}">
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
            $(modal).find("[name=id]").val(data.id);
            $(modal).find('#country_id').val(data.country.id);
            $(modal).find('#StageEnumTable').val(data.stage.id);
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find('#country_id').val(data.country.id).prop("disabled", true);
            $(modal).find('#StageEnumTable').val(data.stage.id).prop("disabled", true);
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active").prop("disabled", true);
            modal.modal("show");
        }

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find('#country_id').val($(this).find('#country_id option:first').val()).trigger('change');
            $(this).find('#StageEnumTable').val($(this).find('#StageEnumTable option:first').val()).trigger('change');
        });

        $(document).ready(function() {

            //Get countries
            $.ajax({
                url: APP_URL + "/api/admin/setting/country?where=ActiveEnum:active",
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
                    for (const i in data) htmlCountries += `<option value="${data[i].id}">${data[i].country.translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#country_id").each(function() {
                        $(this).append(htmlCountries);
                    });
                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get stages
            $.ajax({
                url: APP_URL + "/api/admin/setting/enumeration?where=key:{{\App\Enums\SystemConstantsEnum::StageEnumTable->value}}",
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
                    for (const i in data) htmlStagesEnum += `<option value="${data[i].id}" ">${data[i].value.translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#StageEnumTable").each(function() {
                        $(this).append(htmlStagesEnum);
                    });

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
