{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.fornt_app')
@section('content')
<section id="login-section" class="text text-custom-p">
  <div class="container">
    <div class="login-reg-area p-5">
      <form action="{{ route('login') }}" method="POST" class="">
        @csrf
        <div class="form-top text-center">
          <h3 class="mb-1 text-custom">Existing Member Sign In</h3>
          <p class="lead text-bold">I am</p>
          <div class="form-button mb-5 btn-group-toggle" data-toggle="buttons">
            <label for="tut" class="btn btn-custom mr-3">
              <input type="radio" id="tut">Tutor
            </label>
            <label for="parent" class="btn btn-custom mr-3">
              <input type="radio" id="parent">Parent
            </label>
            {{-- <input type="radio" class="btn btn-custom">Parent/Student</button> --}}
          </div>
        </div>
        <div class="form-group">
          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email/Phone Number">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <input id="password" placeholder="Password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
        <div class="form-group">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="mr-2 mt-3">Remember me
        </div>
        <button class="btn btn-custom btn-block btn-login mt-3">Login</button>
        <a class="float-right mt-2" href="{{route('forgot_password')}}">Forget Password</a>
        <br>
        <div class="form-footer py-5 text-center">
          <p>Don't have an account? <a href="#">Create Account</a></p>
          <br>
          <p class="lead mb-0">OR</p>
          <small>Login with your social Account</small>
          <div class="d-block my-3">
            <i class="fab fa-facebook-f fb-icon mr-3"></i>
          <i class="fab fa-google-plus-g gplus-icon"></i>
          </div>
          <small class="mt-3">By signing up, you agree to our Term of Use and Privacy Policy</small>
        </div>
    </form></div>
    
  </div>
  
</section>
@endsection

