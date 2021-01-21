@extends(getThemePath('layout.layout'))
@php
    use Carbon\Carbon;
@endphp
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> {{$tutor->tutor_id}}</h1>
        </div>
        <div class="box-title bg-secondary" style="color: white">
          <div class="row">
            <ul id="tab_nav" class="nav nav-pills">
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSingle',[$tutor->id]) }}" class="nav-link">Tutor Information</a></li>
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSinglePresentPending',[$tutor->id]) }}" class="nav-link active">Present Pending</a></li>
                <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/applications")}}" class="nav-link">Applications</a></li>
                <li class="nav-item"><a href="{{cb()->getAdminUrl("job_offers/add_new")}}" class="nav-link">Add New Tuiton</a></li>
            </ul>
        </div>
        </div>
        <div class="box-body"> 
            <div class="card">
                <div class="card-head">
                    <h3 class="card-title">Pending Payment:{{$payment_pending_applications->count()}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($payment_pending_applications as $app)
                        <div class="card">
                            <div class="card-body">
                                Job Offer ID : <a href="{{cb()->getAdminUrl("job_offers/detail/".$app->job_offer_id)}}" target="_blank">{{$app->job_offer_id}}</a> <br>
                                Status : {{$app->current_stage}} <br>
                                Taken By : <a href="#">{{$app->taken_by->name}}</a> <br>
                                Payment Date : {{Carbon::parse($app->payment_date)->toDateString()}} <br>
                                Confirm Date : {{Carbon::parse($app->confirm_date)->toDateString()}} <br>
                                Taken At : {{Carbon::parse($app->taken_at)->toDateString()}} <br>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-head">
                    <h3 class="card-title">Pending Tuition:{{$pending_applications->count()}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($pending_applications as $app)
                        <div class="card">
                            <div class="card-body">
                                Job Offer ID : <a href="{{cb()->getAdminUrl("job_offers/detail/".$app->job_offer_id)}}" target="_blank">{{$app->job_offer_id}}</a> <br>
                                Status : {{$app->current_stage}} <br>
                                Taken By : <a href="#">{{$app->taken_by->name}}</a> <br>
                                Payment Date : {{Carbon::parse($app->payment_date)->toDateString()}} <br>
                                Confirm Date : {{Carbon::parse($app->confirm_date)->toDateString()}} <br>
                                Taken At : {{Carbon::parse($app->taken_at)->toDateString()}} <br>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection