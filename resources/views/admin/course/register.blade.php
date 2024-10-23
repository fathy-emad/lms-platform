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
                            <nav class="breadcrumb breadcrumb-icon mt-3">
                                <a class="breadcrumb-item" href="{{ route("admin.course.teachers") }}">{{$pageData["page"]}}</a>
                            </nav>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.title") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.cost") }}</th>
                                    <th>{{ __("attributes.percentage") }}</th>
                                    <th>{{ __("attributes.ActiveEnum") }}</th>
                                    <th>{{ __("attributes.IsFeatured") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ __("attributes.title") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.cost") }}</th>
                                    <th>{{ __("attributes.percentage") }}</th>
                                    <th>{{ __("attributes.ActiveEnum") }}</th>
                                    <th>{{ __("attributes.IsFeatured") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
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
                                        <input type="hidden" name="teacher_id" value="{{request("teacher_id")}}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="title">{{ __("attributes.title") }}</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="description">{{ __("attributes.description") }}</label>
                                        <textarea type="text" name="description" class="form-control" id="description"></textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="curriculum_id">{{ __("attributes.curriculum") }}</label>
                                        <select name="curriculum_id" class="form-control" id="curriculum_id"></select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="cost">{{ __("attributes.cost") }}</label>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="cost_course">{{ __("attributes.course") }}</label>
                                                <input class="form-control" name="cost[course]" id="cost_course" type="number" step="0.1"/>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="cost_chapter">{{ __("attributes.chapter") }}</label>
                                                <input class="form-control" name="cost[chapter]" id="cost_chapter" type="number" step="0.1"/>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="cost_lesson">{{ __("attributes.lesson") }}</label>
                                                <input class="form-control" name="cost[lesson]" id="cost_lesson" type="number" step="0.1"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="percentage">{{ __("attributes.percentage") }}</label>
                                        <input class="form-control" name="percentage" id="percentage" type="number" step="0.1"/>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="video">{{ __("attributes.video") }}</label>
                                        <input class="form-control" name="video" id="video" type="text"/>
                                    </div>

                                    <div class="col-sm-12 mb-3 fileUploadBuilder">
                                        <label for="image">{{ __("attributes.image") }}</label>
                                    </div>

                                    <div class="col-sm-12 mb-3 media">
                                        <label class="col-form-label m-r-10">{{ __("attributes.ActiveEnum") }}</label>
                                        <div class="media-body icon-state">
                                            <label class="switch">
                                                <input type="checkbox" name="ActiveEnum" value="{{\App\Enums\ActiveEnum::Active->value}}"><span class="switch-state"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-3 media">
                                        <label class="col-form-label m-r-10">{{ __("attributes.IsFeatured") }}</label>
                                        <div class="media-body icon-state">
                                            <label class="switch">
                                                <input type="checkbox" name="IsFeatured" value="1"><span class="switch-state"></span>
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

                                    <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="update-data-tab" data-bs-toggle="pill" href="#update-data" role="tab" aria-controls="update-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                        <li class="nav-item"><a class="nav-link" id="update-title-translate-tab" data-bs-toggle="pill" href="#update-title-translate" role="tab" aria-controls="update-title-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>title translates</a></li>
                                        <li class="nav-item"><a class="nav-link" id="update-desription-translate-tab" data-bs-toggle="pill" href="#update-description-translate" role="tab" aria-controls="update-description-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>description translates</a></li>
                                    </ul>

                                    <div class="tab-content" id="pills-infotabContent">

                                        <div class="tab-pane fade  active show" id="update-data" role="tabpanel" aria-labelledby="update-data-tab">

                                            <div class="col-12 mb-3">
                                                <input type="hidden" name="teacher_id" value="{{request("teacher_id")}}">
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="curriculum_id">{{ __("attributes.curriculum") }}</label>
                                                <select name="curriculum_id" class="form-control" id="curriculum_id"></select>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="cost">{{ __("attributes.cost") }}</label>
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <label for="cost_course">{{ __("attributes.course") }}</label>
                                                        <input class="form-control" name="cost[course]" id="cost_course" type="number" step="0.1"/>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="cost_chapter">{{ __("attributes.chapter") }}</label>
                                                        <input class="form-control" name="cost[chapter]" id="cost_chapter" type="number" step="0.1"/>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="cost_lesson">{{ __("attributes.lesson") }}</label>
                                                        <input class="form-control" name="cost[lesson]" id="cost_lesson" type="number" step="0.1"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="percentage">{{ __("attributes.percentage") }}</label>
                                                <input class="form-control" name="percentage" id="percentage" type="number" step="0.1"/>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <label for="video">{{ __("attributes.video") }}</label>
                                                <input class="form-control" name="video" id="video" type="text"/>
                                            </div>

                                            <div class="col-sm-12 mb-3 fileUploadBuilder">
                                                <label for="image">{{ __("attributes.image") }}</label>
                                            </div>

                                            <div class="col-sm-12 mb-3 media">
                                                <label class="col-form-label m-r-10">{{ __("attributes.ActiveEnum") }}</label>
                                                <div class="media-body icon-state">
                                                    <label class="switch">
                                                        <input type="checkbox" name="ActiveEnum" value="{{\App\Enums\ActiveEnum::Active->value}}"><span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-3 media">
                                                <label class="col-form-label m-r-10">{{ __("attributes.IsFeatured") }}</label>
                                                <div class="media-body icon-state">
                                                    <label class="switch">
                                                        <input type="checkbox" name="IsFeatured" value="1"><span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="update-title-translate" role="tabpanel" aria-labelledby="update-title-translate-tab">
                                            <div class="row update-title-translates"></div>
                                        </div>

                                        <div class="tab-pane fade" id="update-description-translate" role="tabpanel" aria-labelledby="update-description-translate-tab">
                                            <div class="row update-description-translates"></div>
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
        let htmlCurricula = "";
        let titleTranslates = "";
        let descriptionTranslates = "";
        let pageData = @json($pageData);
        let datatableUri = `{{ url("api")."/admin/course/register?where=teacher_id:".request("teacher_id")}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;

        let datatableColumns = [
            { "data": "id" },
            { "data": "title",
                render: function (data){
                    let $return = "";
                    if(data) return data.translate;
                    return "-"
                }
            },
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
            { "data": "IsFeatured" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" },
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
            form.find("[name]").removeClass("is-invalid");
            modal.find("[name=id]").val(data.id);
            modal.find("[name=percentage]").val(data.percentage);
            modal.find("#cost_course").val(data.cost["course"]);
            modal.find("#cost_chapter").val(data.cost["chapter"]);
            modal.find("#cost_lesson").val(data.cost["lesson"]);
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            modal.find("[name=IsFeatured]").prop("checked", data.IsFeatured);
            modal.find("[name=curriculum_id]").val(data.curriculum.id).trigger("change");
            modal.find("[name=video]").val(data.video);
            fileUploadBuilder($(modal).find(".fileUploadBuilder"), "image", data.image, true, "image/*");
            modal.find(".update-title-translates").find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.title.translates[locale] || '');

            });

            modal.find(".update-description-translates").find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.description.translates[locale] || '');

            });

            modal.modal("show");
        }


        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            form.find("[name]").removeClass("is-invalid");
            $(this).find("[name=curriculum_id]").val($(this).find('#curriculum_id option:first').val()).trigger("change");
            fileUploadBuilder($(".create_modal").find(".fileUploadBuilder"), "image", null, true, "image/*");

        });

        $(document).ready(function() {

            //Get curricula from teacher
            $.ajax({
                url: APP_URL + "/api/admin/teacher/register?id="+{{request("teacher_id")}},
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
                    for (const i in data.curricula){
                        let curriculum = data.curricula[i];
                        let types = curriculum.EduTypesEnums.map(function(item) {
                            return item.translate;
                        }).join(', ');
                        let terms = curriculum.EduTermsEnums.map(function(item) {
                            return item.translate;
                        }).join(', ');
                        htmlCurricula += `<option value="${curriculum.id}">
                                            (${curriculum.subject.year.year.translate})
                                            (${curriculum.curriculum.translate})
                                            (${terms})
                                            (${types})
                                        </option>`;
                    }
                    $(".create_modal, .update_modal").each(function() {
                        $(this).find("#curriculum_id").select2().append(htmlCurricula);
                    });

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });


            //Get languages title and description
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
                        titleTranslates += `<div class="col-12 mb-3">
                                                    <label for="${data[i].locale}">${data[i].language.translate}</label>
                                                    <input data-locale="${data[i].locale}" class="form-control" id="${data[i].locale}" type="text" name="title[${data[i].locale}]" value="">
                                                </div>`;
                        descriptionTranslates += `<div class="col-12 mb-3">
                                                    <label for="${data[i].locale}">${data[i].language.translate}</label>
                                                    <input data-locale="${data[i].locale}" class="form-control" id="${data[i].locale}" type="text" name="description[${data[i].locale}]" value="">
                                                </div>`;
                    }

                    $(".update_modal").find(".update-title-translates").append(titleTranslates);
                    $(".update_modal").find(".update-description-translates").append(descriptionTranslates);
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
