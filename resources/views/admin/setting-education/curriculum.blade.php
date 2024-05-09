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
        .select2-selection__rendered {
            margin-top: 5px !important;
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
                            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                    data-bs-original-title="{{ __('lang.create') }} {{ $pageData["page"]}}"
                                    title="{{ __('lang.create') }} {{ $pageData["page"] }}">
                                {{ __('lang.create') }} {{ $pageData["page"]}}
                            </button>
                            <nav class="breadcrumb breadcrumb-icon">
                                <a class="breadcrumb-item" href="" data-bread="country">country</a>
                                <a class="breadcrumb-item" href="" data-bread="stage">stage</a>
                                <a class="breadcrumb-item" href="" data-bread="year">year</a>
                                <a class="breadcrumb-item" href="" data-bread="subject">subject</a>
                            </nav>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.types") }}</th>
                                    <th>{{ __("attributes.terms") }}</th>
                                    <th>{{ __("attributes.from") }}</th>
                                    <th>{{ __("attributes.to") }}</th>
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
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.types") }}</th>
                                    <th>{{ __("attributes.terms") }}</th>
                                    <th>{{ __("attributes.from") }}</th>
                                    <th>{{ __("attributes.to") }}</th>
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
                                        <input type="hidden" name="subject_id" value="{{request("subject_id")}}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="CurriculumEnumTable">{{ __("attributes.curriculum") }}</label>
                                        <select name="CurriculumEnumTable" class="col-12" id="CurriculumEnumTable"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="TypesEnumTable">{{ __("attributes.types") }}</label>
                                        <select name="TypesEnumTable[]" class="col-12" id="TypesEnumTable" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="TermsEnumTable">{{ __("attributes.terms") }}</label>
                                        <select name="TermsEnumTable[]" class="col-12" id="TermsEnumTable" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="period">{{ __("attributes.period") }}</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="from">{{ __("attributes.from") }}</label>
                                                <select name="curriculumFrom" id="from"></select>
                                            </div>
                                            <div class="col-6">
                                                <label for="to">{{ __("attributes.to") }}</label>
                                                <select name="curriculumTo" id="to"></select>
                                            </div>
                                        </div>
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
                                        <input type="hidden" name="subject_id" value="{{request("subject_id")}}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="CurriculumEnumTable">{{ __("attributes.curriculum") }}</label>
                                        <select name="CurriculumEnumTable" class="col-12" id="CurriculumEnumTable"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="TypesEnumTable">{{ __("attributes.types") }}</label>
                                        <select name="TypesEnumTable[]" class="col-12" id="TypesEnumTable" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="TermsEnumTable">{{ __("attributes.terms") }}</label>
                                        <select name="TermsEnumTable[]" class="col-12" id="TermsEnumTable" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="period">{{ __("attributes.period") }}</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="from">{{ __("attributes.from") }}</label>
                                                <select name="curriculumFrom" id="from"></select>
                                            </div>
                                            <div class="col-6">
                                                <label for="to">{{ __("attributes.to") }}</label>
                                                <select name="curriculumTo" id="to"></select>
                                            </div>
                                        </div>
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
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.view') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form novalidate="" class="theme-form needs-validation">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <input type="hidden" name="subject_id" value="{{request("subject_id")}}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="CurriculumEnumTable">{{ __("attributes.curriculum") }}</label>
                                        <select name="CurriculumEnumTable" class="col-12" id="CurriculumEnumTable"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="TypesEnumTable">{{ __("attributes.types") }}</label>
                                        <select name="TypesEnumTable[]" class="col-12" id="TypesEnumTable" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="TermsEnumTable">{{ __("attributes.terms") }}</label>
                                        <select name="TermsEnumTable[]" class="col-12" id="TermsEnumTable" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="period">{{ __("attributes.period") }}</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="from">{{ __("attributes.from") }}</label>
                                                <select name="curriculumFrom" id="from"></select>
                                            </div>
                                            <div class="col-6">
                                                <label for="to">{{ __("attributes.to") }}</label>
                                                <select name="curriculumTo" id="to"></select>
                                            </div>
                                        </div>
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

    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>

    <script>
        const now = new Date();
        let htmlTermsEnums = "";
        let htmlTypesEnums = "";
        let htmlMonthsEnums = "";
        let htmlCurriculaEnums = "";
        let pageData = @json($pageData);
        let datatableUri = `{{ url("api")."/admin/setting-education/curriculum?where=subject_id:".request("subject_id")}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let datatableColumns = [
            { "data": "id" },
            { "data": "title.value.translate" },
            { "data": "types",
                render:function (data) {
                    let $return = "";
                    for (const i in data)  $return += data[i].value.translate + (i + 1 < data.length ? ', ' : '');
                    return $return
                }
            },
            { "data": "terms",
                render:function (data) {
                    let $return = "";
                    for (const i in data)  $return += data[i].value.translate + (i + 1 < data.length ? ', ' : '');
                    return $return
                }
            },
            { "data": "curriculumFrom.translate",
                render: function (data){
                    return data + ` (${now.getFullYear()})`;
                }
            },
            { "data": null,
                render: function (data) {
                    if(data.curriculumTo.key <= data.curriculumFrom.key) return data.curriculumTo.translate +  ` (${now.getFullYear() + 1})`;
                    return data.curriculumTo.translate +  ` (${now.getFullYear()})`;
                }
            },
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
                                            data-bs-original-title="{{ __('lang.update') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.update') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-edit"></i></button>
                                    </button>
                                </div>`;
                    }

                    if(pageData.actions.read === 1 ){
                        actions += `<div class="col-auto">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="openModalView(${dataString})"
                                            data-bs-original-title="{{ __('lang.view') }} {{ $pageData["page"] }}"
                                            title="{{ __('lang.view') }} {{ $pageData["page"] }}">
                                        <i class="fa fa-eye"></i></button>
                                    </button>
                                </div>`;
                    }

                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button" href="{{url("/admin/setting-education/curriculum")}}/${data.id}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </div>`;
                    actions += `</div>`;
                    return actions;
                }
            }
        ];

        function openModalUpdate(data) {
            console.log(data);
            let modal = $(".update_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find("[name=id]").val(data.id);
            $(modal).find('#CurriculumEnumTable').val(data.title.id).trigger('change');
            $(modal).find('#TypesEnumTable').val(data.types.map(item => String(item.id))).trigger('change');
            $(modal).find('#TermsEnumTable').val(data.terms.map(item => String(item.id))).trigger('change');
            $(modal).find('#from').val(data.curriculumFrom.key).trigger('change');
            $(modal).find('#to').val(data.curriculumTo.key).trigger('change');
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find('#CurriculumEnumTable').val(data.title.id).trigger('change').prop("disabled", true);
            $(modal).find('#TypesEnumTable').val(data.types.map(item => String(item.id))).trigger('change').prop("disabled", true);
            $(modal).find('#TermsEnumTable').val(data.terms.map(item => String(item.id))).trigger('change').prop("disabled", true);
            $(modal).find('#from').val(data.curriculumFrom.key).trigger('change').prop("disabled", true);
            $(modal).find('#to').val(data.curriculumTo.key).trigger('change').prop("disabled", true);
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active").prop("disabled", true);
            modal.modal("show");
        }

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find('#CurriculumEnumTable').val($(this).find('#CurriculumEnumTable option:first').val()).trigger('change');
            $(this).find('#TypesEnumTable').val('').trigger('change');
            $(this).find('#TermsEnumTable').val('').trigger('change');
            $(this).find('#from').val($(this).find('#from option:first').val()).trigger('change');
            $(this).find('#to').val($(this).find('#to option:first').val()).trigger('change');
        });

        $(document).ready(function() {

            //Get subject
            $.ajax({
                url: APP_URL + "/api/admin/setting-education/subject?id={{request("subject_id")}}",
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
                    $("[data-bread=country]").text(data.year.stage.country.country.translate).attr("href", APP_URL + "/" + "admin/setting-education/stage");
                    $("[data-bread=stage]").text(data.year.stage.title.value.translate).attr("href", APP_URL + "/" + "admin/setting-education/stage");
                    $("[data-bread=year]").text(data.year.title.value.translate).attr("href", APP_URL + "/" + "admin/setting-education/year/" + data.year.id);
                    $("[data-bread=subject]").text(data.title.value.translate).attr("href", APP_URL + "/" + "admin/setting-education/subject/" + data.id);
                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get curricula
            $.ajax({
                url: APP_URL + "/api/admin/setting/enumeration?where=key:{{\App\Enums\SystemConstantsEnum::CurriculumEnumTable->value}}",
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
                    for (const i in data) htmlCurriculaEnums += `<option value="${data[i].id}" ">${data[i].value.translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#CurriculumEnumTable").each(function() {
                        $(this).select2().append(htmlCurriculaEnums);
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get terms
            $.ajax({
                url: APP_URL + "/api/admin/setting/enumeration?where=key:{{\App\Enums\SystemConstantsEnum::TermEnumTable->value}}",
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
                    for (const i in data) htmlTermsEnums += `<option value="${data[i].id}" ">${data[i].value.translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#TermsEnumTable").each(function() {
                        $(this).select2().append(htmlTermsEnums);
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get types
            $.ajax({
                url: APP_URL + "/api/admin/setting/enumeration?where=key:{{\App\Enums\SystemConstantsEnum::TypeEnumTable->value}}",
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
                    for (const i in data) htmlTypesEnums += `<option value="${data[i].id}" ">${data[i].value.translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").find("#TypesEnumTable").each(function() {
                        $(this).select2().append(htmlTypesEnums);
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //Get months
            $.ajax({
                url: APP_URL + "/api/web-services/enums/months",
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
                    for (const i in data) htmlMonthsEnums += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").each(function() {
                        $(this).find("#from").select2().append(htmlMonthsEnums);
                        $(this).find("#to").select2().append(htmlMonthsEnums);
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
