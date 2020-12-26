@push('css')
      <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('js')
    <!-- Select2 -->
<script src="{{asset('admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
@extends('parent.layouts.master',['title'=>'Edit Offer'])

@section('content')
<div class="card">
    <div class="card-header p-2">
      <ul id="tab_nav" class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active">Student Information</a></li>
        <li class="nav-item"><a class="nav-link">Tutor Requirement</a></li>
        <li class="nav-item"><a class="nav-link">Contact Information</a></li>
      </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
      <form id="offer_form" action="{{route('parent.update_offer')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$offer->id}}">
        <div id="tab_content" class="tab-content">
            <div class="active tab-pane" id="student_information">
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select onchange="categoryChanged(this)" class="form-control required-input" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories_collection as $category)
                            <option @if($category->id==$offer->category_id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Category is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select onchange="courseChanged(this)" class="form-control required-input" name="course_id" id="course_id">
                        @php
                            $ocs=$offer->course_subjects;
                        @endphp
                        @foreach ($offer->category->courses as $course)
                            <option @if($course->id==$offer->course_id) selected @endif value="{{$course->id}}">{{$course->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Course is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_subject_ids">Subjects</label>
                    @php
                        $ocs=$offer->course_subjects;
                    @endphp
                    <select class="form-control required-input select2 select2-hidden-accessible" name="course_subject_ids[]" id="course_subject_ids"  multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        @foreach ($offer->course->course_subjects as $cs)
                            @php
                                $isSelected="";
                                foreach ($ocs as $oc) {
                                    if($oc->id==$cs->id){
                                        $isSelected="selected";
                                    break;
                                    }
                                }
                            @endphp
                            <option {{$isSelected}} value="{{$cs->id}}">{{$cs->course->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Subjects are Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="days_in_week">Days in Week</label>
                    <input class="form-control required-input" name="days_in_week" value="{{$offer->days_in_week}}" id="days_in_week" type="number" max="7" min="1">
                    <div class="invalid-feedback">
                        Days field is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="time">Tutoring Time</label>
                    <input class="form-control required-input" value="{{$offer->time}}" name="time" id="time" type="time">
                    <div class="invalid-feedback">
                        Tutoring Time is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="teaching_method_id">Teaching Method</label>
                    <select class="form-control required-input" name="teaching_method_id" id="teaching_method_id">
                        <option value="">Select Teaching Method</option>
                        @foreach (App\TeachingMethod::all() as $method)
                            <option @if($method->id==$offer->teaching_method_id) selected @endif value="{{$method->id}}">{{$method->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Teaching Method is Required!
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="min_salary">Minimum Salary</label>
                        <input class="form-control required-input" value="{{$offer->min_salary}}" name="min_salary" id="min_salary" type="number">
                        <div class="invalid-feedback">
                            Minimum Salary is Required!
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="max_salary">Maximum Salary</label>
                        <input class="form-control required-input" value="{{$offer->max_salary}}" name="max_salary" id="max_salary" type="number">
                        <div class="invalid-feedback">
                            Maximum is Required!
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name_of_institute">Name Of Institute</label>
                    <input class="form-control required-input" value="{{$offer->name_of_institute}}" name="name_of_institute" id="name_of_institute" type="text">
                    <div class="invalid-feedback">
                        Name of Institute is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="number_of_students">Number of Students</label>
                    <input class="form-control required-input" value="{{$offer->number_of_students}}" name="number_of_students" id="number_of_students" type="text">
                    <div class="invalid-feedback">
                        Number of Students is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="student_gender">Student's Gender</label>
                    <select class="form-control required-input" name="student_gender" id="student_gender">
                        <option @if($offer->student_gender=='male') selected @endif value="male">Male</option>
                        <option @if($offer->student_gender=='female') selected @endif value="female">Female</option>
                    </select>
                    <div class="invalid-feedback">
                        Student's Gender is Required!
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" onclick="goToTabIndex(1,true)" class="float-right btn btn-success">Next</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tutor_requirement">
                <div class="form-group">
                    <label for="tutor_category_id">Medium</label>
                    <select class="form-control required-input" name="tutor_category_id" id="tutor_category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories_collection as $category)
                            <option @if($offer->tutor_category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Medium is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_university_id">University</label>
                    <select class="form-control required-input select2 select2-hidden-accessible" name="tutor_university_id" id="tutor_university_id" data-placeholder="Select a University" data-select2-id="" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="">Select University</option>
                        @foreach ($institutes as $institute)
                            <option @if($offer->tutor_university_id==$institute->id) selected @endif value="{{$institute->id}}" data-select2-id="{{$institute->id}}">{{$institute->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        University is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="university_type">University Type</label>
                    <select class="form-control required-input" name="university_type" id="university_type">
                        <option value="">Select University Type</option>
                        <option @if($offer->university_type=='National University') selected @endif value="National University">National University</option>
                        <option @if($offer->university_type=='Private University') selected @endif value="Private University">Private University</option>
                        <option @if($offer->university_type=='Public University') selected @endif value="Public University">Public University</option>
                    </select>
                    <div class="invalid-feedback">
                        University Type is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_department">Depertment</label>
                    <input class="form-control required-input" name="tutor_department" value="{{$offer->tutor_department}}" id="tutor_department" type="text">
                    <div class="invalid-feedback">
                        Depertment is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_college_id">College</label>
                    <select class="form-control required-input select2 select2-hidden-accessible" name="tutor_college_id" id="tutor_college_id" data-placeholder="Select a College" data-select2-id="" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="">Select College</option>
                        @foreach ($institutes as $institute)
                            <option @if($offer->tutor_college_id==$institute->id) selected @endif value="{{$institute->id}}" data-select2-id="{{$institute->id}}">{{$institute->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        College is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="group">Group</label>
                    <select class="form-control required-input" name="group" id="group">
                        <option value="">Select Group</option>
                        <option @if($offer->group=='Arts') selected @endif value="Arts">Arts</option>
                        <option @if($offer->group=='Commerce') selected @endif value="Commerce">Commerce</option>
                        <option @if($offer->group=='Science') selected @endif value="Science">Science</option>
                    </select>
                    <div class="invalid-feedback">
                        Group is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_school_id">School</label>
                    <select class="form-control required-input select2 select2-hidden-accessible" name="tutor_school_id" id="tutor_school_id" data-placeholder="Select a School" data-select2-id="" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="">Select School</option>
                        @foreach ($institutes as $institute)
                            <option @if($offer->tutor_school_id==$institute->id) selected @endif value="{{$institute->id}}" data-select2-id="{{$institute->id}}">{{$institute->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        School is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_study_type_id">Study Type</label>
                    <select class="form-control required-input" name="tutor_study_type_id" id="tutor_study_type_id">
                        <option value="">Pleae Select a Study Type</option>
                        @foreach (App\StudyType::all() as $study_type)
                        <option @if($offer->tutor_study_type_id==$study_type->id) selected @endif value="{{$study_type->id}}">{{$study_type->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Study Type is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_gender">Tutor's Gender</label>
                    <select class="form-control required-input" name="tutor_gender" id="tutor_gender">
                        <option @if($offer->tutor_gender=='male') selected @endif value="male">Male</option>
                        <option @if($offer->tutor_gender=='female') selected @endif value="female">Female</option>
                    </select>
                    <div class="invalid-feedback">
                        Tutor's Gender is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="tutor_religion_id">Tutor's Religion</label>
                    <select class="form-control required-input" name="tutor_religion_id" id="tutor_religion_id">
                        <option value="">Pleae Select a Religion</option>
                        @foreach (App\Religion::all() as $religion)
                        <option @if($offer->tutor_religion_id==$religion->id) selected @endif value="{{$religion->id}}">{{$religion->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Tutor's Religion is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="requirements">Tutor Requirements</label>
                    <textarea class="form-control required-input" name="requirements" id="requirements">{{$offer->requirements}}</textarea>
                    <div class="invalid-feedback">
                        Tutor Requirements are Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="hiring_from">When are you looking to hire?</label>
                    <input class="form-control required-input" value="{{$offer->hiring_from}}" name="hiring_from" id="hiring_from" type="date">
                    <div class="invalid-feedback">
                        The field is Required!
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" onclick="goToTabIndex(0)" class="float-left btn btn-secondary">Back</button>
                        <button type="button" onclick="goToTabIndex(2,true)" class="float-right btn btn-success">Next</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="contact_information">
                <div class="form-group">
                    <label for="city_id">City</label>
                    <select onchange="cityChanged(this)" class="form-control required-input select2" name="city_id" id="city_id">
                        <option value="">Select City</option>
                        @foreach ($city_collection as $city)
                            <option @if($city->id==$offer->city_id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        City is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="location_id">Location</label>
                    <select class="form-control required-input" name="location_id" data-select2-id="" id="location_id">
                        @foreach ($offer->city->locations as $location)
                            <option @if($location->id==$offer->location_id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Location is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Full Address</label>
                    <input class="form-control required-input" value="{{$offer->address}}" name="address" id="address" type="address">
                    <div class="invalid-feedback">
                        Full Address is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control required-input" value="{{$offer->name}}" name="name" id="name" type="text">
                    <div class="invalid-feedback">
                        Name is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control required-input" value="{{$offer->phone}}" name="phone" id="phone" type="phone">
                    <div class="invalid-feedback">
                        Phone is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input class="form-control required-input" value="{{$offer->email}}" name="email" id="email" type="email">
                    <div class="invalid-feedback">
                        Email is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="additional_contact">Additional contact Number</label>
                    <input class="form-control required-input" value="{{$offer->additional_contact}}" name="additional_contact" id="additional_contact" type="phone">
                    <div class="invalid-feedback">
                        Additional contact Number is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="reference_name">Reference Name <small>(Optional)</small></label>
                    <input class="form-control" value="{{$offer->reference_name}}" name="reference_name" id="reference_name" type="phone">
                    <div class="invalid-feedback">
                        Reference Name is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="reference_contact">Reference Contact Number <small>(Optional)</small></label>
                    <input class="form-control" value="{{$offer->reference_contact}}" name="reference_contact" id="reference_contact" type="phone">
                    <div class="invalid-feedback">
                        Reference Contact Number is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="reference_city_id">Reference City <small>(Optional)</small></label>
                    <select class="form-control select2" name="reference_city_id" id="reference_city_id">
                        <option value="">Select Reference City</option>
                        @foreach ($city_collection as $city)
                            <option @if($offer->reference_city_id==$city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Reference City is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="source">Source</label>
                    <select class="form-control required-input" name="source" id="source">
                        <option value="">Select Source</option>
                        <option @if($offer->source=="Facebook") selected @endif value="Facebook">Facebook</option>
                        <option @if($offer->source=="Google") selected @endif value="Google">Google</option>
                        <option @if($offer->source=="Offline Marketing") selected @endif value="Offline Marketing">Offline Marketing</option>
                        <option @if($offer->source=="Lead Offer") selected @endif value="Lead Offer">Lead Offer</option>
                        <option @if($offer->source=="Other") selected @endif value="Other">Other</option>
                    </select>
                    <div class="invalid-feedback">
                        Source is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="spicial_note">Spicial note <small>(Optional)</small></label>
                    <textarea class="form-control" name="spicial_note" id="spicial_note">{{$offer->spicial_note}}</textarea>
                    <div class="invalid-feedback">
                        Spicial note are Required!
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" onclick="goToTabIndex(1)" class="float-left btn btn-secondary">Back</button>
                        <button onclick="submitForm()" type="button" class="float-right btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
          </div>
      </form>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </div>
  <script>
      const resource=JSON.parse(`{!!json_encode($categories_collection)!!}`);
      const courses_resource=JSON.parse(`{!!json_encode($courses_collection)!!}`);
      const city_resource=JSON.parse(`{!!json_encode($city_collection)!!}`);
      function  getCategory(id){
        for(var cat of resource){
            if(cat.id==id){
                return cat;
            }
        }
        return null;
      }
      function  getCourse(id){
        for(var cour of courses_resource){
            if(cour.id==id){
                return cour;
            }
        }
        return null;
      }
      function  getCity(id){
        for(var cit of city_resource){
            if(cit.id==id){
                return cit;
            }
        }
        return null;
      }
      function generateCourses(cat_id){
        var  html='';
        var selected="";
        var category = getCategory(cat_id);
            if(category!=null){
                if(category.courses.length>0){
                    var chtml=`<option  value="">Select Course</option>`;
                    for(var c of category.courses){
                        chtml+=`<option  value="`+c.id+`" data-select2-id="`+c.id+`">`+c.title+`</option>`;
                    }
                    html+=chtml;
                }
            }
        return html;
      }
      function generateSubjects(id){
        var  html='';
        var course = getCourse(id);
            if(course!=null){
                if(course.subjects.length>0){
                    var shtml=`<option  value="">Select Course</option>`;
                    for(var s of course.subjects){
                        shtml+=`<option value="`+s.pivot.id+`" data-select2-id="`+s.pivot.id+`">`+s.title+`</option>`;
                    }
                    html+=shtml;
                }
            }
        return html;
      }
      function categoryChanged(obj){
          var id=$(obj).val();
        //   console.log(id);
        //   console.log(generateCourses(id));
        $("#course_id").html(generateCourses(id));
        // $("#course_id").select2();
        courseChanged(document.getElementById("course_id"));
      }
      function courseChanged(obj){
          var id=$(obj).val();
        //   console.log(generateCourses(ids));
        $("#course_subject_ids").html(generateSubjects(id));
        $("#course_subject_ids").select2();
      }
      function cityChanged(obj){
          var city=getCity($(obj).val());
          var html="";
          for(var loc of city.locations){
            html+=`<option value="`+loc.id+`" data-select2-id="`+loc.id+`">`+loc.name+`</option>`;
          }
          console.log(html);
          $("#location_id").html(html);
          $("#location_id").select2();

      }
      function goToTabIndex(index,fw=false){
        var tabContent=$("#tab_content").children();
        var tabNav=$("#tab_nav").find('a');
        var invalid_count=0;
        if(fw){
            var tab_inps=$(tabContent[index-1]).find('.required-input');
            for(var inp of tab_inps){
                inp=$(inp);
                if(inp.val()=="" || inp.val()==[] || inp.val()==null){
                    invalid_count++;
                    inp.addClass('is-invalid');
                }else{
                    inp.removeClass('is-invalid');
                }
            }
        }
        if(invalid_count!=0){
            return;
        }
        var i=0;
        for(i=0;i<3;i++){
            $(tabNav[i]).removeClass('active');
            $(tabContent[i]).removeClass('active');
        }
        $(tabNav[index]).addClass('active');
        $(tabContent[index]).addClass('active');
      }
      function submitForm(){
        var tabContent=$("#tab_content").children();
        var invalid_count=0;
        var tab_inps=$(tabContent[2]).find('.required-input');
            for(var inp of tab_inps){
                inp=$(inp);
                if(inp.val()=="" || inp.val()==[] || inp.val()==null){
                    invalid_count++;
                    inp.addClass('is-invalid');
                }else{
                    inp.removeClass('is-invalid');
                }
            }
            if(invalid_count!=0){
                return;
            }
            $("#offer_form").submit();
      }
  </script>
@endsection
@push('js')
<script>
    $("#course_subject_ids").select2();
    // $("#city_id").select2();
    $(".select2").select2();
</script>

@endpush