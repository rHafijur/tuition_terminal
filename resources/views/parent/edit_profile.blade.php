@extends('parent.layouts.master',['title'=>'Edit Profile'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            {{-- <h3 class="card-title">Change Password</h3> --}}
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h6 class="box-title"><i class="fa fa-eye"></i> Edit Profile</h6>
                    @if (session('success'))
                        <div class="alert alert-info">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="box-body"> 
                    <div class="row d-flex justify-content-center">
                       <div class="col-md-6">
                        <form action="{{ route('parent_update_profile') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Full name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Phone</label>
                                <input type="phone" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="phone">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-4">
                                <button id="submit" type="submit" class="btn btn-primary btn-block">Update Parent</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection