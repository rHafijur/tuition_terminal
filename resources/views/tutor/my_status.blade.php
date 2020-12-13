@extends('tutor.layouts.master',['title'=>'My Status'])
@section('content')
<div class="row">
    <div class="col-md-12">

      <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Confirm Tuition</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Paid tuition</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Prosessing</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Rejected tuition</th>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection