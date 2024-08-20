@if (
    !Route::is([
        'setting-student-subscription',
        'student-dashboard',
        'student-profile',
        'student-courses',
        'student-wishlist',
        'student-reviews',
        'student-quiz',
        'student-order-history',
        'student-qa',
        'student-referral',
        'student-messages',
        'student-tickets',
        'student-settings',
        'student-change-password',
        'student-social-profile',
        'student-linked-accounts',
        'student-notifications',
        'student-quiz-details',
        'student-quiz-details',
    ]))
    <!-- Sidebar -->
    <div class="col-xl-3 col-lg-3 theiaStickySidebar">
        <div class="settings-widget dash-profile">
            <div class="settings-menu">
                <div class="profile-bg">
                    <div class="profile-img">
                        <a href="{{ url('instructor-profile') }}"><img
                                src="{{ URL::asset('/build/img/user/user-17.jpg') }}" alt="Img"></a>
                    </div>
                </div>
                <div class="profile-group">
                    <div class="profile-name text-center">
                        <h4><a href="{{ url('instructor-profile') }}">Eugene Andre</a></h4>
                        <p>Instructor</p>
                        <a href="{{ url('add-course') }}" class="add-course btn-primary">Add New Course</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="settings-widget account-settings">
            <div class="settings-menu">
                <h3>Dashboard</h3>
                <ul>
                    <li class="nav-item {{ Request::is('instructor-dashboard') ? 'active' : '' }}">
                        <a href="{{ url('instructor-dashboard') }}" class="nav-link">
                            <i class="bx bxs-tachometer"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-profile') ? 'active' : '' }}">
                        <a href="{{ url('instructor-profile') }}" class="nav-link">
                            <i class="bx bxs-user"></i>My Profile
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-enrolled-course') ? 'active' : '' }}">
                        <a href="{{ url('instructor-enrolled-course') }}" class="nav-link">
                            <i class="bx bxs-graduation"></i>Enrolled Courses
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-wishlist') ? 'active' : '' }}">
                        <a href="{{ url('instructor-wishlist') }}" class="nav-link">
                            <i class="bx bxs-heart"></i>Wishlist
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-reviews') ? 'active' : '' }}">
                        <a href="{{ url('instructor-reviews') }}" class="nav-link">
                            <i class="bx bxs-star"></i>Reviews
                        </a>
                    </li>
                    <li
                        class="nav-item {{ Request::is('instructor-quiz', 'instructor-quiz-details', 'instructor-quiz-attempts-details', 'instructor-quiz-attempts') ? 'active' : '' }}">
                        <a href="{{ url('instructor-quiz') }}" class="nav-link">
                            <i class="bx bxs-shapes"></i>My Quiz Attempts
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-orders') ? 'active' : '' }}">
                        <a href="{{ url('instructor-orders') }}" class="nav-link">
                            <i class="bx bxs-cart"></i>Order History
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-qa') ? 'active' : '' }}">
                        <a href="{{ url('instructor-qa') }}" class="nav-link">
                            <i class="bx bxs-bookmark-alt"></i>Question & Answer
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-referral') ? 'active' : '' }}">
                        <a href="{{ url('instructor-referral') }}" class="nav-link">
                            <i class="bx bxs-user-plus"></i>Referrals
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-chat') ? 'active' : '' }}">
                        <a href="{{ url('instructor-chat') }}" class="nav-link">
                            <i class="bx bxs-chat"></i>Messages
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-notifications') ? 'active' : '' }}">
                        <a href="{{ url('instructor-notifications') }}" class="nav-link">
                            <i class="bx bxs-bell"></i>Notifications
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-tickets') ? 'active' : '' }}">
                        <a href="{{ url('instructor-tickets') }}" class="nav-link">
                            <i class="bx bxs-coupon"></i>Support Tickets
                        </a>
                    </li>
                </ul>
                <h3>Instructor</h3>
                <ul>
                    <li class="nav-item {{ Request::is('instructor-course') ? 'active' : '' }}">
                        <a href="{{ url('instructor-course') }}" class="nav-link ">
                            <i class="bx bxs-rocket"></i>My Courses
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-announcements') ? 'active' : '' }}">
                        <a href="{{ url('instructor-announcements') }}" class="nav-link">
                            <i class="bx bxs-volume-full"></i>Announcements
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-withdraw') ? 'active' : '' }}">
                        <a href="{{ url('instructor-withdraw') }}" class="nav-link ">
                            <i class="bx bxs-wallet"></i>Withdrawls
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-quiz-attempts') ? 'active' : '' }}">
                        <a href="{{ url('instructor-quiz-attempts') }}" class="nav-link">
                            <i class="bx bxs-shapes"></i>Quiz Attempts
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-assignment') ? 'active' : '' }}">
                        <a href="{{ url('instructor-assignment') }}" class="nav-link ">
                            <i class="bx bxs-file"></i>Assignments
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('instructor-earnings') ? 'active' : '' }}">
                        <a href="{{ url('instructor-earnings') }}" class="nav-link">
                            <i class="bx bxs-badge-dollar"></i>Earnings
                        </a>
                    </li>
                </ul>
                <h3>Account Settings</h3>
                <ul>
                    <li
                        class="nav-item {{ Request::is('instructor-settings', 'instructor-change-password', 'instructor-setting-notifications', 'instructor-setting-withdraw', 'instructor-delete-account') ? 'active' : '' }}">
                        <a href="{{ url('instructor-settings') }}" class="nav-link ">
                            <i class="bx bxs-cog"></i>Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('index') }}" class="nav-link">
                            <i class="bx bxs-log-out"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
