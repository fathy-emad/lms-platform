
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
                                        <th>Admin ID</th>
                                        <th>name</th>
                                        <th>Created at</th>
                                        <th>Created by</th>
                                        <th>Updated at</th>
                                        <th>updated by</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Admin ID</th>
                                        <th>name</th>
                                        <th>Created at</th>
                                        <th>Created by</th>
                                        <th>Updated at</th>
                                        <th>updated by</th>
                                        <th>Actions</th>
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
                                            @php $admins = \App\Models\Admin::all(); @endphp
                                            <div class="col-form-label">{{ __("attributes.admin") }}</div>
                                            <select name="admin_id" class="col-sm-12" id="admin_id">
                                                @foreach($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->phone }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="col-form-label">{{ __("attributes.select_permissions") }}</div>
                                            <div class="megaoptions-border-space-sm">
                                                <div class="row megaOptions"></div>
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
                                            @php $admins = \App\Models\Admin::all(); @endphp
                                            <div class="col-form-label">{{ __("attributes.admin") }}</div>
                                            <select name="admin_id" class="col-sm-12" id="admin_id">
                                                @foreach($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->phone }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="col-form-label">{{ __("attributes.select_permissions") }}</div>
                                            <div class="megaoptions-border-space-sm">
                                                <div class="row megaOptions"></div>
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
                                            @php $admins = \App\Models\Admin::all(); @endphp
                                            <div class="col-form-label">{{ __("attributes.admin") }}</div>
                                            <select name="admin_id" class="col-sm-12" id="admin_id">
                                                @foreach($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->phone }})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="col-form-label">{{ __("attributes.select_permissions") }}</div>
                                            <div class="megaoptions-border-space-sm">
                                                <div class="row megaOptions"></div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade delete_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.delete') }} {{ session("page_data")["title"]["translate"] }}</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            <form novalidate="" class="theme-form needs-validation" id="form3" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                                  action="{{ url(session("page_data")["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Well done!</h4>
                                            <p>Aww yeah, you successfully read this important alert message.</p>
                                            <hr>
                                            <p data-type="message" class="mb-0">Are you sure you want to delete this record</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-danger btn-block" onclick="submitForm(this, $('#data-table-ajax'))" type="button">{{ __("lang.delete") }}</button>
                                </div>
                            </form>
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
        let pageData = @json(session('page_data'));
        let htmlPermissions = "";
        let datatableUri = "{{ url("api")."/admin/employee/permission"}}";
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            { "data": "id" },
            { "data": "admin_id" },
            { "data": "admin.name" },
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

                    if(pageData.actions.delete === 1){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="openModalDelete(${dataString})"
                                            data-bs-original-title="{{ __('lang.delete') }} {{ session("page_data")["title"]["translate"] }}"
                                            title="{{ __('lang.delete') }} {{ session("page_data")["title"]["translate"] }}" fdprocessedid="pqwxqf">
                                        <i class="fa fa-trash"></i></button>
                                    </button>
                                </div>`;
                    }
                    actions += `</div>`;
                    return actions;
                }
            }
        ];

        function onRouteMenuCheckBoxChange(element){
            $(element).closest("[data-type=routeContainer]").find("[data-type=itemContainer]").css("opacity", $(element).prop("checked") ? 1 : 0.5);
            $(element).closest("[data-type=routeContainer]").find("[data-type=itemCheckBox]").prop("disabled", !$(element).prop("checked"));
            $(element).prev().prop("disabled", !$(element).prop("checked"));
        }

        function onItemCheckBoxChange(element){
            $(element).closest("[data-type=itemContainer]").find("[data-type=input]").prop("disabled", !$(element).prop("checked"));
            $(element).closest("[data-type=itemContainer]").find("[data-type=itemData]").css("opacity", $(element).prop("checked") ? 1 : 0.5);
        }

        function openModalUpdate(data) {
            let modal = $(".update_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find('#admin_id').select2();
            $(modal).find('#admin_id').val(data.admin_id).trigger('change');
            $(modal).find(".megaOptions").empty();
            $(modal).find(".megaOptions").append(htmlPermissions);
            $(modal).find("[name=id]").val(data.id);
            for (const i in data.permissions) {
                let permission = data.permissions[i];
                $(modal).find("[data-routeMenuCheckBox=" + permission.id + "]").click();

                for (const j in permission.items) {
                    let item = permission.items[j];
                    $(modal).find("[data-itemsCheckBox=" + item.id + "]").click();
                    $(modal).find("[data-specific_actions_belongs_to=" + item.id + "]").val(item.specific_actions_belongs_to);

                    for (const k in item.actions) {
                        let action = item.actions[k];
                        $(modal).find(`[data-actions=${k}_${item.id}]`).val(action);
                    }
                }
            }
            modal.modal("show");
        }
        function openModalView(data) {
            let modal = $(".view_modal");
            $(modal).find('#admin_id').select2();
            $(modal).find('#admin_id').val(data.admin_id).trigger('change');
            $(modal).find(".megaOptions").empty();
            $(modal).find(".megaOptions").append(htmlPermissions);

            for (const i in data.permissions) {
                let permission = data.permissions[i];
                $(modal).find("[data-routeMenuCheckBox=" + permission.id + "]").click();

                for (const j in permission.items) {
                    let item = permission.items[j];
                    $(modal).find("[data-itemsCheckBox=" + item.id + "]").click();
                    $(modal).find("[data-specific_actions_belongs_to=" + item.id + "]").val(item.specific_actions_belongs_to);

                    for (const k in item.actions) {
                        let action = item.actions[k];
                        $(modal).find(`[data-actions=${k}_${item.id}]`).val(action);
                    }
                }
            }

            $(modal).find('#admin_id').prop("disabled", true);
            $(modal).find("[data-routeMenuCheckBox]").prop("disabled", true);
            $(modal).find("[data-specific_actions_belongs_to]").prop("disabled", true);
            $(modal).find("[data-itemsCheckBox]").prop("disabled", true);
            $(modal).find("[data-actions]").prop("disabled", true);

            modal.modal("show");
        }
        function openModalDelete(data) {
            let modal = $(".delete_modal");
            $(modal).find("[name=id]").val(data.id);
            $(modal).find("[data-type=message]").html(`Are you sure you want to delete <strong>(${data.admin.name})</strong> permissions?`);
            modal.modal("show");
        }


        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find('#admin_id').select2();
            $(this).find('#admin_id').val($(this).find('#admin_id option:first').val()).trigger('change');
            $(this).find(".megaOptions").append(htmlPermissions);
        });

        $('.create_modal').on('hidden.bs.modal', function (e) { $(this).find(".megaOptions").empty(); });

        $(document).ready(function() {

            //Get route menu and set data to dom object
            $.ajax({
                url: APP_URL + "/api/admin/setting/route-menu?where=ActiveEnum:active",
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
                        htmlPermissions += `<div class="col-sm-12 mb-3" style="box-shadow: 2px 4px 6px 0px rgba(0, 0, 0, 0.3);" data-type="routeContainer">
                                                <div class="card">
                                                    <div class="media p-1">
                                                        <div class="form-check checkbox checkbox-solid-primary me-1">
                                                             <input type="hidden" name="permissions[${i}][id]" value="${data[i].id}" data-type="input" disabled/>
                                                             <input class="form-check-input" id="check_${i}" type="checkbox" data-routeMenuCheckBox="${data[i].id}" onchange="onRouteMenuCheckBoxChange(this)">
                                                             <label class="form-check-label" for="check_${i}"></label>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mt-0 mega-title-badge">${data[i].title.translate} <span class="badge badge-primary pull-right digits">${data[i].route}</span></h6>`;
                        for (const j in data[i].activeItems) {
                            let item = data[i].activeItems[j];
                            htmlPermissions += `<div class="col-12 mb-3" style="box-shadow: 2px 4px 6px 0px rgba(0, 0, 0, 0.3);opacity: 0.5;" data-type="itemContainer">
                                                    <div class="card mt-3">
                                                        <div class="media p-1">
                                                            <div class="form-check checkbox checkbox-solid-primary me-1">
                                                                <input type="hidden" type="checkbox" name="permissions[${i}][items][${j}][id]" value="${item.id}" data-type="input" disabled/>
                                                                <input class="form-check-input" id="check_${i}_${j}" type="checkbox" data-itemsCheckBox="${item.id}" onchange="onItemCheckBoxChange(this)" data-type="itemCheckBox" disabled>
                                                                <label class="form-check-label" for="check_${i}_${j}"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">${item.title.translate} <span class="badge badge-primary pull-right digits">${item.route}</span></h6>
                                                                <div class="row" data-type="itemData" style="opacity: 0.5;">
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label for="specific_actions_belongs_to">Specific actions belongs to (filed)</label>
                                                                            <input class="form-control" name="permissions[${i}][items][${j}][specific_actions_belongs_to]" id="specific_actions_belongs_to" type="text" placeholder="created_by" data-specific_actions_belongs_to="${item.id}" data-type="input" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label for="actions">actions</label>
                                                                                <div class="row justify-content-between">`;
                            for (const k in item.actions) {
                                let action = item.actions[k];
                                htmlPermissions += `<div class="col-6 mt-3">
                                                        <div class="mb-3">
                                                            <label for="actions_${i}_${j}_${k}">${action}</label>
                                                            <select name="permissions[${i}][items][${j}][actions][${action}]" data-actions="${action}_${item.id}" data-type="input" disabled>
                                                                <option value="0">none</option>
                                                                <option value="2">belongs to</option>
                                                                <option value="1">any</option>
                                                            </select>
                                                        </div>
                                                    </div>`;
                            }

                            htmlPermissions += `</div></div></div></div></div></div></div></div>`;
                        }
                        htmlPermissions += `</div></div></div></div>`;
                    }
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
