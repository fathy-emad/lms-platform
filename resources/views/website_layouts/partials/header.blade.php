<!-- Header - page -->
@if (!Route::is([
        'instructor-list',
        'instructor-grid',
        'instructor-dashboard',
        'instructor-profile',
        'instructor-course',
        'instructor-wishlist',
        'instructor-reviews',
        'instructor-quiz',
        'instructor-orders',
        'instructor-qa',
        'instructor-referral',
        'instructor-chat',
        'instructor-tickets',
        'instructor-notifications',
        'instructor-settings',
        'students-list',
        'students-grid',
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
        'instructor-enrolled-course',
        'instructor-announcements',
        'instructor-withdraw',
        'instructor-quiz-attempts',
        'instructor-assignment',
        'instructor-earnings',
        'instructor-change-password',
        'instructor-setting-notifications',
        'instructor-setting-withdraw',
        'instructor-delete-account',
        'student-change-password',
        'student-setting-notifications',
        'student-setting-social-profile',
        'student-linked-accounts',
        'notifications',
        'pricing-plan',
        'wishlist',
        'course-list',
        'course-grid',
        'course-details',
        'faq',
        'support',
        'job-category',
        'cart',
        'checkout',
        'blog-list',
        'blog-grid',
        'blog-masonry',
        'blog-modern',
        'blog-details',
        'instructor-quiz-details',
        'student-quiz-details',
        'instructor-quiz-attempts-details',
        'add-course',
        'course-lesson',
        'help-center',
        'instructor-edit',
        'privacy-policy',
        'setting-student-subscription',
        'student-notifications',
        'student-social-profile',
        'term-condition',
    ]))
    <header class="header">
@endif
@if (Route::is([
        'instructor-list',
        'instructor-grid',
        'instructor-dashboard',
        'instructor-profile',
        'instructor-course',
        'instructor-wishlist',
        'instructor-reviews',
        'instructor-quiz',
        'instructor-orders',
        'instructor-qa',
        'instructor-referral',
        'instructor-chat',
        'instructor-tickets',
        'instructor-notifications',
        'instructor-settings',
        'students-list',
        'students-grid',
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
        'instructor-enrolled-course',
        'instructor-announcements',
        'instructor-withdraw',
        'instructor-quiz-attempts',
        'instructor-assignment',
        'instructor-earnings',
        'instructor-change-password',
        'instructor-setting-notifications',
        'instructor-setting-withdraw',
        'instructor-delete-account',
        'student-change-password',
        'student-setting-notifications',
        'student-setting-social-profile',
        'student-linked-accounts',
        'notifications',
        'pricing-plan',
        'wishlist',
        'course-list',
        'course-grid',
        'course-details',
        'faq',
        'support',
        'job-category',
        'cart',
        'checkout',
        'blog-list',
        'blog-grid',
        'blog-masonry',
        'blog-modern',
        'blog-details',
        'instructor-quiz-details',
        'student-quiz-details',
        'instructor-quiz-attempts-details',
        'add-course',
        'course-lesson',
        'help-center',
        'instructor-edit',
        'privacy-policy',
        'setting-student-subscription',
        'student-notifications',
        'student-social-profile',
        'term-condition',
    ]))
    <header class="header header-page">
@endif

