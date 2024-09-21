<!-- sidebar -->
<div class="col-xl-3 col-lg-3 theiaStickySidebar">
    <div class="settings-widget dash-profile">
        <div class="settings-menu">
            <div class="profile-bg">
                <div class="profile-img">
                    <a href="{{ route('student.teacher.profile', ["teacher_id" => $teacher->id]) }}"><img
                            src="{{ URL::asset( isset($teacher->image["file"]) ? "uploads/".$teacher->image["file"] : '/build/img/user/user11.jpg') }}"
                            alt="Img"></a>
                </div>
            </div>
            <div class="profile-group">
                <div class="profile-name text-center">
                    <h4><a href="{{ route('student.teacher.profile', ["teacher_id" => $teacher->id]) }}">
                            {{ $teacher->prefix->title()."/". $teacher->name }}</a></h4>
                    <p>{{ __("lang.teacher") }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <h3>{{ __("lang.profile") }}</h3>
            <ul>
                <li class="nav-item {{ Route::is('student.teacher.profile') ? 'active' : '' }}">
                    <a href="{{ route('student.teacher.profile', ["teacher_id" => $teacher->id]) }}" class="nav-link">
                        <i class="bx bxs-tachometer"></i>{{ __("lang.teacher_profile") }}
                    </a>
                </li>
                <li class="nav-item {{ Route::is('student.teacher.courses') ? 'active' : '' }}">
                    <a href="{{ Route('student.teacher.courses', ["teacher_id" => $teacher->id]) }}" class="nav-link">
                        <i class="bx bxs-graduation"></i>{{ __("lang.teacher_courses") }}
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->

