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
                        <th scope="row">Medium</th>
                        <td>
                            @if ($offer->tutor_category!=null)
                                {{$offer->tutor_category->title}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">University</th>
                        <td>
                            @if ($offer->tutor_university!=null)
                                {{$offer->tutor_university->title}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">University Type</th>
                        <td>
                            {{$offer->university_type}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Depertment</th>
                        <td>
                            {{$offer->tutor_department}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">College</th>
                        <td>
                            @if ($offer->tutor_college!=null)
                                {{$offer->tutor_college->title}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Group</th>
                        <td>
                            {{$offer->group}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">School</th>
                        <td>
                            @if ($offer->tutor_school!=null)
                                {{$offer->tutor_school->title}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Study Type</th>
                        <td>
                            @if ($offer->tutor_study_type!=null)
                                {{$offer->tutor_study_type->title}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tutor's Gender</th>
                        <td>
                            {{$offer->tutor_gender}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tutor's Religion</th>
                        <td>
                            @if ($offer->tutor_religion!=null)
                                {{$offer->tutor_religion->title}}
                            @endif
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
                    <tr>
                        <th scope="row">Email</th>
                        <td>
                            {{$offer->email}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Additional contact Number</th>
                        <td>
                            {{$offer->additional_contact}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Reference Name</th>
                        <td>
                            {{$offer->reference_name}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Reference Contact Number</th>
                        <td>
                            {{$offer->reference_contact}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Reference City</th>
                        <td>
                            @if ($offer->reference_city!=null)
                                {{$offer->reference_city->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Source</th>
                        <td>
                            {{$offer->source}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Spicial note</th>
                        <td>
                            {{$offer->spicial_note}}
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