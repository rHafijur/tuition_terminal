@extends('parent.layouts.master',['title'=>'Matched Tutors'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            {{-- <h3 class="card-title">Change Password</h3> --}}
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row row-cols-2 row-cols-md-4">
                @foreach ($tutors as $tutor)
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-header">
                            @php
                                $degree=$tutor->tutor_degree;
                            @endphp
                            <div class="card-tools text-muted">{{$tutor->expected_salary}} ৳</div>
                            <h5 class="card-title">{{$tutor->user->name}} {!!$tutor->getStatusIcon()!!}</h5>
                            <h6 class="card-text mb-2 text-muted">
                                {{$degree->degree_title}} in {{$degree->institute->title}}
                            </h6>
                        </div>
                        <div class="card-body">
                          <p class="card-text">
                              {{$tutor->tutor_personal_information->short_description}}
                          </p>
                          {{-- <a href="#" class="card-link">Card link</a>
                          <a href="#" class="card-link">Another link</a> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection