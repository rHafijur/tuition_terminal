@extends('tutor.layouts.master',['title'=>'Edit Tutor Information'])

@section('content')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            @php
                $user=auth()->user();
            @endphp
            <img class="profile-user-img img-fluid img-circle" src="@if($user->photo!=null){{url($user->photo)}}@else {{url("/img/profile.png")}} @endif" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{$tutor->user->name}} {!!auth()->user()->tutor->getStatusIcon()!!}</h3>
          <div class="progress">
            @php
                $progress=$tutor->getProfileComplete();
            @endphp
            <div class="progress-bar" role="progressbar" style="width: {{$progress}}%;" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
          </div>

          {{-- <p class="text-muted text-center">Software Engineer</p> --}}

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Verified</b> <a class="float-right">{{$tutor->is_verified==0?"No":"Yes"}}</a>
            </li>
            <li class="list-group-item">
              <b>Featured</b> <a class="float-right">{{$tutor->is_featured==0?"No":"Yes"}}</a>
            </li>
            <li class="list-group-item">
              <b>Premium Member</b> <a class="float-right">{{$tutor->is_premium==0?"No":"Yes"}}</a>
            </li>
          </ul>

          {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      {{-- <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-book mr-1"></i> Education</strong>

          <p class="text-muted">
            B.S. in Computer Science from the University of Tennessee at Knoxville
          </p>

          <hr>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

          <p class="text-muted">Malibu, California</p>

          <hr>

          <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

          <p class="text-muted">
            <span class="tag tag-danger">UI Design</span>
            <span class="tag tag-success">Coding</span>
            <span class="tag tag-info">Javascript</span>
            <span class="tag tag-warning">PHP</span>
            <span class="tag tag-primary">Node.js</span>
          </p>

          <hr>

          <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
        </div>
        <!-- /.card-body -->
      </div> --}}
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      @include('tutor.src.edit_info')
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@endsection