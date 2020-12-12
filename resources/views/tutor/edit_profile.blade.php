@extends('tutor.layouts.master',['title'=>'Change Password'])

@section('content')
<div class="card">
  <div class="card-header p-2">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link @if(request()->tab=='pass' || request()->tab==null) active @endif" href="#pass" data-toggle="tab">Password</a></li>
      <li class="nav-item"><a class="nav-link @if(request()->tab=='profile') active @endif" href="#profile" data-toggle="tab">Profile</a></li>
    </ul>
  </div><!-- /.card-header -->
  <div class="card-body">
    <div class="tab-content">
      <div class="@if(request()->tab=='pass' || request()->tab==null) active @endif tab-pane" id="pass">
        <form action="{{route('tutor_update_password')}}" method="POST">
          @csrf
          <div class="input-group mb-3">
              <input type="password" name="current_password" class="form-control @if(session('incorrect_password')) is-invalid @endif" placeholder="Current Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @if(session('incorrect_password'))
              <div class="invalid-feedback">
                  {{session('incorrect_password')}}
                </div>
              @endif
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
          <button class="btn btn-success">Update password</button>
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="@if(request()->tab=='profile') active @endif tab-pane" id="profile">
        <form action="{{route('tutor_update_profile')}}" method="post">
          @csrf
          @php
              $user= auth()->user();
          @endphp
        <div class="input-group mb-3">
          <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
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
          <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping">+88</span>
          </div>
          <input type="phone" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          @error('phone')
          <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror
        </div>
          <div class="col-4">
            <button id="submit" type="submit" class="btn btn-primary">Update</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      </div>
      <!-- /.tab-pane -->

    </div>
    <!-- /.tab-content -->
  </div><!-- /.card-body -->
</div>
@endsection