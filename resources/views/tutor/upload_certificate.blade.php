@extends('tutor.layouts.master',['title'=>'Upload Certificate'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            {{-- <h3 class="card-title">Change Password</h3> --}}
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <form action="{{route('tutor_upload_certificate')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="input-group mb-3">
                <select name="type"  class="form-control">
                    <option value="">Select Certificate Type</option>
                    <option>SSC/O Level Marksheets/certificates</option>
                    <option>HSC/A Level Marksheets/certificates</option>
                    <option>NID/ Passport/ Birth certificate</option>
                    <option>University ID Card</option>
                    <option>Other</option>
                </select>
                @error('type')
                <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="input-group mb-3">
                <input type="file" name="certificate" class="form-control">
              </div>
            <button class="btn btn-success">Upload Certificate</button>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection