<div class="error-box">
    <div class="error-logo">
        <a href="{{ route('student.website') }}">
            <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
        </a>
    </div>
    <div class="error-box-img">
        <img src="{{ URL::asset('/build/img/error-01.png') }}" alt="" class="img-fluid">
    </div>
    <h3 class="h2 mb-3"> Oh, No!! Error 404</h3>
    <p class="h4 font-weight-normal">{{ __("lang.views_exceeded") }} {{ $error }}</p>
    <a href="{{ route('student.website') }}" class="btn btn-primary">{{ __("lang.back_to_home") }}</a>
</div>
