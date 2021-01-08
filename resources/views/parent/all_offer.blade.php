@extends('parent.layouts.master',['title'=>'All Job Offers'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            {{-- <h3 class="card-title">Change Password</h3> --}}
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Days in week</th>
                        <th>Name of Institute</th>
                        <th>Number of Students</th>
                        <th>Status</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <td>{{$offer->name}}</td>
                            <td>{{$offer->days_in_week}}</td>
                            <td>{{$offer->name_of_institute}}</td>
                            <td>{{$offer->number_of_students}}</td>
                            <td>{{$offer->getStatus()}}</td>
                            <td>{{$offer->isActive()}}</td>
                            <td>
                                <a href="{{route('parent.edit_offer',['id'=>$offer->id])}}"><button class="btn btn-primary">Edit</button></a>
                                <a href="{{route('parent.view_offer',['id'=>$offer->id])}}"><button class="btn btn-info">View</button></a>
                                <a href="{{route('parent.matched_tutors',['id'=>$offer->id])}}"><button class="btn btn-info">Request for Tutor</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection