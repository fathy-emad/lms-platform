@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.settings") }} - @yield('sub_title') @endsection
@section('style')
    <style>
        /* Hide the arrow of the number input */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Disable the mouse wheel */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            /* Disable mouse wheel */
            -moz-appearance: textfield;
            -webkit-appearance: none;
            appearance: textfield;
        }

        input[type=number] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
            appearance: textfield;
            /* Disable mouse wheel on focus */
            overflow: hidden;
        }

    </style>
@endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.settings") }}
        @endslot
        @slot('item1')
            {{ __("lang.profile") }}
        @endslot
        @slot('item2')
            @yield('sub_title')
        @endslot
    @endcomponent
    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

                @component('website_layouts.components.sidebar') @endcomponent

                <!-- Student Settings -->
                <div class="col-xl-9 col-lg-9">

                    <div class="settings-widget card-details">
                        <div class="settings-menu p-0">
                            <div class="profile-heading">
                                <h3>{{ __("lang.settings") }}</h3>
                                <p>You have full control to manage your own account settings</p>
                            </div>
                            <div class="settings-page-head">
                                <ul class="settings-pg-links">
                                    <li><a href="{{ Route('student.profile.settings.edit-profile') }}"
                                           class="{{ Route::is('student.profile.settings.edit-profile') ? "active" : "" }}"><i class="bx bx-edit"></i>
                                            {{__("lang.edit_profile")}}
                                        </a>
                                    </li>
                                    <li><a href="{{ url('student-change-password') }}"><i class="bx bx-lock"></i>{{__("lang.change_password")}}</a></li>
                                    <li><a href="{{ url('student-social-profile') }}"><i class="bx bx-user-circle"></i>{{__("lang.change_email")}}</a></li>
                                    <li><a href="{{ url('student-notifications') }}"><i class="bx bx-bell"></i>{{__("lang.notifications")}}</a></li>
                                </ul>
                            </div>

                            @yield('section_form')
                        </div>
                    </div>
                </div>
                <!-- /Student Settings -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection

@section('script')
    @yield('sub_script')
@endsection
