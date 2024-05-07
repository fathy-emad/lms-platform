@extends('dashboard_layouts.simple.master')

@section("phpScript") @php $pageData = checkPermission(request()->path(), session("admin_data")["permission"]["permissions"]) @endphp @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <style>[disabled] {  pointer-events: none; }</style>
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
                                    <th>{{ __("attributes.flag") }}</th>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.locale_symbol") }}</th>
                                    <th>{{ __("attributes.language") }}</th>
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
                                    <th>{{ __("attributes.flag") }}</th>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.locale_symbol") }}</th>
                                    <th>{{ __("attributes.language") }}</th>
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
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.create') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation" id="form1" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                              action="{{ url($pageData["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <label for="locale">{{ __("attributes.locale_symbol") }}</label>
                                        <input class="form-control" name="locale" id="locale" type="text" placeholder="ex: ar, en" />
                                    </div>

                                    <div class="col-sm-12 mb-3">
                                        <label for="language">{{ __("attributes.language") }}</label>
                                        <input class="form-control" name="language" id="language" type="text" placeholder="ex: english, arabic, french" />
                                    </div>

                                    <div class="col-sm-12 mb-3 fileUploadBuilder">
                                        <label for="flag">{{ __("attributes.flag") }}</label>
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
        <!-- Update modal -->
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

                                    <div class="col-12">
                                        <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="update-data-tab" data-bs-toggle="pill" href="#update-data" role="tab" aria-controls="update-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                            <li class="nav-item"><a class="nav-link" id="update-translate-tab" data-bs-toggle="pill" href="#update-translate" role="tab" aria-controls="update-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>language translates</a></li>
                                        </ul>
                                        <div class="tab-content" id="pills-infotabContent">

                                            <div class="tab-pane fade  active show" id="update-data" role="tabpanel" aria-labelledby="update-data-tab">
                                                <div class="col-12 mb-3">
                                                    <label for="locale">{{ __("attributes.locale_symbol") }}</label>
                                                    <input class="form-control" name="locale" id="locale" type="text" placeholder="ex: ar, en" />
                                                </div>
                                                <div class="col-sm-12 mb-3 fileUploadBuilder">
                                                    <label for="flag">{{ __("attributes.flag") }}</label>
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


                                            <div class="tab-pane fade" id="update-translate" role="tabpanel" aria-labelledby="update-translate-tab">
                                                <div class="row update-translates"></div>
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
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.view') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form novalidate="" class="theme-form needs-validation">
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-12">
                                            <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" id="view-data-tab" data-bs-toggle="pill" href="#view-data" role="tab" aria-controls="view-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                                <li class="nav-item"><a class="nav-link" id="view-translate-tab" data-bs-toggle="pill" href="#view-translate" role="tab" aria-controls="view-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>language translates</a></li>
                                            </ul>
                                            <div class="tab-content" id="pills-infotabContent">

                                                <div class="tab-pane fade  active show" id="view-data" role="tabpanel" aria-labelledby="update-data-tab">
                                                    <div class="col-12 mb-3">
                                                        <label for="locale">{{ __("attributes.locale_symbol") }}</label>
                                                        <input class="form-control" name="locale" id="locale" type="text" placeholder="ex: ar, en" />
                                                    </div>
                                                    <div class="col-sm-12 mb-3">
                                                        <label for="flag">{{ __("attributes.flag") }}</label>
                                                        <div class="fileUploadBuilder" data-name="flag" data-title="" data-multiple="" data-value="" data-accepts="image/svg+xml"></div>
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


                                                <div class="tab-pane fade" id="view-translate" role="tabpanel" aria-labelledby="update-translate-tab">
                                                    <div class="row view-translates"></div>
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
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script>

        let languageTranslates = "";
        let pageData = @json($pageData);
        let datatableUri = `${APP_URL}/${pageData.link}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            {
                "data": "flag.file",
                "render": function(data) {
                    return data ? `<img src="${APP_URL}/uploads/${data}" style="height: 25px; width: auto;">` : '-';
                }
            },
            { "data": "id" },
            { "data": "locale" },
            { "data": "language.translate" },
            { "data": "ActiveEnum.translate" },
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

                    //if(pageData.actions.update === 1 || (pageData.actions.update === 2 && "{{session("admin_data")["id"]}}" == data[pageData.specific_actions_belongs_to].id)){
                    if(pageData.actions.update === 1){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-warning" type="button" onclick="openModalUpdate(${dataString})"
                                            data-bs-original-title="{{ __('lang.update') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.update') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>`;
                    }

                   //if(pageData.actions.read === 1 || (pageData.actions.read === 2 && "{{session("admin_data")["id"]}}" == data[pageData.specific_actions_belongs_to].id)){
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
            form.find("[name]").removeClass("is-invalid");
            modal.find("[name=id]").val(data.id);
            modal.find("[name=locale]").val(data.locale);
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            fileUploadBuilder($(modal).find(".fileUploadBuilder"), "flag", data.flag, false, "image/svg+xml");
            modal.find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.language.translates[locale] || '');
            });
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            let form = modal.find("form");
            form[0].reset();
            modal.find("[name=locale]").val(data.locale).prop("disabled", true);
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active").prop("disabled", true);
            fileUploadBuilder($(modal).find(".fileUploadBuilder"), "flag", data.flag, false, "image/svg+xml");
            $(modal).find(".fileUploadBuilder").find("button").remove();
            modal.find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.language.translates[locale] || '').prop("disabled", true);
            });
            modal.modal("show");
        }

        function openModalDelete(data) {
            let modal = $(".delete_modal");
            $(modal).find("[name=id]").val(data.id);
            $(modal).find("[data-type=message]").html(`Are you sure you want to delete <strong>()</strong> permissions?`);
            modal.modal("show");
        }

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            form.find("[name]").removeClass("is-invalid");
            fileUploadBuilder($(".create_modal").find(".fileUploadBuilder"), "flag", null, false, "image/svg+xml");
        });

        $(document).ready(function() {

            //Get route menu and set data to dom object
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
                        languageTranslates += `<div class="col-12 mb-3">
                                                    <label for="${data[i].locale}">${data[i].language.translate}</label>
                                                    <input data-locale="${data[i].locale}" class="form-control" id="${data[i].locale}" type="text" name="language[${data[i].locale}]" value="">
                                                </div>`;
                    }
                    $(".update_modal").find(".update-translates").append(languageTranslates);
                    $(".view_modal").find(".view-translates").append(languageTranslates);
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
