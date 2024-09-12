@extends('website.profile.settings.settings')
@section('sub_title')
    {{ __("lang.edit_profile") }}
@endsection
@php
    $student = auth("student")->user();
    $image = isset($student->image["file"]) ? 'uploads/' . $student->image["file"] : 'build/img/user/user16.jpg';
    $image_key =  $student->image["key"] ?? '';
@endphp
@section('section_form')
    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
          action="{{ url("api/student/register") }}"
          authorization="{{session("student_data")["jwtToken"] ?? ''}}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
        <input type="hidden" name="id" value="{{ $student->id }}">
        <input type="hidden" name="_method" value="PUT">
        <div class="course-group profile-upload-group mb-0 d-flex">
            <div class="course-group-img profile-edit-field d-flex align-items-center">
                <a href="#" class="profile-pic"><img id="image_view" src="{{ URL::asset($image) }}" alt="Img" class="img-fluid"></a>
                <div class="profile-upload-head">
                    <h4><a href="{{ url('student-profile') }}">{{__("lang.your_pic")}}</a></h4>
                    <p>PNG or JPG no bigger than 800px width and height</p>
                    <div class="new-employee-field">
                        <div class="d-flex align-items-center mt-2">
                            <div class="image-upload mb-0">
                                <input type="hidden" id="image_key" name="image[key]" value="{{ $image_key }}">
                                <input type="file" name="image[file]" id="image_file">
                                <div class="image-uploads">
                                    <i class="bx bx-cloud-upload"></i>
                                </div>
                            </div>
                            <div class="img-delete" id="image_remove">
                                <a href="#" role="button" class="delete-icon"><i class="bx bx-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-form settings-wrap">
            <div class="edit-profile-info">
                <h5>{{ __("lang.personal_details") }}</h5>
                <p>{{ __("lang.edit_your_personal_information") }}</p>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="input-block">
                        <label class="form-label">{{ __("attributes.name") }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $student->name }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-block">
                        <label class="form-control-label">{{ __("attributes.email") }}</label>
                        <input type="email" name="email" class="form-control" value="{{$student->email}}" placeholder="Enter your email address">
                        <div id="" class="text-primary">{{ __("lang.email_note") }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-block">
                            <label class="add-course-label">{{ __("attributes.country") }}</label>
                            @php $countries = \App\Models\Country::with("countryTranslate")->get(); @endphp
                            <select class="form-control form-select" name="country_id" style="border-color: rgba(255, 222, 218, 0.71);">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{ $country->id == $student->country->id ? "selected" : "" }}>{{$country->countryTranslate->translates[app()->getLocale()]}} ({{ $country->phone_prefix  }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block">
                            <label class="form-control-label">{{ __("attributes.phone") }}</label>
                            <input type="number" name="phone" step="1" maxlength="10" id="phone" value="{{$student->phone}}"  minlength="10" class="form-control" placeholder="Please enter your phone" required/>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-block">
                        <label class="add-course-label">{{ __("attributes.gender") }}</label>
                        <select class="form-control form-select" name="GenderEnum" style="border-color: rgba(255, 222, 218, 0.71);" required>
                            @foreach(\App\Enums\GenderEnum::cases() as $gender)
                                <option value="{{$gender->value}}" {{ $student->GenderEnum == $gender ? "selected" : "" }}>{{ __("enum.GenderEnum.".$gender->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-block">
                        <label class="form-label">{{ __("attributes.born") }}</label>
                        <div class="datepicker-icon">
                                <span class="form-icon">
                                    <i class="bx bx-calendar"></i>
                                </span>
                            <input type="text" name="born" class="form-control datetimepicker" value="{{ \Carbon\Carbon::createFromFormat('d/m/Y', $student->born)->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-block">
                        <label class="form-control-label">{{ __("attributes.school") }}</label>
                        <input type="text" class="form-control" name="school" value="{{$student->school}}" placeholder="Enter your Full Name" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary btn-block" type="button" onclick="submitForm(this, null, successCallback)">{{__("lang.save")}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('sub_script')
    <script>
        $("#image_file").on("change", function (event) {
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#image_view").attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
            $("#image_key").val('');
        });

        $("#image_remove").on("click", function () {

            let image_key_value = "{{$image_key}}";
            let image_key = $("#image_key");

            if(image_key.val().length > 0 && image_key_value.length > 0)
            {
                console.log("ddd");
                image_key.val("");
                $("#image_view").attr('src', "{{URL::asset('build/img/user/user16.jpg')}}");

            } else if(image_key.val().length === 0 && image_key_value.length > 0)
            {
                image_key.val(image_key_value);
                $("#image_view").attr('src', "{{URL::asset($image)}}");
            }
            $("#image_file").val("");
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

        let successCallback = function () {

            location.reload();
        };
    </script>
@endsection
