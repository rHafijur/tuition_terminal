@extends(getThemePath('layout.layout'))
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> Edit Parent</h1>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="box-body"> 
            <div class="row d-flex justify-content-center">
               <div class="col-md-6">
                <form action="{{ action('AdminParentsController@postEdit') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$parent->id}}">
                    <div class="form-group mb-3">
                        <label>Full name</label>
                        <input type="text" name="name" value="{{ $parent->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $parent->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="phone" name="phone" value="{{ $parent->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="phone">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                        <button id="submit" type="submit" class="btn btn-primary btn-block">Update Parent</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
@endsection