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
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getEdit',[$tutor->id]) }}" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSinglePresentPending',[$tutor->id]) }}" class="nav-link">Present Pending</a></li>
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSingleHistory',[$tutor->id]) }}" class="nav-link active">History</a></li>
            </ul>
        </div>
        </div>
        <div class="box-body"> 
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total Applied Tuition:{{$applications->count()}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($applications as $app)
                        <div class="card">
                            <div class="card-body">
                                Job Offer ID : <a href="{{cb()->getAdminUrl("job_offers/detail/".$app->job_offer_id)}}" target="_blank">{{$app->job_offer_id}}</a> <br>
                                Applied At : {{Carbon::parse($app->created_at)->toDateString()}} <br>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total Given Tuition:{{$given_applications->count()}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($given_applications as $app)
                        <div class="card">
                            <div class="card-body">
                                Job Offer ID : <a href="{{cb()->getAdminUrl("job_offers/detail/".$app->job_offer_id)}}" target="_blank">{{$app->job_offer_id}}</a> <br>
                                Given At : {{Carbon::parse($app->taken_at)->toDateString()}} <br>
                                Given By : <a href="#">{{$app->taken_by->name}}</a> <br>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total Confirm Tuition:{{$confirm_applications->count()}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($confirm_applications as $app)
                        <div class="card">
                            <div class="card-body">
                                Job Offer ID : <a href="{{cb()->getAdminUrl("job_offers/detail/".$app->job_offer_id)}}" target="_blank">{{$app->job_offer_id}}</a> <br>
                                Confirm At : {{Carbon::parse($app->confirm_date)->toDateString()}} <br>
                                Given By : <a href="#">{{$app->taken_by->name}}</a> <br>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notes :{{$tutor->notes->count()}}</h3>
                </div>
                <div class="card-body">
                    @foreach ($tutor->notes()->latest()->get() as $note)
                    <div class="card">
                        <div class="card-body">
                            Noted By : <a href="#">{{$note->takenBy()->name}}</a> <br>
                            Noted At : {{Carbon::parse($note->created_at)->toDateString()}} <br>
                            <hr>
                            Note: <br>
                            {{$note->note}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Other</h3>
                </div>
                <div class="card-body">
                    Last Online Date: {{Carbon::parse($tutor->user->login_at)->toDateString()}} <br>
                    Last information update date: {{Carbon::parse($tutor->updated_at)->toDateString()}}
                </div>
            </div>
        </div>
    </div>
@endsection