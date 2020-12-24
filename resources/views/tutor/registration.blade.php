@extends('layouts.fornt_app')
@push('css')
<link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  @if (request()->tab!=null)
      <style>
        .reg-box{
          max-width: 1000px !important;
        }
      </style>
  @endif
@endpush
@section('content')
<div class="tutor-reg-area text-custom-p">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="reg-box">
          <h3 class="custom-text mb-5">Tutor Registration</h3>
          <div class="reg-step">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link @if(request()->tab=='' || request()->tab==null) active @endif" id="regStepOne-tab" href="#" role="tab" aria-controls="regStepOne" aria-selected="true">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Account Information</p>
                  </div>
                </a>
                <a class="nav-item nav-link @if(request()->tab=='pi') active @endif" id="regStepTwo-tab" href="#" role="tab" aria-controls="regStepTwo" aria-selected="false">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Personal Information</p>
                  </div>
                </a>
                <a class="nav-item nav-link @if(request()->tab=='ei') active @endif" id="regStepThree-tab" href="#" role="tab" aria-controls="regStepThree" aria-selected="false">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Education Information</p>
                  </div>
                </a>
                <a class="nav-item nav-link @if(request()->tab=='ti') active @endif" id="regStepFour-tab" href="#" role="tab" aria-controls="regStepFour" aria-selected="false">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Tution Related Information</p>
                  </div>
                </a>
              </div>
            </nav>
          </div>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade @if(request()->tab==null) active show @endif" id="regStepOne" role="tabpanel" aria-labelledby="regStepOne-tab">
              <div class="reg-form">
                <form action="{{route('create_tutor')}}" method="POST">
                  @csrf
                  <div class="reg-form-content p-5">
                    <div class="form-group">
                      <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror mb-3" placeholder="Name">
                      @error('name')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror mb-3" placeholder="Contact Number">
                      @error('phone')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror mb-3" placeholder="Email Address">
                      @error('email')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror mb-3" placeholder="Password">
                      @error('password')
                      <div class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Retype Password">
                    </div>
                      <button class="btn btn-custom float-right mt-3">Continue</button>
                  </div>
                </form>
                <div class="form-footer py-5 text-center">
                  <p>Don't have an account? <a href="#">Create Account</a></p>
                  <br>
                  <p class="lead mb-0">OR</p>
                  <small>Login with your social Account</small>
                  <div class="d-block my-3">
                    <i class="fab fa-facebook-f fb-icon mr-3"></i>
                  <i class="fab fa-google-plus-g gplus-icon"></i>
                  </div>
                  <small class="mt-3">By signing up, you agree to our <a href="#">Term of Use and Privacy Policy</a></small>
                </div>
              </div>
            </div>
            @if ($tutor!=null)
            <div class="tab-pane fade @if(request()->tab=='ti') active show @endif " id="regStepTwo" role="tabpanel" aria-labelledby="regStepTwo-tab">
              @include('tutor.src.r_tutoring_info')
            </div>
            <div class="tab-pane fade @if(request()->tab=='ei') active show @endif" id="regStepThree" role="tabpanel" aria-labelledby="regStepThree-tab">
              @include('tutor.src.r_educational_info')
            </div>
            <div class="tab-pane fade @if(request()->tab=='pi') active show @endif" id="regStepFour" role="tabpanel" aria-labelledby="regStepFour-tab">
              @include('tutor.src.r_personal_info')
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
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
@endpush