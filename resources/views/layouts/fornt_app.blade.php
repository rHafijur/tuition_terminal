
<!-- Include Header -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutor</title>
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
              <h4 class="text-custom mb-5 text-bold">AVAILABLE NOW SSS</h4>
              <p class="text-custom-p">With bdtutors official app, Make your profile in minutes. Apply to your preferred
                tutoring jobs that match your skills</p>
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
                  <a href="#" class="text-custom-p">Become A Tutor</a>
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
                  <a href="#" class="text-custom-p ml-2">info@iqsasoft.com</a>
                  <hr>
                </li>
                <li class="d-block mb-3 footer-contact">
                  <i class="fas fa-phone-alt"></i>
                  <a href="#" class="text-custom-p ml-2">+1-646-546-5075</a>
                  <hr>
                </li>
                <li class="d-block mb-3 footer-contact">
                  <i class="fas fa-map-marker"></i>
                  <a href="#" class="text-custom-p ml-2">1862 E. Belvidere Rd, Suite #108, Grayslake, IL- 60030.
                    USA.</a>
                </li>
              </ul>
              <div class="social-icon text-custom-p pt-3">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram ml-2"></i></a>
                <a href="#"><i class="fab fa-twitter ml-2"></i></a>
                <a href="#"><i class="fab fa-youtube ml-2"></i></a>
                <a href="#"><i class="fab fa-linkedin-in ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <p class="">Copyright &copy;2020 <a href="#">iqsasoft.com</a> All Rights Reserved</p>
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
</body>

</html><!-- /Include Footer -->