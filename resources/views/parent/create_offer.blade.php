@push('css')
      <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('js')
    <!-- Select2 -->
<script src="{{asset('admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
@extends('parent.layouts.master',['title'=>'Create Offer'])

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
      <form id="offer_form" action="{{route('parent.create_offer')}}" method="POST">
        @csrf
        <div id="tab_content" class="tab-content">
            <div class="active tab-pane" id="student_information">
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select onchange="categoryChanged(this)" class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories_collection as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Category is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select onchange="courseChanged(this)" class="form-control" name="course_id" id="course_id">
                    </select>
                    <div class="invalid-feedback">
                        Course is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_subject_ids">Subjects</label>
                    <select class="form-control select2 select2-hidden-accessible" name="course_subject_ids[]" id="course_subject_ids"  multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                    </select>
                    <div class="invalid-feedback">
                        Subjects are Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="days_in_week">Days in Week</label>
                    <input class="form-control" name="days_in_week" id="days_in_week" type="number" max="7" min="1">
                    <div class="invalid-feedback">
                        Days field is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="time">Tutoring Time</label>
                    <input class="form-control" name="time" id="time" type="time">
                    <div class="invalid-feedback">
                        Tutoring Time is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="teaching_method_id">Teaching Method</label>
                    <select class="form-control" name="teaching_method_id" id="teaching_method_id">
                        <option value="">Select Teaching Method</option>
                        @foreach (App\TeachingMethod::all() as $method)
                            <option value="{{$method->id}}">{{$method->title}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Teaching Method is Required!
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="min_salary">Minimum Salary</label>
                        <input class="form-control" name="min_salary" id="min_salary" type="number">
                        <div class="invalid-feedback">
                            Minimum Salary is Required!
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="max_salary">Maximum Salary</label>
                        <input class="form-control" name="max_salary" id="max_salary" type="number">
                        <div class="invalid-feedback">
                            Maximum is Required!
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name_of_institute">Name Of Institute</label>
                    <input class="form-control" name="name_of_institute" id="name_of_institute" type="text">
                    <div class="invalid-feedback">
                        Name of Institute is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="number_of_students">Number of Students</label>
                    <input class="form-control" name="number_of_students" id="number_of_students" type="text">
                    <div class="invalid-feedback">
                        Number of Students is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="student_gender">Student's Gender</label>
                    <select class="form-control" name="student_gender" id="student_gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
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
                    <label for="tutor_gender">Tutor's Gender</label>
                    <select class="form-control" name="tutor_gender" id="tutor_gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <div class="invalid-feedback">
                        Tutor's Gender is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="requirements">Tutor Requirements</label>
                    <textarea class="form-control" name="requirements" id="requirements"></textarea>
                    <div class="invalid-feedback">
                        Tutor Requirements are Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="hiring_from">When are you looking to hire?</label>
                    <input class="form-control" name="hiring_from" id="hiring_from" type="date">
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
                    <select onchange="cityChanged(this)" class="form-control" name="city_id" id="city_id">
                        <option value="">Select City</option>
                        @foreach ($city_collection as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        City is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="location_id">Location</label>
                    <select class="form-control" name="location_id" id="location_id">
                    </select>
                    <div class="invalid-feedback">
                        Location is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Full Address</label>
                    <input class="form-control" name="address" id="address" type="address">
                    <div class="invalid-feedback">
                        Full Address is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" id="name" type="text">
                    <div class="invalid-feedback">
                        Name is Required!
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control" name="phone" id="phone" type="phone">
                    <div class="invalid-feedback">
                        Phone is Required!
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
            var tab_inps=$(tabContent[index-1]).find('.form-control');
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
        var tab_inps=$(tabContent[2]).find('.form-control');
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
    $("#city_id").select2();
</script>

@endpush