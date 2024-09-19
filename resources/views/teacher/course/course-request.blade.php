@extends('teacher_dashboard_layouts.simple.master')

@section("phpScript")  @endsection

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
    <h3>{{ __("lang.course_requests") }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ __('lang.dashboard') }}</li>
    <li class="breadcrumb-item active">{{ __("lang.course_requests") }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                data-bs-original-title="{{ __('lang.create') }} Course Request"
                                title="{{ __('lang.create') }} Course Request">
                            {{ __('lang.create') }} {{ __("lang.course_requests") }}
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>{{ __("attributes.TeacherCourseRequestStatusEnum") }}</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ __("attributes.TeacherCourseRequestStatusEnum") }}</th>
                                    <th>{{ __("attributes.stage") }}</th>
                                    <th>{{ __("attributes.year") }}</th>
                                    <th>{{ __("attributes.curriculum") }}</th>
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


        <!-- Create modal -->
        <div class="modal fade create_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.create') }} {{ __("lang.course_requests") }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation" id="form1" method="POST" authorization="{{session("teacher_data")["jwtToken"]}}"
                              action="{{ url("api/teacher/course-request") }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <input type="hidden" name="teacher_id" value="{{session("teacher_data")["id"]}}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="curriculum_id">{{ __("attributes.curriculum") }}</label>
                                        <select name="curriculum_id" class="form-control" id="curriculum_id"></select>
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

    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        let htmlCurricula = "";
        let datatableUri = `{{ url("api")."/teacher/course-request/?where=teacher_id:".session("teacher_data")["id"]}}`;
        let datatableAuthToken = "{{session("teacher_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;

        let datatableColumns = [
            { "data": "TeacherCourseRequestStatusEnum", "render": function (data) {
                    if (data.key === "pending")
                        return `<span class="badge rounded-pill badge-primary">${data.translate}</span>`;

                    if (data.key === "rejected")
                        return `<span class="badge rounded-pill badge-danger">${data.translate}</span>`;

                    if (data.key === "approved")
                        return `<span class="badge rounded-pill badge-success">${data.translate}</span>`;

                }
            },
            { "data": "curriculum.subject.year.stage.translate" },
            { "data": "curriculum.subject.year.year.translate" },
            { "data": "curriculum.curriculum.translate" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" },
        ];


        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            form.find("[name]").removeClass("is-invalid");
            $(this).find("[name=curriculum_id]").val($(this).find('#curriculum_id option:first').val()).trigger("change");
        });

        $(document).ready(function() {

            //Get curricula from teacher
            $.ajax({
                url: APP_URL + "/api/teacher/my-info?id="+{{session("teacher_data")["id"]}},
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'Authorization': 'Bearer ' + "{{ session("teacher_data")["jwtToken"] }}",
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

        });

    </script>
@endsection
