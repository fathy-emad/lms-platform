@extends('dashboard_layouts.simple.master')

@section('title', 'Account')

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

@section('breadcrumb-title')
    <h3>Account</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Account</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="pull-left">You have full control to manage your own account settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="tabbed-card">
                            <ul class="pull-right nav nav-tabs border-tab nav-primary" id="top-tab2" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="profile-top-tab2" data-bs-toggle="tab" href="#top-profile2" role="tab" aria-controls="top-profile2" aria-selected="true" data-bs-original-title="" title=""><i class="icofont icofont-man-in-glasses"></i>General Data</a></li>
                                <li class="nav-item"><a class="nav-link" id="contact-top-tab2" data-bs-toggle="tab" href="#top-contact2" role="tab" aria-controls="top-contact2" aria-selected="false" data-bs-original-title="" title=""><i class="icofont icofont-contacts"></i>Change Password</a></li>
                            </ul>
                            <div class="tab-content" id="top-tabContent2">

                                <div class="tab-pane fade active show" id="top-profile2" role="tabpanel" aria-labelledby="profile-top-tab">
                                    <form novalidate="" class="theme-form needs-validation" id="form2" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                                          action="{{ url("api/admin/employee/register") }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                                        <input type="hidden" name="id" value="">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group">

                                            <div class="row">

                                                <div class="col-6 mb-3">
                                                    <label for="GenderEnum">{{ __("attributes.GenderEnum") }}</label>
                                                    <select name="GenderEnum" class="col-12" id="GenderEnum"></select>
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="name">{{ __("attributes.name") }}</label>
                                                    <input class="form-control" name="name" id="name" type="text" placeholder="ex: fathy, ahmed" />
                                                </div>

                                                <div class="col-6 mb-3 input-group-square">
                                                    <label for="phone">{{ __("attributes.phone") }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><select  name="country_id" class="col-sm-12" id="country_id"></select></span>
                                                        </div>
                                                        <input class="form-control" name="phone" id="phone" type="number" placeholder="ex: 114xxxxxxxxxx">
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="email">{{ __("attributes.email") }}</label>
                                                    <input class="form-control" name="email" id="email" type="email" placeholder="ex: example@ex.com"  disabled/>
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="AdminStatusEnum">{{ __("attributes.AdminStatusEnum") }}</label>
                                                    <input class="form-control" name="AdminStatusEnum" id="AdminStatusEnum" type="text" value="" disabled/>
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="AdminRoleEnum">{{ __("attributes.AdminRoleEnum") }}</label>
                                                    <input class="form-control" name="AdminRoleEnum" id="AdminRoleEnum" type="text" value="" disabled/>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="national_id">{{ __("attributes.national_id") }}</label>
                                                    <input class="form-control" name="national_id" id="national_id" type="number" placeholder="ex: 294***********" />
                                                </div>

                                                <div class="col-sm-12 mb-3 fileUploadBuilder">
                                                    <label for="flag">{{ __("attributes.image") }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button class="btn btn-primary btn-block" onclick="submitForm(this)" type="button">{{ __("lang.update") }}</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="top-contact2" role="tabpanel" aria-labelledby="contact-top-tab">
                                    <form novalidate="" class="theme-form needs-validation" id="form2" method="POST" authorization="{{session("admin_data")["jwtToken"]}}"
                                          action="{{ url("api/admin/auth/change-password") }}" locale="{{session("locale")}}" csrf="{{ csrf_token()}}">
                                        <input type="hidden" name="id" value="">
                                            <div class="row">

                                                <div class="col-12 form-group mb-3">
                                                    <label for="currentPassword">Current Password</label>
                                                    <input class="form-control" id="currentPassword" type="password" name="currentPassword" placeholder="*********" required/>
                                                    <div class="show-hide"><span class="show"></span></div>
                                                </div>

                                                <div class="col-6 form-group mb-3">
                                                    <label for="password">Password</label>
                                                    <input class="form-control" id="password" type="password" name="password" placeholder="*********" required/>
                                                    <div class="show-hide"><span class="show"></span></div>
                                                </div>
                                                <div class="col-6 form-group mb-3">
                                                    <label for="password_confirmation">Password confirmation</label>
                                                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="*********" required/>
                                                    <div class="show-hide"><span class="show"></span></div>
                                                </div>

                                            </div>

                                            <div class="form-group mb-0">
                                                <button class="btn btn-primary btn-block" onclick="submitForm(this)" type="button">{{ __("lang.update") }}</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script>

        $(document).ready(function() {

            //Get countries
            $.ajax({
                url: APP_URL + "/api/admin/setting/country?where=ActiveEnum:active",
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
                    let countries = "";
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

            //get admin gender enums
            $.ajax({
                url: APP_URL + "/api/web-services/enums/gender-status",
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
                    let genders = "";
                    for (const i in data) genders += `<option value="${data[i].key}" ">${data[i].translate}</option>`;
                    $("#GenderEnum").append(genders);

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
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



            //Get admin data
            setTimeout(getAdminData, 0);
        });


        function getAdminData() {
            $.ajax({
                url: APP_URL + "/api/admin/employee/register?id="+{{session("admin_data")["id"]}},
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
                    $("[name=id]").val(data.id);
                    $("[name=name]").val(data.name);
                    $("[name=GenderEnum]").val(data.GenderEnum.key);
                    $("[name=phone]").val(data.phone);
                    $("[name=email]").val(data.email);
                    $("[name=country_id]").val(data.country.id);
                    $("[name=AdminRoleEnum]").val(data.AdminRoleEnum.translate);
                    $("[name=AdminStatusEnum]").val(data.AdminStatusEnum.translate);
                    $("[name=national_id]").val(data.national_id);
                    fileUploadBuilder($(".fileUploadBuilder"), "image", data.image, false, "image/*");

                },
                error: function(xhr, status, error) {
                    let title = "Some thing went wrong";
                    let message = xhr.responseText || "Unknown error";
                    notifyForm(title, message, "danger");
                }
            })
        }

    </script>
@endsection