<div class="header-fixed">
    <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
        <div class="container">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('student.website') }}" class="navbar-brand logo">
                    <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route('student.website') }}" class="menu-logo">
                        <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li class="has-submenu active"><a class="" href="#">Home</a></li>
                    <li class="has-submenu">
                        <a href="#">Category <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li class="has-submenu">
                                <a href="" class="">Instructor</a>
                                <ul class="submenu">
                                    <li class=""><a href="">List</a></li>
                                    <li class=""><a href="">Grid</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="{{ url('instructor-dashboard') }}">Dashboard</a></li>
                            <li class=""><a href="{{ url('instructor-profile') }}">My Profile</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu {{ Request::is('blog-list', 'blog-grid', 'blog-masonry', 'blog-modern', 'blog-details') ? 'active' : '' }}">
                        <a href="#">Blog <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li class="{{ Request::is('blog-list') ? 'active' : '' }}"><a
                                    href="{{ url('blog-list') }}">Blog List</a></li>
                            <li class="{{ Request::is('blog-grid') ? 'active' : '' }}"><a
                                    href="{{ url('blog-grid') }}">Blog Grid</a></li>
                            <li class="{{ Request::is('blog-masonry') ? 'active' : '' }}"><a
                                    href="{{ url('blog-masonry') }}">Blog Masonry</a></li>
                            <li class="{{ Request::is('blog-modern') ? 'active' : '' }}"><a
                                    href="{{ url('blog-modern') }}">Blog Modern</a></li>
                            <li class="{{ Request::is('blog-details') ? 'active' : '' }}"><a
                                    href="{{ url('blog-details') }}">Blog Details</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"> {{ __("lang.language") }} <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li class="{{ app()->getLocale() == "ar" ? 'active' : '' }}"><a href="{{ route('lang', 'ar')}}">AR (العربية)</a></li>
                            <li class="{{ app()->getLocale() !== "ar" ? 'active' : '' }}"><a href="{{ route('lang', 'en')}}">EN (English)</a></li>
                        </ul>
                    </li>
                    <li class="login-link"><a href="{{ url('login') }}">Login / Signup</a></li>
                </ul>
            </div>
            <ul class="nav header-navbar-rht">

                @if(! session("student_data"))
                    <li class="nav-item">
                        <div>
                            <a href="#" id="dark-mode-toggle" class="dark-mode-toggle  ">
                                <i class="fa-solid fa-moon"></i>
                            </a>
                            <a href="#" id="light-mode-toggle" class="dark-mode-toggle ">
                                <i class="fa-solid fa-sun"></i>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-sign" href="{{ route("student.auth.login") }}">Signin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-login" href="{{ route("student.auth.register") }}">Signup</a>
                    </li>
                @else
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ url('student-messages') }}"><img--}}
{{--                                src="{{ URL::asset('/build/img/icon/messages.svg') }}" alt="img"></a>--}}
{{--                    </li>--}}
                    <li class="nav-item cart-nav">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ URL::asset('/build/img/icon/cart.svg') }}" alt="img">
                        </a>
                        <div class="wishes-list dropdown-menu dropdown-menu-right">
                            <div class="wish-header">
                                <a href="#">View Cart</a>
                                <a href="javascript:void(0)" class="float-end">Checkout</a>
                            </div>
                            <div class="wish-content">
                                <ul>
                                    <li>
                                        <div class="media">
                                            <div class="d-flex media-wide">
                                                <div class="avatar">
                                                    <a href="{{ url('course-details') }}">
                                                        <img alt="Img"
                                                             src="{{ URL::asset('/build/img/course/course-04.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="{{ url('course-details') }}">Learn
                                                            Angular...</a></h6>
                                                    <p>By Dave Franco</p>
                                                    <h5>$200 <span>$99.00</span></h5>
                                                </div>
                                            </div>
                                            <div class="remove-btn">
                                                <a href="#" class="btn">Remove</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <div class="d-flex media-wide">
                                                <div class="avatar">
                                                    <a href="{{ url('course-details') }}">
                                                        <img alt="Img"
                                                             src="{{ URL::asset('/build/img/course/course-14.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="{{ url('course-details') }}">Build Responsive
                                                            Real...</a>
                                                    </h6>
                                                    <p>Jenis R.</p>
                                                    <h5>$200 <span>$99.00</span></h5>
                                                </div>
                                            </div>
                                            <div class="remove-btn">
                                                <a href="#" class="btn">Remove</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <div class="d-flex media-wide">
                                                <div class="avatar">
                                                    <a href="{{ url('course-details') }}">
                                                        <img alt="Img"
                                                             src="{{ URL::asset('/build/img/course/course-15.jpg') }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="{{ url('course-details') }}">C# Developers
                                                            Double ...</a>
                                                    </h6>
                                                    <p>Jesse Stevens</p>
                                                    <h5>$200 <span>$99.00</span></h5>
                                                </div>
                                            </div>
                                            <div class="remove-btn">
                                                <a href="#" class="btn">Remove</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="total-item">
                                    <h6>Subtotal : $ 600</h6>
                                    <h5>Total : $ 600</h5>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div>
                            <a href="#" id="dark-mode-toggle" class="dark-mode-toggle  ">
                                <i class="fa-solid fa-moon"></i>
                            </a>
                            <a href="#" id="light-mode-toggle" class="dark-mode-toggle ">
                                <i class="fa-solid fa-sun"></i>
                            </a>
                        </div>
                    </li>
{{--                    <li class="nav-item wish-nav">--}}
{{--                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">--}}
{{--                            <img src="{{ URL::asset('/build/img/icon/wish.svg') }}" alt="img">--}}
{{--                        </a>--}}
{{--                        <div class="wishes-list dropdown-menu dropdown-menu-right">--}}
{{--                            <div class="wish-content">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <div class="media">--}}
{{--                                            <div class="d-flex media-wide">--}}
{{--                                                <div class="avatar">--}}
{{--                                                    <a href="{{ url('course-details') }}">--}}
{{--                                                        <img alt="Img"--}}
{{--                                                             src="{{ URL::asset('/build/img/course/course-04.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6><a href="{{ url('course-details') }}">Learn--}}
{{--                                                            Angular...</a></h6>--}}
{{--                                                    <p>By Dave Franco</p>--}}
{{--                                                    <h5>$200 <span>$99.00</span></h5>--}}
{{--                                                    <div class="remove-btn">--}}
{{--                                                        <a href="#" class="btn">Add to cart</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="media">--}}
{{--                                            <div class="d-flex media-wide">--}}
{{--                                                <div class="avatar">--}}
{{--                                                    <a href="{{ url('course-details') }}">--}}
{{--                                                        <img alt="Img"--}}
{{--                                                             src="{{ URL::asset('/build/img/course/course-14.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6><a href="{{ url('course-details') }}">Build Responsive--}}
{{--                                                            Real...</a>--}}
{{--                                                    </h6>--}}
{{--                                                    <p>Jenis R.</p>--}}
{{--                                                    <h5>$200 <span>$99.00</span></h5>--}}
{{--                                                    <div class="remove-btn">--}}
{{--                                                        <a href="#" class="btn">Add to cart</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="media">--}}
{{--                                            <div class="d-flex media-wide">--}}
{{--                                                <div class="avatar">--}}
{{--                                                    <a href="{{ url('course-details') }}">--}}
{{--                                                        <img alt="Img"--}}
{{--                                                             src="{{ URL::asset('/build/img/course/course-15.jpg') }}">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6><a href="{{ url('course-details') }}">C# Developers--}}
{{--                                                            Double ...</a>--}}
{{--                                                    </h6>--}}
{{--                                                    <p>Jesse Stevens</p>--}}
{{--                                                    <h5>$200 <span>$99.00</span></h5>--}}
{{--                                                    <div class="remove-btn">--}}
{{--                                                        <a href="#" class="btn">Remove</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item noti-nav">--}}
{{--                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">--}}
{{--                            <img src="{{ URL::asset('/build/img/icon/notification.svg') }}" alt="img">--}}
{{--                        </a>--}}
{{--                        <div class="notifications dropdown-menu dropdown-menu-right">--}}
{{--                            <div class="topnav-dropdown-header">--}}
{{--                                <span class="notification-title">Notifications--}}
{{--                                    <select>--}}
{{--                                        <option>All</option>--}}
{{--                                        <option>Unread</option>--}}
{{--                                    </select>--}}
{{--                                </span>--}}
{{--                                <a href="javascript:void(0)" class="clear-noti">Mark all as read <i--}}
{{--                                        class="fa-solid fa-circle-check"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="noti-content">--}}
{{--                                <ul class="notification-list">--}}
{{--                                    <li class="notification-message">--}}
{{--                                        <div class="media d-flex">--}}
{{--                                            <div>--}}
{{--                                                <a href="{{ url('notifications') }}" class="avatar">--}}
{{--                                                    <img class="avatar-img" alt="Img"--}}
{{--                                                         src="{{ URL::asset('/build/img/user/user1.jpg') }}">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h6><a href="{{ url('notifications') }}">Lex Murphy requested--}}
{{--                                                        <span>access--}}
{{--                                                            to</span> UNIX directory tree hierarchy </a></h6>--}}
{{--                                                <button class="btn btn-accept">Accept</button>--}}
{{--                                                <button class="btn btn-reject">Reject</button>--}}
{{--                                                <p>Today at 9:42 AM</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="notification-message">--}}
{{--                                        <div class="media d-flex">--}}
{{--                                            <div>--}}
{{--                                                <a href="{{ url('notifications') }}" class="avatar">--}}
{{--                                                    <img class="avatar-img" alt="Img"--}}
{{--                                                         src="{{ URL::asset('/build/img/user/user2.jpg') }}">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h6><a href="{{ url('notifications') }}">Ray Arnold left 6--}}
{{--                                                        <span>comments--}}
{{--                                                            on</span> Isla Nublar SOC2 compliance report</a></h6>--}}
{{--                                                <p>Yesterday at 11:42 PM</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="notification-message">--}}
{{--                                        <div class="media d-flex">--}}
{{--                                            <div>--}}
{{--                                                <a href="{{ url('notifications') }}" class="avatar">--}}
{{--                                                    <img class="avatar-img" alt="Img"--}}
{{--                                                         src="{{ URL::asset('/build/img/user/user3.jpg') }}">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h6><a href="{{ url('notifications') }}">Dennis Nedry--}}
{{--                                                        <span>commented--}}
{{--                                                            on</span> Isla Nublar SOC2 compliance report</a></h6>--}}
{{--                                                <p class="noti-details">“Oh, I finished de-bugging the phones, but--}}
{{--                                                    the system's compiling for eighteen minutes, or twenty. So, some--}}
{{--                                                    minor systems may go on and off for a while.”</p>--}}
{{--                                                <p>Yesterday at 5:42 PM</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="notification-message">--}}
{{--                                        <div class="media d-flex">--}}
{{--                                            <div>--}}
{{--                                                <a href="{{ url('notifications') }}" class="avatar">--}}
{{--                                                    <img class="avatar-img" alt="Img"--}}
{{--                                                         src="{{ URL::asset('/build/img/user/user1.jpg') }}">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h6><a href="{{ url('notifications') }}">John Hammond--}}
{{--                                                        <span>created</span>--}}
{{--                                                        Isla Nublar SOC2 compliance report </a></h6>--}}
{{--                                                <p>Last Wednesday at 11:15 AM</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="nav-item user-nav">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img src="{{ URL::asset('/build/img/user/user11.jpg') }}" alt="Img">
                                <span class="status online"></span>
                            </span>
                        </a>
                        <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ URL::asset('/build/img/user/user11.jpg') }}" alt="User Image"
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ session("student_data")["name"] }}</h6>
                                    <p class="text-muted mb-0">{{ __("lang.student") }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ url('student-profile') }}"><i
                                    class="feather-user me-1"></i> Profile</a>
                            <a class="dropdown-item" href="{{ url('setting-student-subscription') }}"><i
                                    class="feather-star me-1"></i> Subscription</a>
                            <div class="dropdown-item night-mode">
                                <span><i class="feather-moon me-1"></i> Night Mode </span>
                                <div class="form-check form-switch check-on m-0">
                                    <input class="form-check-input" type="checkbox" id="night-mode">
                                </div>
                            </div>

                            <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                  action="{{ url("api/student/auth/logout") }}" authorization="{{ session("student_data")["jwtToken"] }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                <a class="dropdown-item" href="#" data-role="button" onclick="submitForm(this)"><i class="feather-log-out me-1"></i>{{ __('lang.logout') }}</a>
                            </form>

                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
</header>

<!-- /Header -->

