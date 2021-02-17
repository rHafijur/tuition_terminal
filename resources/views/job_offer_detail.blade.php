@extends('layouts.fornt_app')
@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row">
       <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Job Id: {{$offer->id}}
                    </h3>
                    <div class="card-tools float-right">
                        <form action="{{route('apply_to_job_offer')}}" method="post">
                            @csrf
                            <input type="hidden" name="job_offer_id" value="{{$offer->id}}">
                            <button class="btn btn-success  applyJobSignInButton" data-job_id="30" style="padding: 3px 12px" type="submit">Apply Now</button>
                         </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table borderless">
                        <tbody>
                            <tr>
                                <th scope="row" colspan="2">
                                    <h5>Student Information</h5>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row">Job Offer Id</th>
                                <td>
                                    {{$offer->id}}
                                </td>
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
                        </tbody>
                    </table>
                </div>
            </div>
       </div>
    </div>
</div>   
@endsection