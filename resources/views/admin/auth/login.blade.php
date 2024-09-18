@extends('dashboard_layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo" href="#"><img class="img-fluid for-light" width="175" height="40" src="{{asset('build/img/logo.svg')}}" alt="looginpage"><img class="img-fluid for-dark" width="175" height="40" src="{{asset('build/img/logo_dark.svg')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form novalidate="" class="theme-form needs-validation" id="form" method="POST"
                        action="{{ url("api/admin/auth/login") }}" locale="{{app()->getLocale()}}" csrf="{{ csrf_token()}}">
                     <h4>Sign in to account</h4>
                     <p>Enter your email & password to login</p>
                     <div class="form-group">
                        <label class="col-form-label" for="email">Email Address</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="example@gmail.com" required/>
                     </div>
                     <div class="form-group">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control" id="password" type="password" name="password" placeholder="*********" required/>
                        <div class="show-hide" style="margin-top: 15px !important;"><span class="show"></span></div>
                     </div>
                     <div class="form-group mb-0">
                        <a class="link" href="{{ route('admin.auth.forget-password') }}">Forgot password?</a>
                        <button class="btn btn-primary btn-block" onclick="submitForm(this)" type="button">Sign in</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/js/login.js')}}"></script>
@endsection
