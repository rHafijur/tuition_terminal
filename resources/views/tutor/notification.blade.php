@extends('tutor.layouts.master',['title'=>'Notifications'])
@php
    use Carbon\Carbon;
@endphp
@section('content')
<div class="row">
    <div class="col-md-12">

      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="list-group">
            @foreach ($notifications as $notification)
            <a href="{{$notification->link}}" style="margin-bottom: 10px" class="list-group-item list-group-item-action flex-column align-items-star @if($notification->is_seen==0) active @endif">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$notification->subject}}</h5>
                  <small>{{Carbon::parse($notification->created_at)->diffForHumans()}}</small>
                </div>
                <p class="mb-1">{{$notification->details}}</p>
                @php
                    $notification->seen();
                @endphp
              </a>
            @endforeach
          </div>
        </div>
        <div class="card-footer">
          {!!$notifications->links()!!}
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection