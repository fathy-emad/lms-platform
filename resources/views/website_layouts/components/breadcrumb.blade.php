@if (
    !Route::is([
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
        'checkout',
        'course-details',
        'students-grid',
        'students-list',
        'blog-details',
        'blog-grid',
        'blog-list',
        'blog-masonry',
        'blog-modern',
        'cart',
        'course-grid',
        'course-list',
        'faq',
        'help-center',
        'job-category',
        'notifications',
        'pricing-plan',
        'privacy-policy',
        'support',
        'term-condition',
        'wishlist'
    ]))
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar breadcrumb-bar-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <h2 class="breadcrumb-title">{{ $title }}</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('index') }}">{{ $item1 }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $item2 }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
@endif

@if (Route::is(['checkout', 'course-details']))
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $item1 }}</li>
                                <li class="breadcrumb-item" aria-current="page">{{ $item2 }}</li>
                                @if (Route::is(['course-details']))
                                    <li class="breadcrumb-item" aria-current="page">{{ $item3 }}</li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
@endif

@if (Route::is([
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
       
    ]))
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar breadcrumb-bar-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <h2 class="breadcrumb-title">{{ $title }}</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('index') }}">{{ $item1 }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $item2 }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
@endif

@if(Route::is(['students-grid','students-list','blog-details','blog-grid','blog-list','blog-masonry','blog-modern','cart','course-grid','course-list','faq','help-center','job-category','notifications','pricing-plan','privacy-policy','support','term-condition','wishlist']))
	<!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('index')}}">{{ $title }}</a></li>
                                <li class="breadcrumb-item">{{ $item1 }}</li>
                                <li class="breadcrumb-item">{{ $item2 }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    @endif
