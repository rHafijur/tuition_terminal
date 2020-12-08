@extends('parent.layouts.master',['title'=>'Offer'])

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
                        <th scope="row" colspan="2">
                            <h5>Student Information</h5>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td>
                            {{$offer->category->title}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Course</th>
                        <td>
                            {{$offer->course->title}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Subjects</th>
                        <td>
                            @foreach ($offer->course_subjects as $cs)
                                {{$cs->subject->title}} @if(!$loop->last),@endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Days in Week</th>
                        <td>
                            {{$offer->days_in_week}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tutoring Time</th>
                        <td>
                            {{$offer->time}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Teaching Method</th>
                        <td>
                            {{$offer->teaching_method->title}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Salary Range</th>
                        <td>
                            {{$offer->min_salary}} - {{$offer->max_salary}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Name Of Institute</th>
                        <td>
                            {{$offer->name_of_institute}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Number of Students</th>
                        <td>
                            {{$offer->number_of_students}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Student's Gender</th>
                        <td>
                            {{$offer->student_gender}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">
                            <h5>Tutor Requirement</h5>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">Tutor's Gender</th>
                        <td>
                            {{$offer->tutor_gender}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tutor Requirements</th>
                        <td>
                            {{$offer->requirements}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Hiring from</th>
                        <td>
                            {{$offer->hiring_from}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">
                            <h5>Contact Information</h5>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">City</th>
                        <td>
                            {{$offer->city->name}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Location</th>
                        <td>
                            {{$offer->location->name}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Full Address</th>
                        <td>
                            {{$offer->address}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Name</th>
                        <td>
                            {{$offer->name}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Phone</th>
                        <td>
                            {{$offer->phone}}
                        </td>
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