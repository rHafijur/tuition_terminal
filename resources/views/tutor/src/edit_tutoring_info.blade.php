<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Select2 (Default Theme)</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="">
        <div class="form-group">
            <label>Category</label>
            <select onchange="categoryChanged(this.value)" value="1" id="select2cat"  class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
              @foreach ($categories as $category)
              <option value="{{$category->id}}" data-select2-id="{{$category->id}}">{{$category->title}}</option>
              @endforeach

            </select>
          </div>
        <div  class="form-group">
            <label>Courses</label>
            <select id="select2cour" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
              @foreach ($categories as $category)
              @php
                  $categoryTitle=$category->title;
              @endphp
                <optgroup label="{{$categoryTitle}}">
                    @foreach ($category->courses as $course)
                    <option style="display: none" value="{{$course->id}}" data-select2-id="{{$course->id}}">{{$course->title}}</option>
                    @endforeach
                </optgroup>
              @endforeach

            </select>
          </div>
      </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      
    </div>
  </div>
  <script>
      const resource=JSON.parse(`{!!json_encode($categories_collection)!!}`);
      const courses_resource=JSON.parse(`{!!json_encode($courses_collection)!!}`);
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
      function generateCourses(ids){
        var  html='';
        for(var id of ids){
            var category = getCategory(id);
            if(category!=null){
                if(category.courses.length>0){
                    var chtml=`<optgroup label="`+category.title+`">`;
                    for(var c of category.courses){
                        chtml+=`<option  value="`+c.id+`" data-select2-id="`+c.id+`">`+c.title+`</option>`;
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
        for(var id of ids){
            var course = getCourse(id);
            if(course!=null){
                if(course.subjects.length>0){
                    var shtml=`<optgroup label="`+getCategory(course.category_id).title+` - `+course.title+`">`;
                    for(var s of course.subjects){
                        shtml+=`<option  value="`+s.id+`" data-select2-id="`+s.id+`">`+s.title+`</option>`;
                    }
                    shtml+=`</optgroup>`;
                    html+=shtml;
                }
            }
        }
        return html;
      }
  </script>