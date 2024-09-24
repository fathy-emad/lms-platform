<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title> @yield('title') </title>

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ url('build/img/favicon.svg') }}">

<!-- Bootstrap CSS -->
@php $boostrap = app()->getLocale() == "ar" ? "bootstrap.rtl.min.css" : "bootstrap.min.css"; @endphp
<link rel="stylesheet" href="{{ url('/build/css/' . $boostrap) }}">

<!-- Daterangepicker CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Datepicker CSS -->
<link rel="stylesheet" href="{{ url('/build/css/bootstrap-datetimepicker.min.css') }}">

<!-- Boxioons CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/boxicons/css/boxicons.min.css') }}">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ url('/build/plugins/fontawesome/css/all.min.css') }}">

<!-- Feather CSS -->
<link rel="stylesheet" href="{{ url('/build/css/feather.css') }}">

<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/select2/css/select2.min.css') }}">

<!-- Datatable CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ url('/build/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('/build/css/owl.theme.default.min.css') }}">

<!-- Swiper CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/swiper/css/swiper.min.css') }}">

<!-- Slick CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/slick/slick.css') }}">
<link rel="stylesheet" href="{{ url('/build/plugins/slick/slick-theme.css') }}">

<!-- Feathericon CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/feather/feather.css') }}">

<!-- Dropzone -->
<link rel="stylesheet" href="{{ url('/build/plugins/dropzone/dropzone.min.css') }}">

<!-- Aos CSS -->
<link rel="stylesheet" href="{{ url('/build/plugins/aos/aos.css') }}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ url('/build/css/style.css') }}">

@yield('style')
