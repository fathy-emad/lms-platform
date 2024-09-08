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
        'student.profile',
        'student.enrolled_courses',
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
        'student.courses',
        'student.course',
        'faq',
        'support',
        'student.curricula',
        'student.cart',
        'student.checkout',
        'blog-list',
        'blog-grid',
        'blog-masonry',
        'blog-modern',
        'blog-details',
        'instructor-quiz-details',
        'student-quiz-details',
        'instructor-quiz-attempts-details',
        'add-course',
        'student.lesson',
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
        'student.profile',
        'student.enrolled_courses',
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
        'student.courses',
        'student.course',
        'faq',
        'support',
        'student.curricula',
        'student.cart',
        'student.checkout',
        'blog-list',
        'blog-grid',
        'blog-masonry',
        'blog-modern',
        'blog-details',
        'instructor-quiz-details',
        'student-quiz-details',
        'instructor-quiz-attempts-details',
        'add-course',
        'student.lesson',
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
                    <li class="has-submenu active"><a class="" href="{{ route("student.website") }}">{{ __("lang.home") }}</a></li>
                    <li class="has-submenu">
                        <a href="#">{{ __("lang.curricula") }} <i class="fas fa-chevron-down"></i></a>
                        @php
                            $stages = \App\Models\Stage::with(['years' => function($query) {
                                                            $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
                                                                  ->with('yearTranslate');
                                                        }])
                                                        ->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
                                                        ->orderBy('priority', 'asc')
                                                        ->get();
                        @endphp
                        <ul class="submenu">
                            @foreach($stages as $stage)
                                <li class="has-submenu">
                                    <a href="#" class="">{{ $stage->stageTranslate->translates[app()->getLocale()] }}</a>
                                    @if($stage->years->count())
                                        <ul class="submenu">
                                            @foreach($stage->years as $year)
                                                <li class=""><a href="{{ route("student.curricula", ["year_id" => $year->id]) }}">{{ $year->yearTranslate->translates[app()->getLocale()] }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

{{--                            <li class="has-submenu">--}}
{{--                                <a href="" class="">Instructor</a>--}}
{{--                                <ul class="submenu">--}}
{{--                                    <li class=""><a href="">List</a></li>--}}
{{--                                    <li class=""><a href="">Grid</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class=""><a href="{{ url('instructor-dashboard') }}">Dashboard</a></li>--}}
{{--                            <li class=""><a href="{{ url('instructor.profile') }}">My Profile</a></li>--}}
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
                    @if(!auth("student")->user())
                        <li class="login-link"><a href="{{ route('student.auth.login') }}">{{ __("lang.login") }} / {{ __("lang.register") }}</a></li>
                    @else
                        <li class="login-link"><a href="{{ route('student.cart') }}">{{ __("lang.cart") }}</a></li>
                        <li class="login-link"><a href="{{ route('student.profile') }}"><i class="feather-home"></i>{{ __("lang.profile") }}</a></li>
                        <li class="login-link">
                            <form id="form" method="POST"
                                  action="{{ url("api/student/auth/logout") }}" authorization="{{ session("student_data")["jwtToken"] }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                <a class="text-white p-3" href="#" onclick="submitForm(this)">{{ __("lang.logout") }}</a>
                            </form>
                        </li>
                    @endif
                    <li class="login-link">
                        <div class="row justify-content-start p-3">
                            <div class="col-6">
                                <a href="#" id="dark-mode-toggle-mobile" class="dark-mode-toggle"><i class="fa-solid fa-moon"></i></a>
                            </div>
                            <div class="col-6">
                                <a href="#" id="light-mode-toggle-mobile" class="dark-mode-toggle"><i class="fa-solid fa-sun"></i></a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <ul class="nav header-navbar-rht">

                @if(!auth("student")->user())
                    <li class="nav-item">
                        <div>
                            <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                                <i class="fa-solid fa-moon"></i>
                            </a>
                            <a href="#" id="light-mode-toggle" class="dark-mode-toggle">
                                <i class="fa-solid fa-sun"></i>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-sign" href="{{ route("student.auth.login") }}">{{ __("lang.login") }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-login" href="{{ route("student.auth.register") }}">{{ __("lang.register") }}</a>
                    </li>
                @else
                    <li class="nav-item cart-nav">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ URL::asset('/build/img/icon/cart.svg') }}" alt="img">
                        </a>
                        <div class="wishes-list dropdown-menu dropdown-menu-right">
                            <div class="wish-header">
                                <a href="{{ route("student.cart") }}">{{ __("lang.view_cart") }}</a>
                                <a href="javascript:void(0)" class="float-end">{{ __("lang.checkout") }}</a>
                            </div>
                            <div class="wish-content">
                                @php $total = 0 @endphp
                                @if(auth("student")->user()->carts)
                                    <ul>
                                        @foreach(auth("student")->user()->carts as $item)
                                            @php $total += $item->course->cost["course"]; @endphp
                                            <li>
                                                <div class="media">
                                                    <div class="d-flex media-wide">
                                                        <div class="avatar">
                                                            <a href="#">
                                                                <img alt="Img"
                                                                     src="{{ URL::asset('/build/img/course/course-04.jpg') }}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6><a href="#">{{ $item->course->titleTranslate->translates[app()->getLocale()] }}</a></h6>
                                                            <p>{{ $item->course->teacher->prefix }}/ {{ $item->course->teacher->name }}</p>
                                                            <p>
                                                                {{ $item->course->curriculum->subject->year->stage->stageTranslate->translates[app()->getLocale()] }},
                                                                {{ $item->course->curriculum->subject->year->yearTranslate->translates[app()->getLocale()] }},
                                                                {{ $item->course->curriculum->subject->subject->subjectTranslate->translates[app()->getLocale()] }}
                                                            </p>
                                                            <h5>{{ $item->course->cost["course"] }} LE <span>1000.00 LE</span></h5>
                                                        </div>
                                                    </div>
                                                    <div class="remove-btn">
                                                        <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                                                              authorization="{{session("student_data")["jwtToken"] ?? ""}}"
                                                              action="{{ url("api/student/cart") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="id" value="{{ $item->id ?? ""}}">
                                                            <a href="#" class="btn" onclick="submitForm(this, null, location.reload())">{{ __("lang.remove") }}</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="total-item">
                                    <h5>{{ __("lang.total") }} : {{ $total }} LE</h5>
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
                    <li class="nav-item user-nav">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img src="{{ URL::asset((session("student_data")["image"] ? "uploads/". session("student_data")["image"]["file"] : '/build/img/user/user11.jpg')) }}" alt="Img">
                                <span class="status online"></span>
                            </span>
                        </a>
                        <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ URL::asset((session("student_data")["image"] ? "uploads/". session("student_data")["image"]["file"] : '/build/img/user/user11.jpg')) }}" alt="User Image"
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ session("student_data")["name"] }}</h6>
                                    <p class="text-muted mb-0">{{ __("lang.student") }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('student.profile') }}"><i
                                    class="feather-user me-1"></i>{{ __("lang.profile") }}</a>

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

