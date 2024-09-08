<!-- sidebar -->
<div class="col-xl-3 col-lg-3 theiaStickySidebar">
    <div class="settings-widget dash-profile">
        <div class="settings-menu">
            <div class="profile-bg">
                <div class="profile-img">
                    <a href="{{ route('student.profile') }}"><img
                            src="{{ URL::asset("uploads/".auth("student")->user()->image["file"] ?: '/build/img/user/user11.jpg') }}" alt="Img"></a>
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
            </ul>
            <h3>Account Settings</h3>
            <ul>
                <li
                    class="nav-item {{ Request::is(
                        'student-settings',
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
                    <a href="{{ url('student-settings') }}" class="nav-link ">
                        <i class="bx bxs-cog"></i>Settings
                    </a>
                </li>
                <li class="nav-item {{ Request::is('index') ? 'active' : '' }}">
                    <a href="{{ url('index') }}" class="nav-link">
                        <i class="bx bxs-log-out"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->

