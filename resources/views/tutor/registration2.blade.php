
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tuition Terminal | Tutor Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_lte/dist/css/adminlte.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="container">
  <div class="card">
    <div class="register-logo">
      <a href="#"><b>Tuition</b>Terminal</a>
    </div>
    <p class="login-box-msg">Register as Tutor</p>
    <div class="card-header p-2">
      <ul class="nav nav-pills">
        <li class="nav-item"><span class="nav-link @if(request()->tab=='' || request()->tab==null) active @endif" href="#account_information">Account Information</span></li>
        <li class="nav-item"><span class="nav-link @if(request()->tab=='pi') active @endif">Personal Infromation</span></li>
        <li class="nav-item"><span class="nav-link @if(request()->tab=='ei') active @endif">Educational Information</span></li>
        <li class="nav-item"><span class="nav-link @if(request()->tab=='ti') active @endif">Tutoring related Information</span></li>
      </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="@if(request()->tab=='' || request()->tab==null) active @endif tab-pane" id="account_information">
          <div class="d-flex justify-content-center">
          
            <div class="card">
              <div class="card-body register-card-body">
          
                <form action="{{route('create_tutor')}}" method="post">
                    @csrf
                  <div class="input-group mb-3">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                    @error('name')
                      <div class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
                  </div>
                  <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                      @error('email')
                      <div class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="addon-wrapping">+88</span>
                    </div>
                    <input type="phone" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="phone">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                      </div>
                      @error('phone')
                      <div class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                      @error('password')
                      <div class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input onchange="agreeChanged(this)" type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                         I agree to the <a href="#">terms</a>
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button id="submit" type="submit" class="btn btn-primary btn-block" disabled>Register</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
          
                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                  </a>
                  <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                  </a>
                </div>
          
                <a href="{{route('login')}}" class="text-center">I already have a membership</a>
              </div>
              <!-- /.form-box -->
            </div><!-- /.card -->
          </div>
        </div>
        @if ($tutor!=null)
        <div class="@if(request()->tab=='ti') active @endif tab-pane" id="activity">
          @include('tutor.src.r_tutoring_info')
        </div>
        <!-- /.tab-pane -->
        <div class="@if(request()->tab=='ei') active @endif tab-pane" id="education">
          @include('tutor.src.r_educational_info')
        </div>
        <!-- /.tab-pane -->

        <div class="@if(request()->tab=='pi') active @endif tab-pane" id="settings">
          @include('tutor.src.r_personal_info')
        </div>
        @endif
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('admin_lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_lte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    function agreeChanged(obj){
        if(obj.checked){
            $("#submit").prop( "disabled", false );
        }else{
            $("#submit").prop( "disabled", true );
        }
    }
</script>
<script>
  var masters_html="";
  var hsc_html="";
  function otherClicked(obj,num){
    var el=$($(".ins_"+num)[0]);
    el.html(`
    <label>Institute</label>
    <input required type="text" name="institute[`+num+`]" placeholder="Please Enter the Institute Name"  class="form-control">
    `);
    $(obj).closest(".select2-container").remove();
  }
  function otherButton(){
    return `
  <button class="btn btn-secondary" onclick="otherClicked(this)">Other</a>
  `;
  };
  function insSelect2(num){
      $('.select2_'+num).select2({
        language: {
          noResults: function(){
          return `
          <button class="btn btn-secondary" onclick="otherClicked(this,`+num+`)">Other</a>
          `;
          }
        },
        escapeMarkup: function(markup) {
          return markup;
        },
    });
  }
  function hasMasterChanged(){
    if(document.getElementById('has_masters').checked){
      $("#masters").html(masters_html);
      $(".select2_masters").select2();
      $(".select2_masters").select2();
      insSelect2(3);
      insSelect2(3);
    }else{
      $("#masters").empty();
    }
  }
  function isDiplomaChanged(){
    if(document.getElementById('has_diploma').checked==false){
      $("#hsc").html(hsc_html);
      $(".select2hsc").select2();
      $(".select2hsc").select2();
      insSelect2(5);
      insSelect2(5);
    }else{
      $("#hsc").empty();
    }
  }
    $(function(){
        //Initialize Select2 Elements
          $('.select2').select2();
          $('.select2').select2();
          var arr=[6,4];
          for(var n of arr){
            insSelect2(n);
            insSelect2(n);
          }

          masters_html=$("#masters").html();
          hsc_html=$("#hsc").html();
          hasMasterChanged();
          isDiplomaChanged();
          

          //Initialize Select2 Elements
    });
</script>
@if (session('success'))
<script>
  $(document).Toasts('create', {
        class: 'bg-success', 
        title: 'Success',
        subtitle: '',
        body: '{{session("success")}}'
      })
</script>
@endif
@stack('js')
</body>
</html>
