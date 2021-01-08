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
          <h3 class="custom-text mb-5">Parent Registration</h3>
          <div class="reg-step">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="regStepOne-tab" href="#" role="tab" aria-controls="regStepOne" aria-selected="true">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Account Information</p>
                  </div>
                </a>
                <a class="nav-item nav-link" id="regStepTwo-tab" href="#" role="tab" aria-controls="regStepTwo" aria-selected="false">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Student Information</p>
                  </div>
                </a>
                <a class="nav-item nav-link" id="regStepThree-tab" href="#" role="tab" aria-controls="regStepThree" aria-selected="false">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Tutor Requirement</p>
                  </div>
                </a>
                <a class="nav-item nav-link" id="regStepFour-tab" href="#" role="tab" aria-controls="regStepFour" aria-selected="false">
                  <div class="reg-step-single">
                    <i class="fas fa-user-circle"></i>
                    <p class="text-custom mt-2">Contact Information</p>
                  </div>
                </a>
              </div>
            </nav>
          </div>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade active show" id="regStepOne" role="tabpanel" aria-labelledby="regStepOne-tab">
              <div class="reg-form">
                <form action="{{route('create_parent')}}" method="POST">
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
                      <select class="form-control @error('heard_from') is-invalid @enderror mb-3" name="heard_from">
                        <option value="">Heard From</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Google">Google</option>
                        <option value="Offline Marketing">Offline Marketing</option>
                        <option value="Lead Offer">Lead Offer</option>
                        <option value="Other">Other</option>
                      </select>
                      @error('heard_from')
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection