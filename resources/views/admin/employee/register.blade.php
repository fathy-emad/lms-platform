@extends('dashboard_layouts.simple.master')

@section("phpScript") @php $pageData = checkPermission(request()->path(), session("admin_data")["permission"]["permissions"]) @endphp @endsection

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
                    @if($pageData["actions"]["create"])
                        <div class="card-header">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                    data-bs-original-title="{{ __('lang.create') }} {{ $pageData["page"] }}"
                                    title="{{ __('lang.create') }} {{ $pageData["page"] }}">
                                {{ __('lang.create') }} {{ $pageData["page"] }}
                            </button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>{{ __("attributes.image") }}</th>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.name") }}</th>
                                    <th>{{ __("attributes.phone") }}</th>
                                    <th>{{ __("attributes.email") }}</th>
                                    <th>{{ __("attributes.AdminRoleEnum") }}</th>
                                    <th>{{ __("attributes.AdminStatusEnum") }}</th>
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
                                    <th>{{ __("attributes.phone") }}</th>
                                    <th>{{ __("attributes.email") }}</th>
                                    <th>{{ __("attributes.AdminRoleEnum") }}</th>
                                    <th>{{ __("attributes.AdminStatusEnum") }}</th>
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
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.create') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation" id="form1" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                              action="{{ url($pageData["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <label for="name">{{ __("attributes.name") }}</label>
                                        <input class="form-control" name="name" id="name" type="text" placeholder="ex: fathy, ahmed" />
                                    </div>

                                    <div class="col-12 mb-3 input-group-square">
                                        <label for="phone">{{ __("attributes.phone") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><select  name="country_id" class="col-sm-12" id="country_id"></select></span>
                                            </div>
                                            <input class="form-control" name="phone" id="phone" type="number" placeholder="ex: 114xxxxxxxxxx">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="email">{{ __("attributes.email") }}</label>
                                        <input class="form-control" name="email" id="email" type="email" placeholder="ex: example@ex.com" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="national_id">{{ __("attributes.national_id") }}</label>
                                        <input class="form-control" name="national_id" id="national_id" type="number" placeholder="ex: 294***********" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="AdminRoleEnum">{{ __("attributes.AdminRoleEnum") }}</label>
                                        <select name="AdminRoleEnum" class="col-12" id="AdminRoleEnum"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="GenderEnum">{{ __("attributes.GenderEnum") }}</label>
                                        <select name="GenderEnum" class="col-12" id="GenderEnum"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="password">{{ __("attributes.password") }}</label>
                                        <input class="form-control" name="password" id="password" type="text" placeholder="" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="password_confirmation">{{ __("attributes.password_confirmation") }}</label>
                                        <input class="form-control" name="password_confirmation" id="password_confirmation" type="text" placeholder="" />
                                    </div>

                                    <div class="col-sm-12 mb-3 fileUploadBuilder">
                                        <label for="flag">{{ __("attributes.image") }}</label>
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
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.update') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation" id="form2" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                              action="{{ url($pageData["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name">{{ __("attributes.name") }}</label>
                                        <input class="form-control" name="name" id="name" type="text" placeholder="ex: fathy, ahmed" />
                                    </div>

                                    <div class="col-12 mb-3 input-group-square">
                                        <label for="phone">{{ __("attributes.phone") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><select  name="country_id" class="col-sm-12" id="country_id"></select></span>
                                            </div>
                                            <input class="form-control" name="phone" id="phone" type="number" placeholder="ex: 114xxxxxxxxxx">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="email">{{ __("attributes.email") }}</label>
                                        <input class="form-control" name="email" id="email" type="email" placeholder="ex: example@ex.com" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="national_id">{{ __("attributes.national_id") }}</label>
                                        <input class="form-control" name="national_id" id="national_id" type="number" placeholder="ex: 294***********" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="AdminStatusEnum">{{ __("attributes.AdminStatusEnum") }}</label>
                                        <select name="AdminStatusEnum" class="col-12" id="AdminStatusEnum"></select>
                                    </div>

                                    <div class="col-12 mb-3 blocked_reason">
                                        <label for="blocked_reason">{{ __("attributes.blocked_reason") }}</label>
                                        <textarea class="form-control" name="block_reason" id="blocked_reason"></textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="AdminRoleEnum">{{ __("attributes.AdminRoleEnum") }}</label>
                                        <select name="AdminRoleEnum" class="col-12" id="AdminRoleEnum"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="GenderEnum">{{ __("attributes.GenderEnum") }}</label>
                                        <select name="GenderEnum" class="col-12" id="GenderEnum"></select>
                                    </div>

                                    <div class="col-sm-12 mb-3 fileUploadBuilder">
                                        <label for="flag">{{ __("attributes.image") }}</label>
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
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.view') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form novalidate="" class="theme-form needs-validation">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name">{{ __("attributes.name") }}</label>
                                        <input class="form-control" name="name" id="name" type="text" placeholder="ex: fathy, ahmed" />
                                    </div>

                                    <div class="col-12 mb-3 input-group-square">
                                        <label for="phone">{{ __("attributes.phone") }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><select  name="country_id" class="col-sm-12" id="country_id"></select></span>
                                            </div>
                                            <input class="form-control" name="phone" id="phone" type="number" placeholder="ex: 114xxxxxxxxxx">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="email">{{ __("attributes.email") }}</label>
                                        <input class="form-control" name="email" id="email" type="email" placeholder="ex: example@ex.com" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="national_id">{{ __("attributes.national_id") }}</label>
                                        <input class="form-control" name="national_id" id="national_id" type="number" placeholder="ex: 294***********" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="AdminStatusEnum">{{ __("attributes.AdminStatusEnum") }}</label>
                                        <select name="AdminStatusEnum" class="col-12" id="AdminStatusEnum"></select>
                                    </div>

                                    <div class="col-12 mb-3 blocked_reason">
                                        <label for="blocked_reason">{{ __("attributes.blocked_reason") }}</label>
                                        <textarea class="form-control" name="block_reason" id="blocked_reason"></textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="AdminRoleEnum">{{ __("attributes.AdminRoleEnum") }}</label>
                                        <select name="AdminRoleEnum" class="col-12" id="AdminRoleEnum"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="GenderEnum">{{ __("attributes.GenderEnum") }}</label>
                                        <select name="GenderEnum" class="col-12" id="GenderEnum"></select>
                                    </div>

                                    <div class="col-sm-12 mb-3 fileUploadBuilder">
                                        <label for="flag">{{ __("attributes.image") }}</label>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/height-equal.js')}}"></script>
    <script>
        let htmlCountries = "";
        let htmlAdminStatus = "";
        let htmlAdminRoles = "";
        let htmlGenders = "";
        let pageData = @json($pageData);
        let datatableUri = APP_URL+"/"+pageData.link;
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
            { "data": "name" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return `${row.phonePrefix}${row.phone}`;
                }
            },
            { "data": "email" },
            { "data": "AdminRoleEnum.translate"},
            { "data": "AdminStatusEnum.translate"},
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
                                            data-bs-original-title="{{ __('lang.update') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.update') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>`;
                    }

                    if(pageData.actions.read === 1 ){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="openModalView(${dataString})"
                                            data-bs-original-title="{{ __('lang.view') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.view') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-eye"></i>
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
            $(modal).find("[name=name]").val(data.name);
            $(modal).find("[name=phone]").val(data.phone);
            $(modal).find("[name=email]").val(data.email);
            $(modal).find("[name=national_id]").val(data.national_id);
            fileUploadBuilder($(modal).find(".fileUploadBuilder"), "image", data.image, false, "image/*");
            $(modal).find('#AdminStatusEnum').val(data.AdminStatusEnum.key).trigger("change");
            $(modal).find("[name=block_reason]").val(data.block_reason);
            $(modal).find('#AdminRoleEnum').val(data.AdminRoleEnum.key);
            $(modal).find('#GenderEnum').val(data.GenderEnum.key);
            $(modal).find('#country_id').val(data.country.id).trigger('change');
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find("[name=name]").val(data.name).prop("disabled", true);
            $(modal).find("[name=phone]").val(data.phone).prop("disabled", true);
            $(modal).find("[name=email]").val(data.email).prop("disabled", true);
            $(modal).find("[name=national_id]").val(data.national_id).prop("disabled", true);
            fileUploadBuilder($(modal).find(".fileUploadBuilder"), "image", data.image, false, "image/*");
            $(modal).find(".fileUploadBuilder").find("button").remove();
            $(modal).find('#AdminStatusEnum').val(data.AdminStatusEnum.key).prop("disabled", true);
            $(modal).find("[name=block_reason]").val(data.block_reason).prop("disabled", true);
            $(modal).find('#AdminRoleEnum').val(data.AdminRoleEnum.key).prop("disabled", true);
            $(modal).find('#GenderEnum').val(data.GenderEnum.key).prop("disabled", true);
            $(modal).find('#country_id').val(data.country.id).trigger('change').prop("disabled", true);
            modal.modal("show");
        }


        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find('#country_id').val($(this).find('#country_id option:first').val()).trigger('change');
            $(this).find('#AdminRoleEnum').val($(this).find('#AdminRoleEnum option:first').val()).trigger('change');
            $(this).find('#GenderEnum').val($(this).find('#GenderEnum option:first').val()).trigger('change');
            fileUploadBuilder($(".create_modal").find(".fileUploadBuilder"), "image", null, false, "image/*");
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
                    for (const i in data) htmlCountries += `<option value="${data[i].id}" data-flag-url="${data[i].flag.file}">${data[i].phone_prefix}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#country_id").each(function() {
                        $(this).select2({
                            templateResult: formatState,
                            templateSelection: formatState
                        }).append(htmlCountries);
                    });

                    function formatState (state) {
                        if (!state.id) return state.text;
                        let flagUrl = $(state.element).data('flag-url');
                        let $state = $('<span><img src="' + APP_URL+"/uploads/"+flagUrl + '" class="img-flag" width="35" height="25" alt="flag"/> ' + state.text + '</span>');
                        return $state;
                    }
                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get admin roles enums
            $.ajax({
                url: APP_URL + "/api/web-services/enums/admin-role",
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
                    for (const i in data) htmlAdminRoles += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#AdminRoleEnum").each(function() {
                        $(this).append(htmlAdminRoles);
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //get admin status enums
            $.ajax({
                url: APP_URL + "/api/web-services/enums/admin-status",
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
                    for (const i in data) htmlAdminStatus += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $(".update_modal, .view_modal").find("#AdminStatusEnum").each(function() {
                        $(this).append(htmlAdminStatus);
                        $(this).on("change", function () {
                            let blockedReasonDom = $(this).closest("form").find(".blocked_reason");
                            let value = $(this).val();
                            blockedReasonDom.hide();
                            if (value === "{{ \App\Enums\AdminStatusEnum::Blocked->value }}") blockedReasonDom.show();
                        });
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //get admin gender enums
            $.ajax({
                url: APP_URL + "/api/web-services/enums/gender-status",
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
                    for (const i in data) htmlGenders += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#GenderEnum").each(function() {
                        $(this).append(htmlGenders);
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