@endif
@if (Route::is([
        'setting-student-subscription',
        'student-dashboard',
        'student-profile',
        'student-courses',
        'student-wishlist',
        'student-reviews',
        'student-quiz',
        'student-order-history',
        'student-qa',
        'student-referral',
        'student-messages',
        'student-tickets',
        'student-settings',
        'student-change-password',
        'student-social-profile',
        'student-linked-accounts',
        'student-notifications',
        'student-quiz-details',
        'student-quiz-details',
    ]))
    <!-- sidebar -->
    <div class="col-xl-3 col-lg-3 theiaStickySidebar">
        <div class="settings-widget dash-profile">
            <div class="settings-menu">
                <div class="profile-bg">
                    <div class="profile-img">
                        <a href="{{ url('student-profile') }}"><img
                                src="{{ URL::asset('/build/img/user/user16.jpg') }}" alt="Img"></a>
                    </div>
                </div>
                <div class="profile-group">
                    <div class="profile-name text-center">
                        <h4><a href="{{ url('student-profile') }}">Rolands Richard</a></h4>
                        <p>Student</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="settings-widget account-settings">
            <div class="settings-menu">
                <h3>Dashboard</h3>
                <ul>
                    <li class="nav-item {{ Request::is('student-dashboard') ? 'active' : '' }}">
                        <a href="{{ url('student-dashboard') }}" class="nav-link">
                            <i class="bx bxs-tachometer"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-profile') ? 'active' : '' }}">
                        <a href="{{ url('student-profile') }}" class="nav-link">
                            <i class="bx bxs-user"></i>My Profile
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-courses') ? 'active' : '' }}">
                        <a href="{{ url('student-courses') }}" class="nav-link">
                            <i class="bx bxs-graduation"></i>Enrolled Courses
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-wishlist') ? 'active' : '' }}">
                        <a href="{{ url('student-wishlist') }}" class="nav-link">
                            <i class="bx bxs-heart"></i>Wishlist
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-reviews') ? 'active' : '' }}">
                        <a href="{{ url('student-reviews') }}" class="nav-link">
                            <i class="bx bxs-star"></i>Reviews
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-quiz', 'student-quiz-details') ? 'active' : '' }}">
                        <a href="{{ url('student-quiz') }}" class="nav-link">
                            <i class="bx bxs-shapes"></i>My Quiz Attempts
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-order-history') ? 'active' : '' }}">
                        <a href="{{ url('student-order-history') }}" class="nav-link">
                            <i class="bx bxs-cart"></i>Order History
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-qa') ? 'active' : '' }}">
                        <a href="{{ url('student-qa') }}" class="nav-link">
                            <i class="bx bxs-bookmark-alt"></i>Question & Answer
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-referral') ? 'active' : '' }}">
                        <a href="{{ url('student-referral') }}" class="nav-link">
                            <i class="bx bxs-user-plus"></i>Referrals
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-messages') ? 'active' : '' }}">
                        <a href="{{ url('student-messages') }}" class="nav-link">
                            <i class="bx bxs-chat"></i>Messages
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('student-tickets') ? 'active' : '' }}">
                        <a href="{{ url('student-tickets') }}" class="nav-link">
                            <i class="bx bxs-coupon"></i>Support Tickets
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
@endif
