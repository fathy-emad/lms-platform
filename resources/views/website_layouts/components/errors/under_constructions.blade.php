<div class="error-box">
    <div class="error-logo">
        <a href="{{ route('student.website') }}">
            <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
        </a>
    </div>
    <div class="error-box-img">
        <img src="{{ URL::asset('/build/img/error-02.png') }}" alt="" class="img-fluid">
    </div>
    <h3 class="h2 mb-3"> The {{ $title }} is Under Construction</h3>
    <p class="h4 font-weight-normal">We are working on fixing the problem. We back soon</p>
    <a href="{{ route('student.website') }}" class="btn btn-primary">Back to Home</a>
</div>
