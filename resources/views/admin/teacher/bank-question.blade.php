@extends('dashboard_layouts.simple.master')

@section("phpScript") @php $pageData = checkPermission(request()->path(), session("admin_data")["permission"]["permissions"]) @endphp @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
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
                                <a class="breadcrumb-item" href="{{url("admin/teacher/bank-question/")}}" data-bread="teacher">({{ __("attributes.teacher") }}) {{ request("teacher") }}</a>
                                <a class="breadcrumb-item" href="" data-bread="curriculum">({{ __("attributes.curriculum") }})</a>
                                <a class="breadcrumb-item" href="" data-bread="chapter">({{ __("attributes.chapter") }})</a>
                                <a class="breadcrumb-item" href="" data-bread="lesson">({{ __("attributes.lesson") }})</a>
                            </nav>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th width="300">{{ __("attributes.question") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th width="300">{{ __("attributes.question") }}</th>
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
                                        <input type="hidden" name="lesson_id" value="{{request("lesson_id")}}">
                                        <input type="hidden" name="QuestionTypeEnum" value="{{ \App\Enums\QuestionTypeEnum::Choose->value }}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="question">{{ __("attributes.question") }}</label>
                                        <input type="text" name="question" class="form-control" id="question" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="answers">{{ __("attributes.answers") }}</label>
                                        <div class="card-body megaoptions-border-space-sm">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-primary me-3">
                                                                <input class="form-check-input" id="correctAnswer_A" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="" checked>
                                                                <label class="form-check-label" for="correctAnswer_A"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">A</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="A" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-secondary me-3">
                                                                <input class="form-check-input" id="correctAnswer_B" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="correctAnswer_B"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">B</h6>
                                                                <div><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="B" /></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-success me-3">
                                                                <input class="form-check-input" id="correctAnswer_C" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="correctAnswer_C"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">C</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="C" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-warning me-3">
                                                                <input class="form-check-input" id="correctAnswer_D" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="correctAnswer_D"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">D</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="D" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-3 filesUploadBuilder">
                                        <label for="images">{{ __("attributes.images") }}</label>
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

                                    <div class="col-12 mb-3">
                                        <input type="hidden" name="teacher_id" value="{{request("teacher_id")}}">
                                        <input type="hidden" name="lesson_id" value="{{request("lesson_id")}}">
                                        <input type="hidden" name="QuestionTypeEnum" value="{{ \App\Enums\QuestionTypeEnum::Choose->value }}">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="question">{{ __("attributes.question") }}</label>
                                        <input type="text" name="question" class="form-control" id="question" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="answers">{{ __("attributes.answers") }}</label>
                                        <div class="card-body megaoptions-border-space-sm">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-primary me-3">
                                                                <input class="form-check-input" id="update_correctAnswer_A" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="" checked>
                                                                <label class="form-check-label" for="update_correctAnswer_A"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">A</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="A" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-secondary me-3">
                                                                <input class="form-check-input" id="update_correctAnswer_B" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="update_correctAnswer_B"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">B</h6>
                                                                <div><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="B" /></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-success me-3">
                                                                <input class="form-check-input" id="update_correctAnswer_C" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="update_correctAnswer_C"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">C</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="C" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-warning me-3">
                                                                <input class="form-check-input" id="update_correctAnswer_D" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="update_correctAnswer_D"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">D</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="D" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-3 filesUploadBuilder">
                                        <label for="images">{{ __("attributes.images") }}</label>
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

        <!-- View modal -->
        <div class="modal fade view_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.view') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="theme-form needs-validation">

                            <div class="form-group">
                                <div class="row">


                                    <div class="col-12 mb-3">
                                        <label for="question">{{ __("attributes.question") }}</label>
                                        <input type="text" name="question" class="form-control" id="question" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="answers">{{ __("attributes.answers") }}</label>
                                        <div class="card-body megaoptions-border-space-sm">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-primary me-3">
                                                                <input class="form-check-input" id="view_correctAnswer_A" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="" checked>
                                                                <label class="form-check-label" for="view_correctAnswer_A"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">A</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="A" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-secondary me-3">
                                                                <input class="form-check-input" id="view_correctAnswer_B" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="view_correctAnswer_B"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">B</h6>
                                                                <div><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="B" /></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-success me-3">
                                                                <input class="form-check-input" id="view_correctAnswer_C" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="view_correctAnswer_C"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">C</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="C" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="media p-20">
                                                            <div class="form-check radio radio-warning me-3">
                                                                <input class="form-check-input" id="view_correctAnswer_D" type="radio" name="correctAnswer" value="" data-bs-original-title="" title="">
                                                                <label class="form-check-label" for="view_correctAnswer_D"></label>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mt-0 mega-title-badge">D</h6>
                                                                <p><input type="text" name="answers[]" class="form-control" id="answers" data-correctAnswer="D" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-3 filesUploadBuilder">
                                        <label for="images">{{ __("attributes.images") }}</label>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        let pageData = @json($pageData);
        let datatableUri = `{{ url("api")."/admin/setting-education/bank-question?where=teacher_id:" . request("teacher_id") . ",lesson_id:" . request('lesson_id')}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;

        let datatableColumns = [
            { "data": "id" },
            { "data": "question" },
            { "data": "created_at.dateTime" },
            { "data": "updated_at.dateTime" },
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
                                        <i class="fa fa-edit"></i></button>
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
                    if (meta.row === 0){
                        $("[data-bread=curriculum]").text("({{ __("attributes.curriculum") }}) " + data.lesson.chapter.curriculum.curriculum.translate).attr("href", APP_URL + "/" + "admin/teacher/bank-question/{{request("teacher")}}/{{request("teacher_id")}}");
                        $("[data-bread=chapter]").text("({{ __("attributes.chapter") }}) " + data.lesson.chapter.chapter.translate).attr("href", APP_URL + "/" + "admin/teacher/bank-question/{{request("teacher")}}/{{request("teacher_id")."/".request("curriculum_id")}}");
                        $("[data-bread=lesson]").text("({{ __("attributes.lesson") }}) " + data.lesson.lesson.translate).attr("href", APP_URL + "/" + "admin/teacher/bank-question/{{request("teacher")}}/{{request("teacher_id")."/".request("curriculum_id")."/".request("chapter_id")}}");
                    }
                    return actions;
                }
            }
        ];

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find("[name=correctAnswer]").val('');
            filesUploadBuilder($(".create_modal").find(".filesUploadBuilder"), "images", null, true, "image/*");

        });

        function openModalUpdate(data) {
            let modal = $(".update_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find("[name=id]").val(data.id);
            $(modal).find("[name=correctAnswer]").val('');
            $(modal).find("[name=question]").val(data.question);
            $(modal).find("[data-correctAnswer=A]").val(data.answers[0]).trigger('input');
            $(modal).find("[data-correctAnswer=B]").val(data.answers[1]).trigger('input');
            $(modal).find("[data-correctAnswer=C]").val(data.answers[2]).trigger('input');
            $(modal).find("[data-correctAnswer=D]").val(data.answers[3]).trigger('input');
            $(modal).find("[name=correctAnswer]").each(function () {
                if($(this).attr('value') === data.correctAnswer) {
                    $(this).prop("checked", true);
                }
            });
            filesUploadBuilder(modal.find(".filesUploadBuilder"), "images", data.images, true, "image/*");
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            let form = modal.find("form");
            form[0].reset();
            $(modal).find("[name=id]").val(data.id);
            $(modal).find("[name=correctAnswer]").val('');
            $(modal).find("[name=question]").val(data.question).prop("disabled", true);
            $(modal).find("[data-correctAnswer=A]").val(data.answers[0]).trigger('input').prop("disabled", true);
            $(modal).find("[data-correctAnswer=B]").val(data.answers[1]).trigger('input').prop("disabled", true);
            $(modal).find("[data-correctAnswer=C]").val(data.answers[2]).trigger('input').prop("disabled", true);
            $(modal).find("[data-correctAnswer=D]").val(data.answers[3]).trigger('input').prop("disabled", true);
            $(modal).find("[name=correctAnswer]").each(function () {
                $(this).prop("disabled", true);
                if($(this).attr('value') === data.correctAnswer) {
                    $(this).prop("checked", true);
                }
            });
            filesUploadBuilder(modal.find(".filesUploadBuilder"), "images", data.images, true, "image/*");
            $(modal).find(".filesUploadBuilder").find("button").remove();
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active").prop("disabled", true);
            modal.modal("show");
        }

        $(document).ready(function() {

            $("[name='answers[]']").each(function () {
                $(this).on("input", function(){
                    $(this).closest('.card').find("[name=correctAnswer]").val($(this).val());
                });
            });
        });

    </script>
@endsection
