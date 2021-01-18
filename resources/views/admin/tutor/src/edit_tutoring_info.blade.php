<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Tutoring Information</h3>

      {{-- <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div> --}}
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form method="POST" action="{{action('AdminTutorsController@postUpdate_ti')}}">
        <input type="hidden" name="tutor_id" value="{{$tutor->id}}">
        @csrf
        <div class="form-group">
            <label>Category</label>
            <select name="categories[]" onchange="categoryChanged(this)" id="select2cat"  class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
              @php
                  $cats_arr=[];
                  $current_cats=$tutor->categories;
              @endphp
              @foreach ($categories as $category)
              @php
                  $cat_selected="";
                  foreach($current_cats as $current_cat){
                    if($current_cat->id==$category->id){
                      $cats_arr[]=$category->id;
                      $cat_selected="selected";
                    break;
                    }
                  }
              @endphp
              <option {{$cat_selected}} value="{{$category->id}}" data-select2-id="{{$category->id}}">{{$category->title}}</option>
              @endforeach

            </select>
          </div>
        <div  class="form-group">
            <label>Courses</label>
            <select name="courses[]"  id="select2cour" onchange="courseChanged(this)" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
              @php
                  $curs_arr=[];
                  $current_curs=$tutor->courses;
              @endphp
              @foreach ($categories as $category)
              @php
                  if(!in_array($category->id,$cats_arr)){
                    continue;
                  }
                  $categoryTitle=$category->title;
              @endphp
                @if ($category->courses->count()>0)
                    <optgroup label="{{$categoryTitle}}">
                        @foreach ($category->courses as $course)
                        @php
                        $course_selected="";
                        foreach($current_curs as $current_cur){
                          if($current_cur->id==$course->id){
                            $curs_arr[]=$course->id;
                            $course_selected="selected";
                          break;
                          }
                        }
                        @endphp
                        <option {{$course_selected}} value="{{$course->id}}" data-select2-id="{{$course->id}}">{{$course->title}}</option>
                        @endforeach
                    </optgroup>
                @endif
              @endforeach

            </select>
          </div>
        <div  class="form-group">
            <label>Subject</label>
            <select name="subjects[]" id="select2sub" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
              @php
                  $current_subs=$tutor->course_subjects;
                  // dd(auth()->user());
              @endphp
              @foreach ($categories as $category)
                @php
                    if(!in_array($category->id,$cats_arr)){
                    continue;
                  }
                @endphp
                @foreach ($category->courses as $course)
                    @php
                        if(!in_array($course->id,$curs_arr)){
                          continue;
                        }
                        $subjects=$course->subjects;
                    @endphp
                    @if ($subjects->count()>0)
                    <optgroup label="{{$category->title}} - {{$course->title}}">
                        @foreach ($subjects as $subject)
                                @php
                                    $sub_selected="";
                                    foreach($current_subs as $current_sub){
                                      if($current_sub->id==$subject->pivot->id){
                                        $sub_selected="selected";
                                      break;
                                      }
                                    }
                                @endphp
                                <option {{$sub_selected}}  value="{{$subject->pivot->id}}" data-select2-id="{{$subject->pivot->id}}">{{$subject->title}}</option>
                        @endforeach
                    </optgroup>
                    @endif
                @endforeach
              @endforeach
            </select>
          </div>
          <div class="form-row">
              <div class="col">
                <div  class="form-group">
                    <label>City</label>
                    <select name="city" id="ti_city" onchange="cityChangedFromTutorInfo(this)" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                      @foreach (App\City::OrderBy('name','asc')->get() as $city)
                        <option @if($tutor->city_id==$city->id) selected @endif  value="{{$city->id}}" data-select2-id="{{$city->id}}">{{$city->name}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="col">
                <div  class="form-group">
                    <label>Location</label>
                    <select name="locations" id="ti_location" class="select2 select2-hidden-accessible"  data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                      @if ($tutor->city!=null)
                          @foreach ($tutor->city->locations as $location)
                          <option @if($tutor->location_id==$location->id) selected @endif  value="{{$location->id}}" data-select2-id="{{$location->id}}">{{$location->name}}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
              </div>
          </div>
          <div  class="form-group">
            <label>Prefered Location</label>
            <select name="prefered_locations[]" id="prefered_location" class="select2 select2-hidden-accessible" multiple=""  data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
              @if ($tutor->city!=null)
                  @php
                      $prefered_locs=$tutor->prefered_locations;
                  @endphp
                  @foreach ($tutor->city->locations as $location)
                    @php
                    $loc_selected="";
                      foreach($prefered_locs as $loc){
                        if($loc->id==$location->id){
                          $loc_selected="selected";
                        break;
                        }
                      }
                    @endphp
                  <option {{$loc_selected}} value="{{$location->id}}" data-select2-id="{{$location->id}}">{{$location->name}}</option>
                  @endforeach
              @endif
            </select>
          </div>

          <div  class="form-group">
            <label>Total years of Tutoring Experience</label>
            <input name="tutoring_experience" type="number" class="form-control" value="{{$tutor->tutoring_experience}}">
          </div>
          <div  class="form-group">
            <label>Tutoring Experience In Detail</label>
            <textarea name="tutoring_experience_details" class="form-control" cols="30" rows="5">{{$tutor->tutoring_experience_details}}</textarea>
          </div>
          
          <div  class="form-group">
            <label>Availablity</label>
            <select name="days[]"  class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
             @php
                 $cur_days=$tutor->days
             @endphp
              @foreach (App\Day::all() as $day)
                @php
                    $day_selected="";
                    foreach($cur_days as $cur_day){
                      if($cur_day->id==$day->id){
                        $day_selected="selected";
                      break;
                      }
                    }
                @endphp
                <option {{$day_selected}} value="{{$day->id}}" data-select2-id="{{$day->id}}">{{$day->title}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-row">
              <div class="col">
                <div  class="form-group">
                    <label>Available From</label>
                    <input value="{{$tutor->available_from}}" name="available_from" type="time" class="form-control">
                </div>
              </div>
              <div class="col">
                <div  class="form-group">
                    <label>Available From</label>
                    <input value="{{$tutor->available_to}}" name="available_to" type="time" class="form-control">
                </div>
              </div>
          </div>
          <div class="form-row">
              <div class="col">
                <div  class="form-group">
                    <label>Expected Salary</label>
                    <input value="{{$tutor->expected_salary}}" name="expected_salary" type="number" class="form-control">
                </div>
              </div>
              <div class="col">
                <div  class="form-group">
                    <label>Prefered Teaching Method</label>
                    <select name="teaching_methods[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                      @php
                          $cur_tms=$tutor->teaching_methods;
                      @endphp
                      @foreach (App\TeachingMethod::all() as $method)
                        @php
                            $tm_selected="";
                            foreach($cur_tms as $cur_tm){
                              if($cur_tm->id==$method->id){
                                $tm_selected="selected";
                              }
                            }
                        @endphp
                        <option {{$tm_selected}}  value="{{$method->id}}" data-select2-id="{{$method->id}}">{{$method->title}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
          </div>
          <button class="btn btn-success">Update Change</button>
      </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      
    </div>
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
      function generateCourses(ids){
        var  html='';
        var selectedIds=$("#select2cour").val();
        // console.log(selectedIds);
        var selected="";
        for(var id of ids){
            var category = getCategory(id);
            if(category!=null){
                if(category.courses.length>0){
                    var chtml=`<optgroup label="`+category.title+`">`;
                    for(var c of category.courses){
                        if(selectedIds.includes(String(c.id))){
                            selected="selected";
                            // console.log(true);
                        }else{
                            selected="";
                        }
                        chtml+=`<option `+selected+`  value="`+c.id+`" data-select2-id="`+c.id+`">`+c.title+`</option>`;
                    }
                    chtml+=`</optgroup>`;
                    html+=chtml;
                }
            }
        }
        return html;
      }
      function generateSubjects(ids){
        var  html='';
        var selectedIds=$("#select2sub").val();
        var selected="";
        for(var id of ids){
            var course = getCourse(id);
            if(course!=null){
                if(course.subjects.length>0){
                    var shtml=`<optgroup label="`+getCategory(course.category_id).title+` - `+course.title+`">`;
                    for(var s of course.subjects){
                        if(selectedIds.includes(String(s.pivot.id))){
                            selected="selected";
                        }else{
                            selected="";
                        }
                        shtml+=`<option `+selected+` value="`+s.pivot.id+`" data-select2-id="`+s.pivot.id+`">`+s.title+`</option>`;
                    }
                    shtml+=`</optgroup>`;
                    html+=shtml;
                }
            }
        }
        return html;
      }
      function categoryChanged(obj){
          var ids=$(obj).val();
        //   console.log(ids);
        //   console.log(generateCourses(ids));
        $("#select2cour").html(generateCourses(ids));
        $("#select2cour").select2();
        courseChanged(document.getElementById("select2cour"));
      }

      function courseChanged(obj){
          var ids=$(obj).val();
        //   console.log(ids);
        //   console.log(generateCourses(ids));
        $("#select2sub").html(generateSubjects(ids));
        $("#select2sub").select2();
      }

      function cityChangedFromTutorInfo(obj){
          var city=getCity($(obj).val());
          console.log(city);
          var html="";
          for(var loc of city.locations){
            html+=`<option value="`+loc.id+`" data-select2-id="`+loc.id+`">`+loc.name+`</option>`;
          }
          console.log(html);
          $("#prefered_location").html(html);
          $("#prefered_location").select2();
          $("#ti_location").html(html);
          
          $("#ti_location").select2();

      }
      
  </script>
  @push('bottom')
    <script>
        $(function(){
            // cityChangedFromTutorInfo(document.getElementById('ti_city'));
        });
    </script>
  @endpush