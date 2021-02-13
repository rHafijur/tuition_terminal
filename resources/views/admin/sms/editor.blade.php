@extends(getThemePath('layout.layout'))
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-edit"></i>Sms Editor</h1>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="box-body"> 
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>To:</h4>
                            @foreach ($users as $user)
                            <span class="badge badge-dark">{{$user->name}}</span>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('send_sms')}}" method="post">
                                @csrf
                                <input type="hidden" name="ids" value="{{$tids}}">
                                <div class="form-group">
                                    <label for="SMS_body">SMS Body</label>
                                    <textarea id="SMS_body" name="body" id="" cols="30" rows="6" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row d-flex justify-content-center">

            </div> --}}
        </div>
    </div>
@endsection