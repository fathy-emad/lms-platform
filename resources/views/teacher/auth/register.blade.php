@extends('teacher_dashboard_layouts.authentication.master')
@section('title', 'Register')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <style>
        .select2-dropdown { z-index: 10000 !important; }
        /* CSS to set mouse pointer to none for disabled elements */
        [disabled] {
            pointer-events: none;
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                  action="{{ url("api/teacher/auth/register") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                <div class="col-12 p-0">
                    <div class="theme-form">
                        <div class="wizard-4" id="wizard">
                            <ul>
                                <li>
                                    <a class="logo text-start ps-0" href="#">
                                        <img class="img-fluid for-light" width="175" height="40" src="{{asset('build/img/logo.svg')}}" alt="looginpage">
                                        <img class="img-fluid for-dark" width="175" height="40" src="{{asset('build/img/logo_dark.svg')}}" alt="looginpage">
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-1">
                                        <h4>1</h4>
                                        <h5>Personal</h5>
                                        <small>Add personal details</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <h4>2</h4>
                                        <h5>Personal Cont.</h5>
                                        <small>Complete personal details</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <h4>3</h4>
                                        <h5>Contact</h5>
                                        <small>Add Contact Number</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-4">
                                        <h4>4</h4>
                                        <h5>Course specialization</h5>
                                        <small>Add Course specialization details</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-5">
                                        <h4>5</h4>
                                        <h5>Password</h5>
                                        <small>Add your password</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-6">
                                        <h4>6</h4>
                                        <h5> Done <i class="fa fa-thumbs-o-up"></i></h5>
                                        <small>Register.. !</small>
                                    </a>
                                </li>
                            </ul>
                            <div id="step-1">
                                <div class="wizard-title">
                                    <h2>Sign up to account</h2>
                                    <h5 class="text-muted mb-4">Enter your name details</h5>
                                </div>
                                <div class="login-main">
                                    <div class="theme-form">
                                        <div class="form-group mb-3">
                                            <label for="GenderEnum">Gender</label>
                                            <select class="form-control" name="GenderEnum" id="GenderEnum" required></select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="prefix">Name Prefix</label>
                                            <select class="form-control" name="prefix" id="prefix" required></select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Mohamed ..." required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <div class="wizard-title">
                                    <h2>Sign up to account</h2>
                                    <h5 class="text-muted mb-4">Enter your email & image</h5>
                                </div>
                                <div class="login-main">
                                    <div class="theme-form">
                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" name="email" id="email" placeholder="example@exmaple.com" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="image">Upload Image</label>
                                            <div class="col-sm-9 mb-3">
                                                <input class="form-control" name="image[file]" accept="image/*" type="file" id="image">
                                            </div>
                                            <div class="col-sm-3">
                                                <img class="img-fluid for-light" src="{{asset('build/img/logo.svg')}}" id="imagePreview" alt="looginpage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3">
                                <div class="wizard-title">
                                    <h2>Sign up to account</h2>
                                    <h5 class="text-muted mb-4">Enter your phone & country</h5>
                                </div>
                                <div class="login-main">
                                    <div class="theme-form">
                                        <div class="form-group mb-3">
                                            <label for="country_id">Country</label>
                                            <select class="form-control" name="country_id" id="country_id" required></select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="phone">Phone</label>
                                            <input class="form-control" type="number" name="phone" id="phone" placeholder="1*******" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-4">
                                <div class="wizard-title">
                                    <h2>Sign up to account</h2>
                                    <h5 class="text-muted mb-4">Enter your Stage & education subject</h5>
                                </div>
                                <div class="login-main">
                                    <div class="theme-form">
                                        <div class="form-group mb-3">
                                            <label for="stage_id">Stage</label>
                                            <select class="form-control" name="stage_id" id="stage_id" required></select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="edu_subject_id">Education Subject</label>
                                            <select class="form-control" name="edu_subject_id" id="edu_subject_id" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-5">
                                <div class="wizard-title">
                                    <h2>Sign up to account</h2>
                                    <h5 class="text-muted mb-4">Enter your password (minimum 8 characters with at least number,digit,symbol and capital letter)</h5>
                                </div>
                                <div class="login-main">
                                    <div class="theme-form">
                                        <div class="form-group mb-3">
                                            <label for="password">Password</label>
                                            <input class="form-control" id="password" type="password" name="password" placeholder="*********" required/>
                                            <div class="show-hide" style="margin-top: 15px !important;"><span class="show"></span></div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password_confirmation">Password confirmation</label>
                                            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="*********" required/>
                                            <div class="show-hide" style="margin-top: 15px !important;"><span class="show"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-6">
                                <div class="wizard-title">
                                    <h2>Sign up to account</h2>
                                    <h5 class="text-muted mb-4">Thank you for complete your register</h5>
                                </div>
                                <div class="login-main">
                                    <div class="theme-form">
                                        <h1> Done <i class="fa fa-thumbs-o-up"></i></h1>
                                        <button class="btn btn-primary btn-block" onclick="submitForm(this, null, successCallback)" type="button">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('assets/js/form-wizard/form-wizard-five.js')}}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js')}}"></script>
    <script>
        let successCallback = function()
        {
            window.location = APP_URL + "/teacher/auth/login";
        }
        $(document).ready(function() {


            //Get countries
            let countries = "";
            $.ajax({
                url: APP_URL + "/api/teacher/country?where=ActiveEnum:active",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'locale': "en",
                },
                success: function(response) {
                    let data = response.data;
                    for (const i in data) countries += `<option value="${data[i].id}" data-flag-url="${data[i].flag.file}">${data[i].phone_prefix}</option>`;

                    $("#country_id").select2({
                        templateResult: formatState,
                        templateSelection: formatState
                    }).append(countries);

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

            // //Get stages
            let stages = "";
            $.ajax({
                url: APP_URL + "/api/teacher/stage?where=ActiveEnum:active",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'locale': "en",
                },
                success: function(response) {
                    let data = response.data;
                    for (const i in data) stages += `<option value="${data[i].id}">(${data[i].country.country.translate}) ${data[i].stage.translate}</option>`;
                    $("#stage_id").select2().append(stages);

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            // //Get edu subjects
            let subjects = "";
            $.ajax({
                url: APP_URL + "/api/teacher/edu-subject",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'locale': "en",
                },
                success: function(response) {
                    let data = response.data;
                    for (const i in data) subjects += `<option value="${data[i].id}">${data[i].subject.translate}</option>`;
                    $("#edu_subject_id").select2().append(subjects);

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //get teacher gender enums
            let genders = "";
            $.ajax({
                url: APP_URL + "/api/web-services/enums/gender-status",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'locale': "en",
                },
                success: function(response) {
                    let data = response.data;
                    for (const i in data) genders += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $("#GenderEnum").select2().append(genders);
                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            //get name prefixes
            let prefixes = "";
            $.ajax({
                url: APP_URL + "/api/web-services/enums/name-prefix",
                type: "GET",
                data: null,
                processData: false,
                contentType: false,
                headers: {
                    'locale': "en",
                },
                success: function(response) {
                    let data = response.data;
                    for (const i in data) prefixes += `<option value="${data[i]}" ">${data[i]}</option>`;
                    $("#prefix").select2().append(prefixes);
                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            });

            $("#image").on("change", function (event){
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").attr('src', e.target.result); // Set the src of the img tag
                };
                reader.readAsDataURL(file);
            });

            $("#phone").on("input", function () {
                let value = $(this).val();

                // Regular expression to remove leading zeros
                let newValue = value.replace(/^0+/, '');

                // Limit the length to 10 digits
                newValue = newValue.slice(0, 10);

                // Update the input value if it has changed
                if (value !== newValue) {
                    $(this).val(newValue);
                }

            });


            $('.show-hide').show();
            $('.show-hide span').addClass('show');

            $('.show-hide span').click(function () {

                let name = $(this).parent().prev().attr("name");

                if ($(this).hasClass('show')) {
                    $('input[name="' + name + '"]').attr('type', 'password');
                    $(this).addClass('show');
                } else {
                    $('input[name="' + name + '"]').attr('type', 'text');
                    $(this).removeClass('show');
                }
            });
            $('form button[type="submit"]').on('click', function () {
                $('.show-hide span').text('Show').addClass('show');
                $('.show-hide').parent().find('input[name="password"]').attr('type', 'password');
            });

        });

    </script>
@endsection
