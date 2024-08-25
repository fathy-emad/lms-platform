@extends('dashboard_layouts.simple.master')

@section("phpScript") @php $pageData = checkPermission(request()->path(), session("admin_data")["permission"]["permissions"]) @endphp @endsection

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}"
          xmlns="http://www.w3.org/1999/html">
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
                    <div class="card-header">
                        @if($pageData["actions"]["create"])
                            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target=".create_modal"
                                    data-bs-original-title="{{ __('lang.create') }} {{ $pageData["page"]}}"
                                    title="{{ __('lang.create') }} {{ $pageData["page"] }}">
                                {{ __('lang.create') }} {{ $pageData["page"]}}
                            </button>
                        @endif
                        <nav class="breadcrumb breadcrumb-icon">
                            <a class="breadcrumb-item" href="{{url("admin/course/material/")}}" data-bread="teacher">({{ __("attributes.teacher") }}) {{ request("teacher") }}</a>
                            <a class="breadcrumb-item" href="" data-bread="course">({{ __("attributes.course") }})</a>
                            <a class="breadcrumb-item" href="" data-bread="chapter">({{ __("attributes.chapter") }})</a>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="data-table-ajax">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th width="300">{{ __("attributes.lesson") }}</th>
                                    <th>{{ __("attributes.created_at") }}</th>
                                    <th>{{ __("attributes.updated_at") }}</th>
                                    <th>{{ __("attributes.actions") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th width="300">{{ __("attributes.lesson") }}</th>
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
        <div class="modal fade create_modal" aria-labelledby="myLargeModalLabel" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">{{ __('lang.create') }} {{ $pageData["page"] }}</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate="" class="needs-validation" id="form1" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                              action="{{ url($pageData["link"]) }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-12">
                                        <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="create-data-tab" data-bs-toggle="pill" href="#create-data" role="tab" aria-controls="create-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                            <li class="nav-item"><a class="nav-link" id="create-assignment-tab" data-bs-toggle="pill" href="#create-assignment" role="tab" aria-controls="create-assignment" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>assignment</a></li>
{{--                                            <li class="nav-item"><a class="nav-link" id="update-translate-tab" data-bs-toggle="pill" href="#update-translate" role="tab" aria-controls="update-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>description translates</a></li>--}}
                                        </ul>
                                        <div class="tab-content" id="pills-infotabContent">

                                            <div class="tab-pane fade active show" id="create-data" role="tabpanel" aria-labelledby="create-data-tab">
                                                <div class="col-12 mb-3">
                                                    <input type="hidden" name="course_id" value="{{request("course_id")}}">
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="lesson_id">{{ __("attributes.lesson") }}</label>
                                                    <select name="lesson_id" class="form-control" id="lesson_id" ></select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="description">{{ __("attributes.description") }}</label>
                                                    <textarea type="text" name="description" class="form-control" id="description"></textarea>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="video">{{ __("attributes.video") }}</label>
                                                    <input type="text" class="form-control" name="video" id="video" />
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="video_duration">{{ __("attributes.video_duration") }} (in min)</label>
                                                    <input type="number" class="form-control" name="video_duration" id="video_duration" />
                                                </div>

                                                <div class="col-sm-12 mb-3 imagesUploadBuilder">
                                                    <label for="images">{{ __("attributes.images") }}</label>
                                                </div>

                                                <div class="col-sm-12 mb-3 filesUploadBuilder">
                                                    <label for="files">{{ __("attributes.files") }}</label>
                                                </div>

                                                <div class="col-sm-12 mb-3 media">
                                                    <label class="col-form-label m-r-10">{{ __("attributes.FreeEnum") }}</label>
                                                    <div class="media-body icon-state">
                                                        <label class="switch">
                                                            <input type="checkbox" name="FreeEnum" value="{{\App\Enums\FreeEnum::Free->value}}"><span class="switch-state"></span>
                                                        </label>
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

                                            <div class="tab-pane fade" id="create-assignment" role="tabpanel" aria-labelledby="create-assignment-tab">
                                                <div class="row megaOptions"></div>

                                            </div>

{{--                                            <div class="tab-pane fade" id="update-translate" role="tabpanel" aria-labelledby="update-translate-tab">--}}
{{--                                                <div class="row update-translates"></div>--}}
{{--                                            </div>--}}
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
                                            <li class="nav-item"><a class="nav-link" id="update-assignment-tab" data-bs-toggle="pill" href="#update-assignment" role="tab" aria-controls="update-assignment" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>assignment</a></li>
                                            <li class="nav-item"><a class="nav-link" id="update-translate-tab" data-bs-toggle="pill" href="#update-translate" role="tab" aria-controls="update-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>description translates</a></li>
                                        </ul>
                                        <div class="tab-content" id="pills-infotabContent">

                                            <div class="tab-pane fade active show" id="update-data" role="tabpanel" aria-labelledby="update-data-tab">
                                                <div class="col-12 mb-3">
                                                    <input type="hidden" name="course_id" value="{{request("course_id")}}">
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="lesson_id">{{ __("attributes.lesson") }}</label>
                                                    <select name="lesson_id" class="form-control" id="lesson_id" ></select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="video">{{ __("attributes.video") }}</label>
                                                    <input type="text" class="form-control" name="video" id="video" />
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="video_duration">{{ __("attributes.video_duration") }} (in min)</label>
                                                    <input type="number" class="form-control" name="video_duration" id="video_duration" />
                                                </div>

                                                <div class="col-sm-12 mb-3 imagesUploadBuilder">
                                                    <label for="images">{{ __("attributes.images") }}</label>
                                                </div>

                                                <div class="col-sm-12 mb-3 filesUploadBuilder">
                                                    <label for="files">{{ __("attributes.files") }}</label>
                                                </div>

                                                <div class="col-sm-12 mb-3 media">
                                                    <label class="col-form-label m-r-10">{{ __("attributes.FreeEnum") }}</label>
                                                    <div class="media-body icon-state">
                                                        <label class="switch">
                                                            <input type="checkbox" name="FreeEnum" value="{{\App\Enums\FreeEnum::Free->value}}"><span class="switch-state"></span>
                                                        </label>
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

                                            <div class="tab-pane fade" id="update-assignment" role="tabpanel" aria-labelledby="update-assignment-tab">
                                                <div class="row megaOptions"></div>

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
                        <form novalidate="" class="theme-form needs-validation">

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-12">
                                        <ul class="nav nav-pills nav-info mb-3" id="pills-infotab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="view-data-tab" data-bs-toggle="pill" href="#view-data" role="tab" aria-controls="view-data" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-ui-home"></i>data</a></li>
                                            <li class="nav-item"><a class="nav-link" id="view-assignment-tab" data-bs-toggle="pill" href="#view-assignment" role="tab" aria-controls="view-assignment" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>assignment</a></li>
                                            <li class="nav-item"><a class="nav-link" id="view-translate-tab" data-bs-toggle="pill" href="#view-translate" role="tab" aria-controls="view-translate" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>description translates</a></li>
                                        </ul>
                                        <div class="tab-content" id="pills-infotabContent">

                                            <div class="tab-pane fade active show" id="view-data" role="tabpanel" aria-labelledby="view-data-tab">

                                                <div class="col-12 mb-3">
                                                    <label for="lesson_id">{{ __("attributes.lesson") }}</label>
                                                    <select name="lesson_id" class="form-control" id="lesson_id" ></select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="video">{{ __("attributes.video") }}</label>
                                                    <input type="text" class="form-control" name="video" id="video" />
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="video_duration">{{ __("attributes.video_duration") }} (in min)</label>
                                                    <input type="number" class="form-control" name="video_duration" id="video_duration" />
                                                </div>

                                                <div class="col-sm-12 mb-3 imagesUploadBuilder">
                                                    <label for="images">{{ __("attributes.images") }}</label>
                                                </div>

                                                <div class="col-sm-12 mb-3 filesUploadBuilder">
                                                    <label for="files">{{ __("attributes.files") }}</label>
                                                </div>

                                                <div class="col-sm-12 mb-3 media">
                                                    <label class="col-form-label m-r-10">{{ __("attributes.FreeEnum") }}</label>
                                                    <div class="media-body icon-state">
                                                        <label class="switch">
                                                            <input type="checkbox" name="FreeEnum" value="{{\App\Enums\FreeEnum::Free->value}}"><span class="switch-state"></span>
                                                        </label>
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

                                            <div class="tab-pane fade" id="view-assignment" role="tabpanel" aria-labelledby="view-assignment-tab">
                                                <div class="row megaOptions"></div>

                                            </div>

                                            <div class="tab-pane fade" id="view-translate" role="tabpanel" aria-labelledby="view-translate-tab">
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

        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <!--
                Background of PhotoSwipe.
                It's a separate element, as animating opacity is faster than rgba().
                -->
            <div class="pswp__bg"></div>
            <!-- Slides wrapper with overflow:hidden.-->
            <div class="pswp__scroll-wrap">
                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <!-- Controls are self-explanatory. Order can be changed.-->
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                        <!-- element will get class pswp__preloader--active when preloader is running-->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
    <script>
        let htmlLessons = "";
        let questionsUpdate = [];
        let descriptionTranslates = "";
        let pageData = @json($pageData);
        let datatableUri = `{{ url("api")."/admin/course/material?where=course_id:" . request("course_id")}}`;
        let datatableAuthToken = "{{session("admin_data")["jwtToken"]}}";
        let dataTableLocale =  "{{session("locale")}}";
        let dataTableReorder = null;

        let datatableColumns = [
            { "data": "id" },
            { "data": "lesson.lesson.translate" },
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
                        $("[data-bread=course]").text("({{ __("attributes.course") }}) " + data.lesson.chapter.curriculum.curriculum.translate)
                            .attr("href", APP_URL + "/" + "admin/course/material/{{request("teacher")}}/{{request("teacher_id")}}");
                        $("[data-bread=chapter]").text("({{ __("attributes.chapter") }}) " + data.lesson.chapter.chapter.translate)
                            .attr("href", APP_URL + "/" + "admin/course/material/{{request("teacher")}}/{{request("teacher_id")}}/{{request("course_id")}}/{{request("curriculum_id")}}");
                    }
                    return actions;
                }
            }
        ];

        $('.create_modal').on('show.bs.modal', function (e) {
            let form = $(this).find("form");
            form[0].reset();
            $(this).find('#lesson_id').val($(this).find('#lesson_id option:first').val()).trigger("change");
            filesUploadBuilder($(".create_modal").find(".imagesUploadBuilder"), "images", null, true, "image/*");
            filesUploadBuilder($(".create_modal").find(".filesUploadBuilder"), "files", null, true, ".txt,.pdf,.doc,.docx,.ppt,.pptx");

        });

        function openModalUpdate(data) {
            let modal = $(".update_modal");
            let form = modal.find("form");
            questionsUpdate = [];
            questionsUpdate = data.assignment;
            form[0].reset();
            modal.find("[name=id]").val(data.id);
            modal.find("[name=course_id]").val(data.course_id);
            console.log(data.lesson.id);
            modal.find("[name=lesson_id]").val(data.lesson.id).trigger("change");
            modal.find("[name=video]").val(data.video);
            modal.find("[name=video_duration]").val(data.video_duration);
            filesUploadBuilder(modal.find(".imagesUploadBuilder"), "images", data.images, true, "image/*");
            filesUploadBuilder(modal.find(".filesUploadBuilder"), "files", data.files, true, ".txt,.pdf,.doc,.docx,.ppt,.pptx");
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active");
            modal.find("[name=FreeEnum]").prop("checked", data.FreeEnum.key === "free");
            modal.find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.description.translates[locale] || '');
            });
            modal.modal("show");
        }

        function openModalView(data) {
            let modal = $(".view_modal");
            questionsUpdate = [];
            questionsUpdate = data.assignment;
            modal.find("[name=lesson_id]").val(data.lesson.id).trigger("change").prop("disabled", true);
            modal.find("[name=video]").val(data.video).prop("disabled", true);
            modal.find("[name=video_duration]").val(data.video_duration).prop("disabled", true);
            filesUploadBuilder(modal.find(".imagesUploadBuilder"), "images", data.images, true, "image/*");
            $(".imagesUploadBuilder").find("button").remove();
            filesUploadBuilder(modal.find(".filesUploadBuilder"), "files", data.files, true, ".txt,.pdf,.doc,.docx,.ppt,.pptx");
            $(".filesUploadBuilder").find("button").remove();
            modal.find("[name=ActiveEnum]").prop("checked", data.ActiveEnum.key === "active").prop("disabled", true);
            modal.find("[name=FreeEnum]").prop("checked", data.FreeEnum.key === "free").prop("disabled", true);
            modal.find("[data-locale]").each(function (){
                let locale = $(this).data("locale");
                $(this).val(data.description.translates[locale] || '').prop("disabled", true);
            });
            modal.modal("show");
        }

        $(document).ready(function() {
            //Get Lessons
            $.ajax({
                url: APP_URL + "/api/admin/setting-education/lesson?where=chapter_id:{{ request("chapter_id") }}",
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
                    for (const i in data) htmlLessons += `<option value="${data[i].id}">${data[i].lesson.translate}</option>`;
                    $(".create_modal, .update_modal, .view_modal").each(function() {
                        $(this).find("#lesson_id").select2().append(htmlLessons);
                        $(this).find("#lesson_id").on("change", function () {
                            let lesson_id = $(this).val();
                            let megaOptions = $(this).closest(".modal").find(".megaOptions");
                            megaOptions.html('');

                            //Get bank-questions
                            $.ajax({
                                url: APP_URL + "/api/admin/setting-education/bank-question?where=teacher_id:{{ request("teacher_id") }},lesson_id:"+lesson_id+",ActiveEnum:{{\App\Enums\ActiveEnum::Active->value}}"+
                                    "&orWhere=teacher_id:null,lesson_id:"+lesson_id+",ActiveEnum:{{\App\Enums\ActiveEnum::Active->value}}",
                                type: "GET",
                                data: null,
                                processData: false,
                                contentType: false,
                                headers: {
                                    'Authorization': 'Bearer ' + "{{ session("admin_data")["jwtToken"] }}",
                                    'locale': "{{ session("locale") }}",
                                },
                                success: function(response) {
                                    let dataQuestions = response.data;
                                    for (const i in dataQuestions){
                                        let fig = "";
                                        let append = "";
                                        let question = dataQuestions[i];
                                        if (question.images){
                                            fig += `<div class="my-gallery-x card-body row gallery-with-description p-0 mt-2" itemscope="">`;
                                            for (const index in question.images) {
                                                let image = question.images[index];
                                                fig += `<figure class="col-3" itemprop="associatedMedia" itemscope="">
                                                                <a href="{{url('uploads')}}/${image.file}" itemprop="contentUrl" data-size="1920x1080">
                                                                    <img src="{{url('uploads')}}/${image.file}" style="width:150px" itemprop="thumbnail" alt="Image description">
                                                                    <div class="caption"><h4>${image.title || ''}</h4></div>
                                                                </a>
                                                                <figcaption style="display:none!important" itemprop="caption description"><h4>${image.title || ''}</h4></figcaption>
                                                            </figure>`;
                                            }
                                            fig += `</div>`;
                                        }

                                        append = `<div class="col-sm-12 border border-1 mb-3">
                                                        <div class="card mb-0">
                                                            <div class="media p-20">
                                                                <div class="form-check checkbox radio-primary me-3">
                                                                    <input class="form-check-input" id="assignment_${question.id}" type="checkbox" name="assignment[]" value="${question.id}" ${questionsUpdate.includes(String(question.id)) ? "checked" : ""}>
                                                                    <label class="form-check-label" for="assignment_${question.id}"></label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 mega-title-badge">${question.question}<span class="badge badge-primary pull-right digits">${question.correctAnswer}</span></h6>
                                                                    <span class="badge badge-primary">${question.answers[0]}</span>
                                                                    <span class="badge badge-secondary">${question.answers[1]}</span>
                                                                    <span class="badge badge-success">${question.answers[2]}</span>
                                                                    <span class="badge badge-warning">${question.answers[3]}</span>`;
                                        append += fig;
                                        append += `</div></div></div></div>`;
                                        megaOptions.append(append);
                                    }

                                    initPhotoSwipeFromDOM('.my-gallery-x');
                                },
                                error: function(xhr, status, error) {
                                    let title = "Some thing went wrong";
                                    let message = xhr.responseText || "Unknown error";
                                    notifyForm(title, message, "danger");
                                }
                            });
                        });
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
                        descriptionTranslates += `<div class="col-12 mb-3">
                                                    <label for="${data[i].locale}">${data[i].language.translate}</label>
                                                    <input data-locale="${data[i].locale}" class="form-control" id="${data[i].locale}" type="text" name="description[${data[i].locale}]" value="">
                                                </div>`;
                    }
                    $(".update_modal").find(".update-translates").append(descriptionTranslates);
                    $(".view_modal").find(".view-translates").append(descriptionTranslates);
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
