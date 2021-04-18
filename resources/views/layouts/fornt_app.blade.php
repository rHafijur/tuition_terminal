
<!-- Include Header -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="facebook-domain-verification" content="sailogmvwng1tz2vl26qk63fh8gkbn" />
  <title>Tuition Terminal</title>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MCX2SQR');</script>
<!-- End Google Tag Manager -->
  <!-- GOOGLE FONT -->

  <!-- CSS FILES -->
  <!-- CSS only -->
  <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->

  <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> -->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.theme.default.css')}}">
  @stack('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <style>
    .btn-custom.active {
        background: #50AB1D;
        border: 1px solid #50AB1D;
        color: #fff;
    }
    a.active >div>i{
        background: #50AB1D;
        border: 1px solid #50AB1D !important;
        color: #fff;
    }
  </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MCX2SQR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <header class="header-area">
      <!-- Navbar Start -->
  <nav class="navbar bg-white navbar-expand-lg fixed-top py-3">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{asset('assets/img/logo.png')}}" alt="" class="img img-fluid">
      </a>
      <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#myNavbar">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link ">HOME</a>
          </li>
          <li class="nav-item">
            <a href="{{route('job_board')}}" class="nav-link">JOB BOARD</a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">TUTORIAL</a>
          </li>
          <li class="nav-item">
            <a href="tutor-hub.php" class="nav-link"> TUTORS HUB</a>
          </li> -->
          @if (!auth()->check())
          <li class="nav-item">
            <a href="{{route('register_type')}}" class="nav-link"> REGISTRATION</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link"> SIGN IN</a>
          </li>
          @else
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">{{auth()->user()->name}}</a>
          </li>
          @endif
          <li class="nav-item">
            <a href="#" class="nav-link" id="navSlideBox">
              <i class="fa fa-info-circle" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->
  </header>





    <div id="mySidenav" class="sidenav">

        <div class="sidenav-header">
            <div class="row">
                <div class="col-sm-4">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="col-sm-4">
                    <p>Help Center</p>
                </div>
                <div class="col-sm-4">
                    <a href="#" class="closebtn" id="sideNavClose">&times;</a>
                </div>
            </div>
        </div>
        <div class="help-content text-center">
            <div class="row">
                <div class="col-md-4">
                    <a href="#">
                        <i class="fas fa-info-circle"></i>
                        <p>Help Center</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <i class="far fa-newspaper"></i>
                        <p>Aritical</p>
                    </a>

                </div>
                <div class="col-md-4">
                    <a href="#">
                        <i class="fas fa-id-card"></i>
                        <p>Contact</p>
                    </a>

                </div>
            </div>
        </div>
        <div class="aritical-suggetion">
            <div class="row">
                <div class="col-sm-12">
                    <span>Suggested articles</span>
                    <p>Requesting transfer of funds among tutors</p>
                    <p>Requesting transfer of funds among tutors</p>
                    <p>Requesting transfer of funds among tutors</p>
                </div>
            </div>

        </div>
        <div class="help-faq">
            <div class="row">
                <div class="col-sm-12">
                    <h5>Help Tuition Terminal?</h5>
                    <div class="bs-example">
                        <div class="accordion" id="accordionExample">
                            <div class="card sidenav-card">
                                <div class="card-header sidenav-card-header" id="newUser">

                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i>New in Bdtutors?</button>

                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="newUser" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p><a href="#">Register as a Student</a></p>
                                        <p><a href="#">Rules Violation and Penalties</a></p>
                                        <p><a href="#">How to Contact BDTutor</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card sidenav-card">
                                <div class="card-header sidenav-card-header" id="studentHelp">

                                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i>Tutor Help</button>

                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="studentHelp" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p><a href="#">Registration and Rules</a></p>
                                        <p><a href="#How to Find students"></a></p>
                                        <p><a href="#">Profile</a></p>
                                        <p><a href="#">Calender</a></p>
                                        <p><a href="#">My Request</a></p>
                                        <p><a href="#">Money Withdrawals</a></p>
                                        <p><a href="#">Setting</a></p>
                                        <p><a href="#">Tutor profile Guidelines</a></p>
                                        <p><a href="#">Top tips foe tutor</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card sidenav-card">
                                <div class="card-header sidenav-card-header" id="teacherHelp">

                                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-plus"></i>Student Help</button>

                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="teacherHelp" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p><a href="">Registration</a></p>
                                        <p><a href="">Profile Setting</a></p>
                                        <p><a href="">How to find a tutor</a></p>
                                        <p><a href="#">How to know if tutor is good?</a></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <!----Header sidenav Area End-----><!-- /Include Header -->

