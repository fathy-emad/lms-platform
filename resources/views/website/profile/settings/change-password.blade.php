@extends('website.profile.settings.settings')
@section('sub_title')
    {{ __("lang.change_password") }}
@endsection
@section('section_form')
    <form novalidate="" class="theme-form needs-validation" id="form" method="POST" action="{{ url("api/student/auth/change-password") }}"
              authorization="{{session("student_data")["jwtToken"] ?? ''}}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
        <input type="hidden" name="id" value="{{ auth("student")->user()->id }}">
        <div class="checkout-form settings-wrap">
            <div class="row">
                <div class="col-md-6">

                    <div class="input-block">
                        <label class="form-control-label">{{ __("attributes.current_password") }}</label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-input" value="" name="currentPassword"
                                   id="currentPassword" required>
                            <span class="feather-eye-off toggle-password"></span>
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="form-control-label">{{ __("attributes.password") }}</label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-input" value="" name="password"
                                   id="password" required>
                            <span class="feather-eye-off toggle-password"></span>
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="form-control-label">{{ __("attributes.password_confirmation") }}</label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-input" value="" name="password_confirmation"
                                   id="password_confirmation">
                            <span class="feather-eye-off toggle-password"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary btn-block" type="button" onclick="submitForm(this, null, successCallback)">{{__("lang.change_password")}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('sub_script')
    <script>
        let successCallback = function (){
            location.reload();
        }
    </script>
@endsection
