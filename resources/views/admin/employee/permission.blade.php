
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
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".create_modal" data-bs-original-title="" title="" fdprocessedid="pqwxqf">{{ __('lang.create') }} {{ session("page_data")["title"]["translate"] }}</button>
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
                                            <select name="admin_id" class="admin_id col-sm-12">
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
        @endif
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/height-equal.js')}}"></script>
    <script>

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
                "render": function (data, type, row) {
                    return `
                                   <div class="row justify-content-start">
                                        <div class="col-auto"><button class="btn btn-warning btn-sm action-edit" data-id="${row.name}"><i class="fa fa-edit"></i></button></div>
                                        <div class="col-auto"><button class="btn btn-primary btn-sm action-view" data-id="${row.id}"><i class="fa fa-eye"></i></button></div>
                                        <div class="col-auto"><button class="btn btn-danger btn-sm action-delete" data-id="${row.id}"><i class="fa fa-trash"></i></button></div>
                                   </div>`;
                }
            }
        ];
        function afterSubmit(){
            $("[data-type=itemContainer]").css("opacity", 0.5);
            $("[data-type=itemData]").css("opacity", 0.5);
        }

        $(document).ready(function() {
            $(".admin_id").select2();

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
                success: function(response, textStatus, jqXHR) {
                    let htmlPermissions = "";
                    let data = response.data;
                    for (const i in data) {
                        htmlPermissions += `<div class="col-sm-12 mb-3" style="box-shadow: 2px 4px 6px 0px rgba(0, 0, 0, 0.3);" data-type="routeContainer">
                                                <div class="card">
                                                    <div class="media p-1">
                                                        <div class="form-check checkbox checkbox-solid-primary me-1">
                                                             <input type="hidden" name="permissions[${i}][id]" value="${data[i].id}" data-type="input" disabled/>
                                                             <input class="form-check-input" id="check_${i}" type="checkbox" data-type="routeMenuCheckBox">
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
                                                                <input class="form-check-input" id="check_${i}_${j}" type="checkbox" data-type="itemCheckBox" disabled>
                                                                <label class="form-check-label" for="check_${i}_${j}"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">${item.title.translate} <span class="badge badge-primary pull-right digits">${item.route}</span></h6>
                                                                <div class="row" data-type="itemData" style="opacity: 0.5;">
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label for="specific_actions_belongs_to">Specific actions belongs to (filed)</label>
                                                                            <input class="form-control" name="permissions[${i}][items][${j}][specific_actions_belongs_to]" id="specific_actions_belongs_to" type="text" placeholder="created_by" data-type="input" disabled>
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
                                                            <select name="permissions[${i}][items][${j}][actions][${action}]" data-type="input" disabled>
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

                    $(".megaOptions").append(htmlPermissions);
                    $("[data-type=routeMenuCheckBox]").on("change", function () {
                        $(this).closest("[data-type=routeContainer]").find("[data-type=itemContainer]").css("opacity", $(this).prop("checked") ? 1 : 0.5);
                        $(this).closest("[data-type=routeContainer]").find("[data-type=itemCheckBox]").prop("disabled", !$(this).prop("checked"));
                        $(this).prev().prop("disabled", !$(this).prop("checked"));
                    });

                    $("[data-type=itemCheckBox]").on("change", function () {
                        $(this).closest("[data-type=itemContainer]").find("[data-type=input]").prop("disabled", !$(this).prop("checked"));
                        $(this).closest("[data-type=itemContainer]").find("[data-type=itemData]").css("opacity", $(this).prop("checked") ? 1 : 0.5);
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
