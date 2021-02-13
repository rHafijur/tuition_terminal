@extends('layouts.fornt_app')
@section('content')
<section class="signup-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="signup-header text-center">
                    <h1>Let's get started!</h1>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-md-2">
               
           </div>

            <div class="col-md-4">
                <div class="signup-content text-center">
                    <img class="inactive-student-parent" src="https://tutor.iqsademo.com/tuition/assets/img/ttnormal.png" alt="">
                    <img class="active-image-parent" src="https://tutor.iqsademo.com/tuition/assets/img/tt_active.png" alt="">
                    <h4>Tutors</h4>
                    <p>Find tuition jobs, build your teaching career, teach online courses</p>
                    
                    <a href="{{ route('tutor_registration') }}"><button type="button" class="btn btn-custom btn-block btn-login mt-3">Sign up</button></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="signup-content text-center">
                    <img class="inactive-student-parent" src="https://tutor.iqsademo.com/tuition/assets/img/student_parent_normal.png" alt="">
                    <img class="active-image-parent" src="https://tutor.iqsademo.com/tuition/assets/img/student_parent_active.png" alt="">
                    <h4>Students &amp; Parents</h4>
                    <p>Find tuition jobs, build your teaching career, teach online courses</p>
                    <a href="{{ route('parent_registration') }}"><button type="button" class="btn btn-custom btn-block btn-login mt-3">Sign up</button></a>
                </div>
            </div>
            <div class="col-md-2">
               
           </div>
        </div>
    </div>
</section>
@endsection