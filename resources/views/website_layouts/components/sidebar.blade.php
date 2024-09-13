<!-- sidebar -->
<div class="col-xl-3 col-lg-3 theiaStickySidebar">
    <div class="settings-widget dash-profile">
        <div class="settings-menu">
            <div class="profile-bg">
                <div class="profile-img">
                    <a href="{{ route('student.profile') }}"><img
                            src="{{ URL::asset(auth("student")?->user() ? "uploads/".auth("student")->user()->image["file"] : '/build/img/user/user11.jpg') }}"
                            alt="Img"></a>
                </div>
            </div>
            <div class="profile-group">
                <div class="profile-name text-center">
                    <h4><a href="{{ url('student.profile') }}">{{ auth("student")->user()->name }}</a></h4>
                    <p>{{ __("lang.student") }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <h3>{{ __("lang.profile") }}</h3>
            <ul>
                <li class="nav-item {{ Route::is('student.profile') ? 'active' : '' }}">
                    <a href="{{ route('student.profile') }}" class="nav-link">
                        <i class="bx bxs-tachometer"></i>{{ __("lang.my_info") }}
                    </a>
                </li>
                <li class="nav-item {{ Route::is('student.enrolled_courses') ? 'active' : '' }}">
                    <a href="{{ Route('student.enrolled_courses') }}" class="nav-link">
                        <i class="bx bxs-graduation"></i>{{ __("lang.enrolled_courses") }}
                    </a>
                </li>
                <li class="nav-item {{ Request::is('student.cart') ? 'active' : '' }}">
                    <a href="{{ route('student.cart') }}" class="nav-link">
                        <i class="bx bxs-cart"></i>{{ __("lang.cart") }}
                    </a>
                </li>
                <li class="nav-item {{ Request::is('student.invoices') ? 'active' : '' }}">
                    <a href="{{ route('student.invoices') }}" class="nav-link">
                        <i class="bx bxs-dollar-circle"></i>{{ __("lang.invoices") }}
                    </a>
                </li>
            </ul>
            <h3>{{ __("lang.account_settings") }}</h3>
            <ul>
                <li
                    class="nav-item {{ Route::is(
                        'student.profile.settings.edit-profile',
                        'student-change-password',
                        'student-setting-notifications',
                        'student-setting-social-profile',
                        'student-linked-accounts',
                        'student-notifications',
                        'setting-student-subscription',
                        'student-notifications',
                        'student-social-profile',
                    )
                        ? 'active'
                        : '' }}">
                    <a href="{{ Route('student.profile.settings.edit-profile') }}" class="nav-link ">
                        <i class="bx bxs-cog"></i>{{ __("lang.settings") }}
                    </a>
                </li>
                <li class="nav-item {{ Request::is('index') ? 'active' : '' }}">
                    <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                          action="{{ url("api/student/auth/logout") }}"
                          authorization="{{ session("student_data")["jwtToken"] }}" locale="{{app()->getLocale()}}"
                          csrf="{{ csrf_token()}}">
                        <a class="nav-link" role="button" onclick="submitForm(this)">
                            <i class="bx bxs-log-out"></i>{{ __("lang.logout") }}
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->

