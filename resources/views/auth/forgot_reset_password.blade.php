@extends('layouts.fornt_app')
@section('content')
<div class="tutor-reg-area text-custom-p">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="reg-box">
          <h3 class="custom-text mb-5">Reset Password</h3>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade active show" id="regStepOne" role="tabpanel" aria-labelledby="regStepOne-tab">
              <div class="reg-form">
                <form action="{{route('forgot_password_reset_password')}}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
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
                      <button class="btn btn-custom float-right mt-3">Reset Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection