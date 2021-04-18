@extends('tutor.layouts.master',['title'=>'Dashboard'])
@php
    use Carbon\Carbon;
@endphp
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin_lte/plugins/sweetalert2/sweetalert2.min.css')}}">
<script src="{{asset('admin_lte/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
@endpush
@push('js')

<script type:"text/javascipt">
    
   
     $(document).on('click', '#npsucess', function(e) {
            swal.fire(
                'You are applied for the job!',
                'Thanks for applying',
                'success'
            )
        });
     $(document).on('click', '#nperror', function(e) {
            swal.fire(
                'You are already applied!',
                'Apply For Another Job',
                'error'
            )
        }); 
    $(document).on('click', '#npcomplete', function(e) {
            swal.fire(
                'Profile Incomplete!',
                'Complete your profile to 80%',
                'error'
            )
        }); 
     $(document).on('click', '#npgender', function(e) {
            swal.fire(
                'Profile Gender Mismatch',
                'This offer is for specific gender, you cannot apply this offer',
                'error'
            )
        });
    
</script>

@endpush

@section('content')
@php
$personal_info=$tutor->tutor_personal_information;
@endphp
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Job Id: {{$offer->id}}
        </h3>
        <div class="card-tools float-right">
        @if ($tutor->getProfileComplete() >= 80)
            @if (!$offer->already_applied())
            <form action="{{route('apply_to_job_offer')}}" method="post">
              @csrf
              <input type="hidden" name="job_offer_id" value="{{$offer->id}}">
              @if ( $offer->tutor_gender == $personal_info->gender || $offer->tutor_gender == null)
             
              <button class="btn btn-success  applyJobSignInButton" data-job_id="30" id="npsucess" style="padding: 3px 12px" type="submit">Apply Now</button>
              @else
              <button class="btn btn-success" id="npgender" style="padding: 3px 12px" type="button">Apply Now</button>
              @endif
            </form>
            @else
            <button class="btn btn-warning" id="nperror" style="padding: 3px 12px" type="button">Already Applied</button> 
            @endif
        @else    
          <button class="btn btn-success" id="npcomplete" style="padding: 3px 12px" type="button">Apply Now</button>   
        @endif
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
                    <th scope="row">Tutoring Duration</th>
                    <td>
                        {{$offer->tutoring_duration}}  Hour
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
                        
                        @if($offer->tutor_gender == null)  Any  @else {{$offer->tutor_gender}} @endif
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
@endsection