@yield('content')

<!-- Include Footer -->
  <!-- Footer Start -->
  <section id="footer-section" class="footer-section pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h4 class="text-custom mb-5 text-bold">AVAILABLE NOW</h4>
              <p class="text-custom-p">With Tuition Terminal official app, Make your profile in minutes. Apply to your preferred tutoring jobs that match your skills</p>
              <img src="{{asset('assets/img/playStore.png')}}" alt="Play Store" class="img img-fluid pt-3">
            </div>
          </div>
        </div>
        <div class="col-md-4 useful-content mt-3 text-center">
          <h4 class="text-custom mb-5 text-bold">USEFUL LINKS</h4>
          <div class="row">
            <div class="col-md-6">
              <ul class="">
                <li class="d-block mb-3">
                  <a href="http://tuitionterminal.com.bd/tutor/registration" class="text-custom-p">Become A Tutor</a>
                </li>
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">Our Blog</a>
                </li>
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">Careers</a>
                </li>
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">FAQ</a>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="">
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">Hire A Tutor</a>
                </li>
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">Contact</a>
                </li>
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">Gallery</a>
                </li>
                <li class="d-block mb-3">
                  <a href="#" class="text-custom-p">Our Team</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h4 class="text-custom mb-5 text-bold">CONNECT US</h4>
              <ul class="text-custom-p text-left p-0">
                <li class="d-block mb-3">
                  <p>We are here for your help!</p>
                  <hr>
                </li>
                <li class="d-block mb-3 footer-contact">
                  <i class="fas fa-envelope-square"></i>
                  <a href="#" class="text-custom-p ml-2">info@tuitionterminal.com.bd</a>
                  <hr>
                </li>
                <li class="d-block mb-3 footer-contact">
                  <i class="fas fa-phone-alt"></i>
                  <a href="#" class="text-custom-p ml-2">09678-444477</a>
                  <hr>
                </li>
                <li class="d-block mb-3 footer-contact">
                  <i class="fas fa-map-marker"></i>
                  <a href="#" class="text-custom-p ml-2">F#D-4,H#10/5,R#,Tolarbagh R/A,Section#1,Mirpur,Dhaka-1216</a>
                </li>
              </ul>
              <div class="social-icon text-custom-p pt-3">
                <a target="_blank" href="https://www.facebook.com/tuitionterminal.official"><i class="fab fa-facebook"></i></a>
                <a target="_blank" href="https://www.instagram.com/tuition_terminal/"><i class="fab fa-instagram ml-2"></i></a>
                <a target="_blank" href="https://twitter.com/TuitionTerminal"><i class="fab fa-twitter ml-2"></i></a>
                <a target="_blank" href="https://www.youtube.com/channel/UCCwat8rKUi9TQK82j6kdQnQ"><i class="fab fa-youtube ml-2"></i></a>
                <a target="_blank" href="https://www.linkedin.com/company/tuitionterminal/"><i class="fab fa-linkedin-in ml-2"></i></a>
                <a target="_blank" href="https://www.pinterest.com/tuitionterminalofficial/_saved/"><i class="fab fa-pinterest ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>be
    <div class="text-center">
        
      <p class="text-center">Copyright &copy;2021 <a href="http://tuitionterminal.com.bd/">Tuition Terminal</a> All Rights Reserved</p> <p class="text-center"> Developed By <a href="https://iqsasoft.com"> IQSA SOFT </a></p>
    
    </div>
  </section>


  <!-- Footer End -->


  <!-- JS FILES -->
  <!-- JavaScript Bundle with Popper -->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <!-- <script src="{{asset('assets/js/popper.js')}}"></script> -->
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>
  @stack('js')
  <script>var BotStar={appId:"sbb423ad5-d775-4802-b1b7-62156a107577",mode:"livechat"};!function(t,a){var e=function(){(e.q=e.q||[]).push(arguments)};e.q=e.q||[],t.BotStarApi=e;!function(){var t=a.createElement("script");t.type="text/javascript",t.async=1,t.src="https://widget.botstar.com/static/js/widget.js";var e=a.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();}(window,document)</script>
</body>

</html><!-- /Include Footer -->