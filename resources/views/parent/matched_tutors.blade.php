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
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="@if($tutor->user->photo!=null){{url($tutor->user->photo)}}@else {{url("/img/profile.png")}} @endif" alt="User profile picture">
                          </div>
          
                          <h3 class="profile-username text-center">{{$tutor->user->name}} {!!$tutor->getStatusIcon()!!}</h3>
          
                          <p class="text-muted text-center">
                              @php
                                  $degrees=$tutor->tutor_degrees()->whereIn('degree_id',[3,4])->orderBy('degree_id','desc')->get();
                              @endphp
                              @foreach ($degrees as $degree)
                                @if ($degree->degree_id==4)
                                    <strong>Bachelors</strong> at
                                @elseif ($degree->degree_id==3)
                                    <strong>Masters</strong> at
                                @endif
                                {{$degree->institute->title}}@if (!$loop->last),<br>@endif
                              @endforeach
                          </p>
          
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Categories</b> <a class="float-right">
                                  @foreach ($tutor->categories as $category)
                                  <span class="badge badge-secondary">{{$category->title}}</span>
                                  @endforeach
                              </a>
                            </li>
                            <li class="list-group-item">
                              <b>Expected Salary</b> <a class="float-right">{{$tutor->expected_salary}} ৳</a>
                            </li>
                            <li class="list-group-item">
                                {{$tutor->tutor_personal_information->short_description}}
                            </li>
                            {{-- <li class="list-group-item">
                              <b>Friends</b> <a class="float-right">13,287</a>
                            </li> --}}
                          </ul>
                          @if ($offer->already_applied_for_tutor($tutor->id))
                            <form action="{{route('apply_for_tutor')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$offer->id}}" name="job_offer_id">
                                <input type="hidden" value="{{$tutor->id}}" name="tutor_id">
                                <button class="btn btn-primary btn-block">Apply for this tutor</button>
                            </form>
                          @else
                            <button class="btn btn-primary btn-block" disabled>Applied</button>
                          @endif
                        </div>
                        <!-- /.card-body -->
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