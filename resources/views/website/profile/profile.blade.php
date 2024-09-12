@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.profile") }} @endsection
@section('style')
@endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.profile") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.my_info") }}
        @endslot
    @endcomponent


    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

                @component('website_layouts.components.sidebar') @endcomponent

                <!-- Student Profile -->
                <div class="col-xl-9 col-lg-9">

                    <div class="settings-widget card-details mb-0">
                        <div class="settings-menu p-0">
                            <div class="profile-heading">
                                <h3>{{ __("lang.my_info") }}</h3>
                            </div>
                            <div class="checkout-form personal-address">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.name") }}</h6>
                                            <p>{{ auth("student")->user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.email") }}</h6>
                                            <p>{{ auth("student")->user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.phone") }}</h6>
                                            <p>({{ auth("student")->user()->country->phone_prefix }}) {{ auth("student")->user()->phone }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.gender") }}</h6>
                                            <p>{{ auth("student")->user()->GenderEnum->title() }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.school") }}</h6>
                                            <p>{{ auth("student")->user()->school }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.status") }}</h6>
                                            <p>{{ auth("student")->user()->StudentStatusEnum->title() }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="contact-info">
                                            <h6>{{ __("lang.born") }}</h6>
                                            <p>{{ auth("student")->user()->born }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Profile -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
