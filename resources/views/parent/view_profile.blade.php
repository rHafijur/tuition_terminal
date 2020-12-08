@extends('parent.layouts.master',['title'=>'Profile'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            {{-- <h3 class="card-title">Change Password</h3> --}}
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table borderless">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{$user->parents->id}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$user->phone}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection