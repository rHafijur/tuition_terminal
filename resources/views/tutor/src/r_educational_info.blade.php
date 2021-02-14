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
        <form action="{{route('educational_info')}}" method="post">
          @csrf
            <div class="card border-primary">
              <div class="card-header bg-success">
                {{App\Degree::find(6)->title}}
                @php
                    $ssc=$tutor->tutor_degrees()->where('degree_id',6)->first();
                @endphp
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group ins_6">
                        <label>Institute</label>
                        <select required name="institute[6]"   class="select2_6 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                          <option value="">Select Institute</option>
                          @foreach (App\Institute::OrderBy('title','asc')->get() as $institute)
                          @php
                              $selected="";
                              if($ssc!=null && $ssc->institute_id==$institute->id){
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
                      <label>Curriculum</label>
                      <select required name="curriculum[6]"   class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="">Select Curriculum</option>
                        @foreach (App\Curriculum::OrderBy('title','asc')->get() as $curriculum)
                        @php
                            $selected="";
                            if($ssc!=null && $ssc->curriculum_id==$curriculum->id){
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
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="form-group">
                        <label>Board </label>
                        <select required name="education_board[6]" class="form-control">
                          <option value="">Select Board</option>
                          <option @if($ssc!=null && $ssc->education_board=="Barisal") selected @endif value="Barisal">Barisal</option>
                          <option @if($ssc!=null && $ssc->education_board=="Chittagong") selected @endif value="Chittagong">Chittagong</option>
                          <option @if($ssc!=null && $ssc->education_board=="Comilla") selected @endif value="Comilla">Comilla</option>
                          <option @if($ssc!=null && $ssc->education_board=="Dhaka") selected @endif value="Dhaka">Dhaka</option>
                          <option @if($ssc!=null && $ssc->education_board=="Jessore") selected @endif value="Jessore">Jessore</option>
                          <option @if($ssc!=null && $ssc->education_board=="Mymensingh") selected @endif value="Mymensingh">Mymensingh</option>
                          <option @if($ssc!=null && $ssc->education_board=="Rajshahi") selected @endif value="Rajshahi">Rajshahi</option>
                          <option @if($ssc!=null && $ssc->education_board=="Sylhet") selected @endif value="Sylhet">Sylhet</option>
                          <option @if($ssc!=null && $ssc->education_board=="Dinajpur") selected @endif value="Dinajpur">Dinajpur</option>
                          <option @if($ssc!=null && $ssc->education_board=="Technical") selected @endif value="Technical">Technical</option>
                          <option @if($ssc!=null && $ssc->education_board=="Madrasah") selected @endif value="Madrasah">Madrasah</option>
                          <option @if($ssc!=null && $ssc->education_board=="Cambridge") selected @endif value="Cambridge">Cambridge</option>
                          <option @if($ssc!=null && $ssc->education_board=="Ed-excel") selected @endif value="Ed-excel">Ed-excel</option>
                          <option @if($ssc!=null && $ssc->education_board=="IB") selected @endif value="IB">IB</option>
                        </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Group </label>
                      <select required name="group_or_major[6]" class="form-control">
                        <option value="">Select Group</option>
                        <option @if($ssc!=null && $ssc->group_or_major=="Arts") selected @endif value="Arts">Arts</option>
                        <option @if($ssc!=null && $ssc->group_or_major=="Commerce") selected @endif value="Commerce">Commerce</option>
                        <option @if($ssc!=null && $ssc->group_or_major=="Science") selected @endif value="Science">Science</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group">
                        <label>Passing Year </label>
                        <input required type="text" value="{{$ssc!=null?$ssc->passing_year:''}}"  class="form-control" name="passing_year[6]">
                      </div>
                  </div>
                  <div class="col">
                    <div  class="form-group">
                        <label>Result</label>
                        <input required value="{{$ssc!=null?$ssc->gpa:''}}" type="text"  class="form-control" name="gpa[6]">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card border-primary">
              <div class="card-header bg-success">
                {{App\Degree::find(5)->title}}
                @php
                    $hsc=$tutor->tutor_degrees()->where('degree_id',5)->first();
                    $is_diploma=$tutor->tutor_personal_information->is_diploma_student;
                @endphp
                <div class="card-tools">
                  <div class="custom-control custom-checkbox checkbox-lg align-middle">
                    <input @if($is_diploma!=0) checked @endif onchange="isDiplomaChanged()" type="checkbox" value="1" class="custom-control-input" name="is_diploma_student" id="has_diploma">
                    <label class="custom-control-label" for="has_diploma">I am a Diploma Student</label>
                  </div>
                </div>
              </div>
              <div class="card-body" id="hsc">
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group ins_5" data-ins="5">
                        <label>Institute</label>
                        <select required name="institute[5]"   class="select2_5 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                          <option value="">Select Institute</option>
                          @foreach (App\Institute::OrderBy('title','asc')->get() as $institute)
                          @php
                              $selected="";
                              if($hsc!=null && $hsc->institute_id==$institute->id){
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
                      <label>Curriculum</label>
                      <select required name="curriculum[5]"   class="select2hsc select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="">Select Curriculum</option>
                        @foreach (App\Curriculum::OrderBy('title','asc')->get() as $curriculum)
                        @php
                            $selected="";
                            if($hsc!=null && $hsc->curriculum_id==$curriculum->id){
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
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="form-group">
                        <label>Board </label>
                        <select required name="education_board[5]" class="form-control">
                          <option value="">Select Board</option>
                          <option @if($hsc!=null && $hsc->education_board=="Barisal") selected @endif value="Barisal">Barisal</option>
                          <option @if($hsc!=null && $hsc->education_board=="Chittagong") selected @endif value="Chittagong">Chittagong</option>
                          <option @if($hsc!=null && $hsc->education_board=="Comilla") selected @endif value="Comilla">Comilla</option>
                          <option @if($hsc!=null && $hsc->education_board=="Dhaka") selected @endif value="Dhaka">Dhaka</option>
                          <option @if($hsc!=null && $hsc->education_board=="Jessore") selected @endif value="Jessore">Jessore</option>
                          <option @if($hsc!=null && $hsc->education_board=="Mymensingh") selected @endif value="Mymensingh">Mymensingh</option>
                          <option @if($hsc!=null && $hsc->education_board=="Rajshahi") selected @endif value="Rajshahi">Rajshahi</option>
                          <option @if($hsc!=null && $hsc->education_board=="Sylhet") selected @endif value="Sylhet">Sylhet</option>
                          <option @if($hsc!=null && $hsc->education_board=="Dinajpur") selected @endif value="Dinajpur">Dinajpur</option>
                          <option @if($hsc!=null && $hsc->education_board=="Technical") selected @endif value="Technical">Technical</option>
                          <option @if($hsc!=null && $hsc->education_board=="Madrasah") selected @endif value="Madrasah">Madrasah</option>
                          <option @if($hsc!=null && $hsc->education_board=="Cambridge") selected @endif value="Cambridge">Cambridge</option>
                          <option @if($hsc!=null && $hsc->education_board=="Ed-excel") selected @endif value="Ed-excel">Ed-excel</option>
                          <option @if($hsc!=null && $hsc->education_board=="IB") selected @endif value="IB">IB</option>
                        </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Group </label>
                      <select required name="group_or_major[5]" class="form-control">
                        <option value="">Select Group</option>
                        <option @if($hsc!=null && $hsc->group_or_major=="Arts") selected @endif value="Arts">Arts</option>
                        <option @if($hsc!=null && $hsc->group_or_major=="Commerce") selected @endif value="Commerce">Commerce</option>
                        <option @if($hsc!=null && $hsc->group_or_major=="Science") selected @endif value="Science">Science</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group">
                        <label>Passing Year </label>
                        <input required type="text" value="{{$hsc!=null?$hsc->passing_year:''}}"  class="form-control" name="passing_year[5]">
                      </div>
                  </div>
                  <div class="col">
                    <div  class="form-group">
                        <label>Result</label>
                        <input required value="{{$hsc!=null?$hsc->gpa:''}}" type="text"  class="form-control" name="gpa[5]">
                      </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="card border-primary">
              <div class="card-header bg-success">
                {{App\Degree::find(4)->title}}
                @php
                    $bachelors=$tutor->tutor_degrees()->where('degree_id',4)->first();
                @endphp
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group ins_4" data-ins="4">
                        <label>Institute</label>
                        <select required name="institute[4]"   class="select2_4 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                          <option value="">Select Institute</option>
                          @foreach (App\Institute::OrderBy('title','asc')->get() as $institute)
                          @php
                              $selected="";
                              if($bachelors!=null && $bachelors->institute_id==$institute->id){
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
                      <label>University Type</label>
                      <select required name="university_type[4]"  class="form-control">
                        <option value="">Select University Type</option>
                        <option @if($bachelors!=null && $bachelors->university_type=="National University") selected @endif value="National University">National University</option>
                        <option @if($bachelors!=null && $bachelors->university_type=="Private University") selected @endif value="Private University">Private University</option>
                        <option @if($bachelors!=null && $bachelors->university_type=="Public University") selected @endif value="Public University">Public University</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="form-group">
                      <label>Study Type</label>
                      <select required name="study_type_id[4]"   class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="">Select Study Type</option>
                        @foreach (App\StudyType::OrderBy('title','asc')->get() as $study_type)
                        @php
                            $selected="";
                            if($bachelors!=null && $bachelors->study_type_id==$study_type->id){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                        @endphp 
                          <option {{$selected}} value="{{$study_type->id}}" data-select2-id="{{$study_type->id}}">{{$study_type->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Department</label>
                      {{-- <input required type="text" name="department[4]" value="{{$bachelors!=null?$bachelors->department:''}}"  class="form-control"> --}}
                      <select required name="department[4]"   class="select2 form-control select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="">Select Department</option>
                        @foreach (App\Department::OrderBy('title','asc')->get() as $department)
                        @php
                            $selected="";
                            if($bachelors!=null && $bachelors->department==$department->title){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                        @endphp 
                          <option {{$selected}} value="{{$department->title}}" data-select2-id="{{$department->title}}">{{$department->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group">
                        <label>CGPA / Current CGPA</label>
                        <input required value="{{$bachelors!=null?$bachelors->gpa:''}}" type="text"  class="form-control" name="gpa[4]">
                      </div>
                  </div>
                  <div class="col">
                    <div  class="form-group">
                        <label>Semester / Year</label>
                        <input required type="text" value="{{$bachelors!=null?$bachelors->year_or_semester:''}}"  class="form-control" name="year_or_semester[4]">
                      </div>
                  </div>
                </div>
                <div class="form-group form-check">
                  @php
                      $checked="";
                      if($bachelors!=null && $bachelors->currently_studying==1){
                          $checked="checked";
                      }else{
                          $checked="";
                      }
                  @endphp 
                  <input {{$checked}} type="checkbox" name="currently_studing[4]" value="1" class="form-check-input" id="currently_studing">
                  <label class="form-check-label" for="currently_studing">I'm currently studying here</label>
                </div>
              </div>
            </div>

            <div class="card border-primary">
              <div class="card-header bg-success">
                {{App\Degree::find(3)->title}}
                @php
                    $masters=$tutor->tutor_degrees()->where('degree_id',3)->first();
                @endphp
                <div class="card-tools">
                  <div class="custom-control custom-checkbox checkbox-lg align-middle">
                    <input @if($masters!=null) checked @endif onchange="hasMasterChanged()" type="checkbox" value="1" class="custom-control-input" name="has_masters" id="has_masters">
                    <label class="custom-control-label" for="has_masters">If Applicable</label>
                  </div>
                </div>
              </div>
              <div class="card-body" id="masters">
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group ins_3">
                        <label>Institute</label>
                        <select required name="institute[3]"   class="select2_3 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                          <option value="">Select Institute</option>
                          @foreach (App\Institute::OrderBy('title','asc')->get() as $institute)
                          @php
                              $selected="";
                              if($masters!=null && $masters->institute_id==$institute->id){
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
                      <label>University Type</label>
                      <select required name="university_type[3]"  class="form-control">
                        <option value="">Select University Type</option>
                        <option @if($masters!=null && $masters->university_type=="National University") selected @endif value="National University">National University</option>
                        <option @if($masters!=null && $masters->university_type=="Private University") selected @endif value="Private University">Private University</option>
                        <option @if($masters!=null && $masters->university_type=="Public University") selected @endif value="Public University">Public University</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="form-group">
                      <label>Study Type</label>
                      <select required name="study_type_id[3]"   class="select2_masters select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="">Select Study Type</option>
                        @foreach (App\StudyType::OrderBy('title','asc')->get() as $study_type)
                        @php
                            $selected="";
                            if($masters!=null && $masters->study_type_id==$study_type->id){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                        @endphp 
                          <option {{$selected}} value="{{$study_type->id}}" data-select2-id="{{$study_type->id}}">{{$study_type->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Department</label>
                      {{-- <input required type="text" name="department[3]" value="{{$masters!=null?$masters->department:''}}"  class="form-control"> --}}
                      <select required name="department[3]"   class="select2_masters select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="">Select Study Type</option>
                        @foreach (App\Department::OrderBy('title','asc')->get() as $department)
                        @php
                            $selected="";
                            if($masters!=null && $masters->department==$department->title){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                        @endphp 
                          <option {{$selected}} value="{{$department->title}}" data-select2-id="{{$department->title}}">{{$department->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div  class="form-group">
                        <label>CGPA / Current CGPA</label>
                        <input required value="{{$masters!=null?$masters->gpa:''}}" type="text"  class="form-control" name="gpa[3]">
                      </div>
                  </div>
                  <div class="col">
                    <div  class="form-group">
                        <label>Semester / Year</label>
                        <input required type="text" value="{{$masters!=null?$masters->year_or_semester:''}}"  class="form-control" name="year_or_semester[3]">
                      </div>
                  </div>
                </div>
                <div class="form-group form-check">
                  @php
                      $checked="";
                      if($masters!=null && $masters->currently_studying==1){
                          $checked="checked";
                      }else{
                          $checked="";
                      }
                  @endphp 
                  <input {{$checked}} type="checkbox" name="currently_studing[3]" value="1" class="form-check-input" id="currently_studing_3">
                  <label class="form-check-label" for="currently_studing">I'm currently studying here</label>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <a href="{{route('tutor_registration').'?tab=pi'}}">
                <button type="button" class="btn btn-secondary">Back</button>
              </a>
              <button type="submit" class="btn btn-primary float-right">Update Changes & Next</button>
            </div>
          </div>
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      
    </div>
  </div>