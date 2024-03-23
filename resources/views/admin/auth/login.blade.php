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
               <div><a class="logo" href="#"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form novalidate="" class="theme-form needs-validation" id="form" method="POST" action="{{ url("api/admin/auth/login") }}" locale="{{ app()->getLocale() }}">
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
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div>
                        <a class="link" href="{{ route('forget-password') }}">Forgot password?</a>
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
