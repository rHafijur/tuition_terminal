<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Tutoring Information</h3>

      <div class="card-tools">
        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> --}}
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{route('update_educational_info')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>Education Level</label>
                      <select name="degree"  class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        @foreach (App\Degree::OrderBy('title','asc')->get() as $degree)
                            @php
                                $selected="";
                                if($tutor->tutor_degree!=null && $tutor->tutor_degree->degree_id==$degree->id){
                                    $selected="selected";
                                }else{
                                    $selected="";
                                }
                            @endphp
                          <option {{$selected}} data-select2-id="{{$degree->id}}" value="{{$degree->id}}">{{$degree->title}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col">
                  <div  class="form-group">
                      <label>Degree Title</label>
                      <input value="{{$tutor->tutor_degree!=null?$tutor->tutor_degree->degree_title:''}}" type="text"  class="form-control" name="degree_title">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>Institute</label>
                      <select name="institute"   class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        @foreach (App\Institute::OrderBy('title','asc')->get() as $institute)
                        @php
                            $selected="";
                            if($tutor->tutor_degree!=null && $tutor->tutor_degree->institute_id==$institute->id){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                        @endphp  
                        <option {{$selected}} value="{{$institute->id}}" data-select2-id="{{$institute->id}}">{{$institute->title}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col">
                  <div  class="form-group">
                      <label>Student ID <small>Optional</small></label>
                      <input value="{{$tutor->tutor_degree!=null?$tutor->tutor_degree->id_no:''}}" type="text"  class="form-control" name="id_no">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>Curriculum</label>
                      <select name="curriculum"   class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        @foreach (App\Curriculum::OrderBy('title','asc')->get() as $curriculum)
                        @php
                            $selected="";
                            if($tutor->tutor_degree!=null && $tutor->tutor_degree->curriculum_id==$curriculum->id){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                        @endphp 
                          <option {{$selected}} value="{{$curriculum->id}}" data-select2-id="{{$curriculum->id}}">{{$curriculum->title}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col">
                  <div  class="form-group">
                      <label>Group or Major</label>
                      <input type="text" value="{{$tutor->tutor_degree!=null?$tutor->tutor_degree->group_or_major:''}}"  class="form-control" name="group_or_major">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>Passing Year / Expected Passing Year </label>
                      <input type="text" value="{{$tutor->tutor_degree!=null?$tutor->tutor_degree->passing_year:''}}"  class="form-control" name="passing_year">
                    </div>
                </div>
                <div class="col">
                  <div  class="form-group">
                      <label>GPA/CGPA</label>
                      <input value="{{$tutor->tutor_degree!=null?$tutor->tutor_degree->gpa:''}}" type="text"  class="form-control" name="gpa">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>Education Board <small>If applicable</small></label>
                      <input value="{{$tutor->tutor_degree!=null?$tutor->tutor_degree->education_board:''}}" type="text"  class="form-control" name="education_board">
                    </div>
                </div>
                </div>
                <div class="form-group form-check">
                    @php
                        $checked="";
                        if($tutor->tutor_degree!=null && $tutor->tutor_degree->currently_studying==1){
                            $checked="checked";
                        }else{
                            $checked="";
                        }
                    @endphp 
                    <input {{$checked}} type="checkbox" name="currently_studing" value="1" class="form-check-input" id="currently_studing">
                    <label class="form-check-label" for="currently_studing">I'm currently studying here</label>
                  </div>
                <button type="submit" class="btn btn-primary">Update Change</button>
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      
    </div>
  </div>
