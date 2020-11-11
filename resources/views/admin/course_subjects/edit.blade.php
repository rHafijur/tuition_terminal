@extends(getThemePath('layout.layout'))
@section('content')
    @push('head')
        <style type="text/css">
            #table-detail tr td:first-child {
                font-weight: bold;
                width: 25%;
            }
        </style>
        <link rel="stylesheet" href="{{asset('css/semantic.min.css')}}">
    @endpush
    @push('bottom')
    <script src="{{asset('js/semantic.min.js')}}"></script>
    @endpush
        <p>
            <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a>
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> {{ cbLang("edit") }}</h1>
        </div>
        <div class="box-body"> 
               <form action="{{action("AdminCourseSubjectsController@postEditSave",[$course->id])}}" method="POST" class="form">
                   @csrf
                <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="form-group">
                    <label for="course">Course</label>
                    <input type="text"  class="form-control" value="{{$course->title}}" id="course" disabled>
                </div>
                <div class="form-group">
                    <label for="subjects">Subjects</label>
                    <select name="subjects[]" class="form-control multiple ui selection dropdown" multiple="" id="subjects">
                        <option value="">Subjects</option>
                        @foreach ($subjects as $subject)
                            <option @if($subject->is_active) selected @endif value="{{$subject->id}}">{{$subject->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button class="btn btn-success">Save Changes</button>
                </form>
        </div>
    </div>
@endsection
@push('bottom')
<script>
    $( document ).ready(function() {
        $('#subjects').dropdown();
    });
        </script>
@endpush