@extends('layouts.fornt_app')
@section('content')
<section id="login-section" class="text text-custom-p">
  <div class="container">
    <div class="login-reg-area p-5">
      <form action="{{ route('send_forgot_otp') }}" method="POST" class="">
        @csrf
        <div class="form-top text-center">
          <p class="lead text-bold">Forgot Password</p>
        </div>
        <div class="form-group">
          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email/Phone Number">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <button class="btn btn-custom btn-block btn-login mt-3">Send Password reset code</button>
    </form></div>
    
  </div>
  
</section>
@endsection

