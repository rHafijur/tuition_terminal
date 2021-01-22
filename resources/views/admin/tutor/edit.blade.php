@extends(getThemePath('layout.layout'))
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> Edit tutor</h1>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="box-title bg-secondary" style="color: white">
            <div class="row">
              <ul id="tab_nav" class="nav nav-pills">
                <li class="nav-item"><a href="{{ action('AdminTutorsController@getSingle',[$tutor->tutor->id]) }}" class="nav-link">Tutor Information</a></li>
                <li class="nav-item"><a href="{{ action('AdminTutorsController@getEdit',[$tutor->tutor->id]) }}" class="nav-link active">Login</a></li>
                <li class="nav-item"><a href="{{ action('AdminTutorsController@getSinglePresentPending',[$tutor->tutor->id]) }}" class="nav-link">Present Pending</a></li>
                <li class="nav-item"><a href="{{ action('AdminTutorsController@getSingleHistory',[$tutor->tutor->id]) }}" class="nav-link">History</a></li>
              </ul>
          </div>
          </div>
        <div class="box-body"> 
            <div class="row d-flex justify-content-center">
               <div class="col-md-6">
                <form action="{{ action('AdminTutorsController@postEdit') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$tutor->id}}">
                    <div class="form-group mb-3">
                        <label>Full name</label>
                        <input type="text" name="name" value="{{ $tutor->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $tutor->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="phone" name="phone" value="{{ $tutor->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="phone">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                          @error('password')
                          <div class="invalid-feedback">
                              {{$message}}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                        </div>
                      </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                        <button id="submit" type="submit" class="btn btn-primary btn-block">Update Tutor</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
@endsection