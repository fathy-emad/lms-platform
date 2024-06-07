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
                    <div class="card-header">
                        @if($pageData["actions"]["create"])
                            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                    data-bs-original-title="{{ __('lang.create') }} {{ $pageData["page"]}}"
                                    title="{{ __('lang.create') }} {{ $pageData["page"] }}">
                                {{ __('lang.create') }} {{ $pageData["page"]}}
                            </button>
                        @endif
                        <nav class="breadcrumb breadcrumb-icon">
                            <a class="breadcrumb-item" href="" data-bread="country">({{ __("attributes.country") }})</a>
                            <a class="breadcrumb-item" href="" data-bread="stage">({{ __("attributes.stage") }})</a>
                            <a class="breadcrumb-item" href="" data-bread="year">({{ __("attributes.year") }})</a>
                            <a class="breadcrumb-item" href="" data-bread="subject">({{ __("attributes.subject") }})</a>
                        </nav>
                    </div>
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
                                        <label for="curriculum">{{ __("attributes.curriculum") }}</label>
                                        <input type="text" name="curriculum" class="form-control" id="curriculum">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="EduTypesEnums">{{ __("attributes.types") }}</label>
                                        <select name="EduTypesEnums[]" class="col-12" id="EduTypesEnums" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="EduTermsEnums">{{ __("attributes.terms") }}</label>
                                        <select name="EduTermsEnums[]" class="col-12" id="EduTermsEnums" multiple></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="period">{{ __("attributes.period") }}</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="from">{{ __("attributes.from") }}</label>
                                                <select name="from" id="from"></select>
                                            </div>
                                            <div class="col-6">
                                                <label for="to">{{ __("attributes.to") }}</label>
                                                <select name="to" id="to"></select>
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
                                            <li class="nav-item"><a class="nav-link" id="update-translate-tab" data-bs-toggle="pill" href="#update-translate" role="tab" aria-controls="update-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>stage translates</a></li>
                                        </ul>
                                        <div class="tab-content" id="pills-infotabContent">

                                            <div class="tab-pane fade  active show" id="update-data" role="tabpanel" aria-labelledby="update-data-tab">

                                                <div class="col-12 mb-3">
                                                    <input type="hidden" name="subject_id" value="{{request("subject_id")}}">
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="EduTypesEnums">{{ __("attributes.types") }}</label>
                                                    <select name="EduTypesEnums[]" class="col-12" id="EduTypesEnums" multiple></select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="EduTermsEnums">{{ __("attributes.terms") }}</label>
                                                    <select name="EduTermsEnums[]" class="col-12" id="EduTermsEnums" multiple></select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="period">{{ __("attributes.period") }}</label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="from">{{ __("attributes.from") }}</label>
                                                            <select name="from" id="from"></select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="to">{{ __("attributes.to") }}</label>
                                                            <select name="to" id="to"></select>
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
        let dataTableReorder = null;
        let datatableColumns = [
            { "data": "id" },
            { "data": "curriculum.translate" },
            { "data": "EduTypesEnums",
                render:function (data) {
                    let $return = "";
                    for (const i in data)  $return += data[i].translate + (i + 1 < data.length ? ', ' : '');
                    return $return
                }
            },
            { "data": "EduTermsEnums",
                render:function (data) {
                    let $return = "";
                    for (const i in data)  $return += data[i].translate + (i + 1 < data.length ? ', ' : '');
                    return $return
                }
            },
            { "data": "from.translate",
                render: function (data){
                    return data + ` (${now.getFullYear()})`;
                }
            },
            { "data": null,
                render: function (data) {
                    if(data.to.key <= data.from.key) return data.to.translate +  ` (${now.getFullYear() + 1})`;
                    return data.to.translate +  ` (${now.getFullYear()})`;
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
                "render": function (data, type, row, meta) {
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

                    actions += `<div class="col-auto">
                                    <a class="btn btn-sm btn-success" type="button" href="{{url("/admin/setting-education/chapter")}}/${data.id}">
                                        <i class="fa fa-home"></i> Chapters
                                    </a>
                                </div>`;
                    actions += `</div>`;
                    if(meta.row === 0){
                        $("[data-bread=country]").text("({{ __("attributes.country") }}) " + data.subject.year.stage.country.country.translate).attr("href", APP_URL + "/" + "admin/setting-education/stage");
                        $("[data-bread=stage]").text("({{ __("attributes.stage") }}) " + data.subject.year.stage.stage.translate).attr("href", APP_URL + "/" + "admin/setting-education/stage");
                        $("[data-bread=year]").text("({{ __("attributes.year") }}) " + data.subject.year.year.translate).attr("href", APP_URL + "/" + "admin/setting-education/year/" + data.subject.year.stage.id);
                        $("[data-bread=subject]").text("({{ __("attributes.subject") }}) " + data.subject.subject.translate).attr("href", APP_URL + "/" + "admin/setting-education/subject/" + data.subject.year.id);
                    }
                    return actions;
                }
            }
        ];

        function openModalUpdate(data) {
            let modal = $(".update_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find("[name=id]").val(data.id);
            $(modal).find('#EduTypesEnums').val(data.EduTypesEnums.map(item => String(item.key))).trigger('change');
            $(modal).find('#EduTermsEnums').val(data.EduTermsEnums.map(item => String(item.key))).trigger('change');
            $(modal).find('#from').val(data.from.key).trigger('change');
            $(modal).find('#to').val(data.to.key).trigger('change');
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            modal.find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.curriculum.translates[locale] || '');
            });
            modal.modal("show");
        }

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find('#curriculum').val('');
            $(this).find('#EduTermsEnums').val('').trigger('change');
            $(this).find('#EduTypesEnums').val('').trigger('change');
            $(this).find('#from').val($(this).find('#from option:first').val()).trigger('change');
            $(this).find('#to').val($(this).find('#to option:first').val()).trigger('change');
        });

        $(document).ready(function() {

            //get edu terms enums
            $.ajax({
                url: APP_URL + "/api/web-services/enums/edu-terms",
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
                    for (const i in data) htmlTermsEnums += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $(".create_modal, .update_modal").find("#EduTermsEnums").each(function() {
                        $(this).select2().append(htmlTermsEnums);
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });


            //get edu types enums
            $.ajax({
                url: APP_URL + "/api/web-services/enums/edu-types",
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
                    for (const i in data) htmlTypesEnums += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $(".create_modal, .update_modal").find("#EduTypesEnums").each(function() {
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
                    $(".create_modal, .update_modal").each(function() {
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
                        htmlCurriculaEnums += `<div class="col-12 mb-3">
                                                    <label for="${data[i].locale}">${data[i].language.translate}</label>
                                                    <input data-locale="${data[i].locale}" class="form-control" id="${data[i].locale}" type="text" name="curriculum[${data[i].locale}]" value="">
                                                </div>`;
                    }
                    $(".update_modal").find(".update-translates").append(htmlCurriculaEnums);
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
