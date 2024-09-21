@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.teacher_profile") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.teacher_profile") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.teacher_profile") }}
        @endslot
    @endcomponent

    @php
        $teacher = \App\Models\Teacher::where("TeacherStatusEnum", \App\Enums\TeacherStatusEnum::Active->value)
        ->find(request("teacher_id"));
    @endphp

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">

            @if(isset($teacher))
                <div class="row">

                    @component('website_layouts.components.sidebar_teacher', ["teacher" => $teacher])@endcomponent

                    <!-- Instructor profile -->
                    <div class="col-xl-9 col-lg-9">

                        <div class="settings-widget card-details mb-0">
                            <div class="settings-menu p-0">
                                <div class="profile-heading">
                                    <h3>{{ __("lang.teacher_profile") }}</h3>
                                </div>
                                <div class="checkout-form personal-address">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="contact-info">
                                                <h6>{{ __("lang.name") }}</h6>
                                                <p>{{ $teacher->prefix->title() ."/ ". $teacher->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="contact-info">
                                                <h6>{{ __("lang.gender") }}</h6>
                                                <p>{{ $teacher->GenderEnum->title() }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="contact-info">
                                                <h6>{{ __("lang.stage") }}</h6>
                                                <p>{{ $teacher->stage->stageTranslate->translates[app()->getLocale()] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="contact-info">
                                                <h6>{{ __("lang.subject") }}</h6>
                                                <p>{{ $teacher->subject->subjectTranslate->translates[app()->getLocale()] }}</p>
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="contact-info">
                                                <h6>{{ __("lang.country") }}</h6>
                                                <p>{{ $teacher->country->countryTranslate->translates[app()->getLocale()] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="contact-info">
                                                <h6>{{ __("lang.email") }}</h6>
                                                <p>{{ $teacher->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="contact-info mb-0">
                                                <h6>{{ __("lang.bio") }}</h6>
                                                <p> {{ $teacher->bio ?? "" }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Instructor profile -->

                </div>
            @else
                @include("website_layouts.components.errors.coming_soon")
            @endif


        </div>
    </div>
    <!-- /Page Content -->
@endsection
