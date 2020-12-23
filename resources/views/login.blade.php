
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_lte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{route('tutor_registration')}}" class="text-center">Register as Tutor</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin_lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_lte/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
@extends('layouts.fornt_app')
@section('content')
<section id="login-section" class="text text-custom-p">
  <div class="container">
    <div class="login-reg-area p-5">
      <form action="" class="">
        <div class="form-top text-center">
          <h3 class="mb-1 text-custom">Existing Member Sign In</h3>
          <p class="lead text-bold">I am</p>
          <div class="form-button mb-5">
            <button class="btn btn-custom mr-3">Tutor</button>
            <button class="btn btn-custom">Parent/Student</button>
          </div>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email/Phone Number">
        </div>
        <div class="form-group">
          <input type="password" class="form-control mb-3" placeholder="Password">
        </div>
        <div class="form-group">
          <input type="checkbox" class="mr-2 mt-3">Remember me
        </div>
        <button class="btn btn-custom btn-block btn-login mt-3">Login</button>
        <a class="float-right mt-2" href="#">Forget Password</a>
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
