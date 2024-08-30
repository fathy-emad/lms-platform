<div class="error-box">
    <div class="error-logo">
        <a href="{{ route('student.website') }}">
            <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
        </a>
    </div>
    <div class="error-box-img">
        <img src="{{ URL::asset('/build/img/come-soon.png') }}" alt="" class="img-fluid">
    </div>
    <h3 class="h2 mb-3"> The cart is empty</h3>
    <p class="h4 font-weight-normal">Fill the cart and come back</p>
    <a href="{{ route('student.website') }}" class="btn btn-primary">Back to Home</a>
</div>
