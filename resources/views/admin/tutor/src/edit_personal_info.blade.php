<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Personal Information</h3>

      <div class="card-tools">
        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> --}}
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @php
            $personal_info=$tutor->tutor_personal_information;
        @endphp
        <form action="{{action('AdminTutorsController@postUpdate_pi')}}" method="post">
            @csrf
            <input type="hidden" name="tutor_id" value="{{$tutor->id}}">
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>Gender</label>
                      <select name="gender" id="gender " class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                          <option value="">Select Gender</option>
                          <option @if($personal_info->gender=='male') selected @endif  value="male" data-select2-id="1">Male</option>
                          <option @if($personal_info->gender=='female') selected @endif  value="female" data-select2-id="2">Female</option>
                      </select>
                    </div>
                </div>
                <div class="col">
                  <div  class="form-group">
                      <label>Blood Group</label>
                      <select name="blood_group" class="form-control">
                        <option value="">Select Blood Group</option>
                        <option @if($personal_info->blood_group=="A+") selected @endif value="A+">A+</option>
                        <option @if($personal_info->blood_group=="A-") selected @endif value="A-">A-</option>
                        <option @if($personal_info->blood_group=="B+") selected @endif value="B+">B+</option>
                        <option @if($personal_info->blood_group=="B-") selected @endif value="B-">B-</option>
                        <option @if($personal_info->blood_group=="O+") selected @endif value="O+">O+</option>
                        <option @if($personal_info->blood_group=="O-") selected @endif value="O-">O-</option>
                        <option @if($personal_info->blood_group=="AB+") selected @endif value="AB+">AB+</option>
                        <option @if($personal_info->blood_group=="AB-") selected @endif value="AB-">AB-</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                  <div  class="form-group">
                      <label>City</label>
                      <select name="city" id="pi_city" onchange="cityChangedFromTutorPersonalInfo(this)" class="select2 select2-hidden-accessible" data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        @foreach (App\City::OrderBy('name','asc')->get() as $city)
                          <option @if($personal_info->city_id==$city->id) selected @endif  value="{{$city->id}}" data-select2-id="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col">
                  <div  class="form-group">
                      <label>Location</label>
                      <select name="location" id="pi_location" class="select2 select2-hidden-accessible"  data-placeholder="Select a State" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true">
                        @if ($personal_info->city!=null)
                            @foreach ($personal_info->city->locations as $location)
                            <option @if($personal_info->location_id==$location->id) selected @endif  value="{{$location->id}}" data-select2-id="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Full Address</label>
                <textarea name="full_address" class="form-control" cols="30" rows="2">{{$personal_info->full_address}}</textarea>
            </div>
            <div class="form-group">
                <div class="col">
                    <div  class="form-group">
                        <label>Nationality</label>
                        <input type="text" name="nationality" value="{{$personal_info->nationality}}" class="form-control">
                      </div>
                </div>
                <div class="col">
                    <div  class="form-group">
                        <label>Identification Number</label>
                        <input type="text" name="id_number" value="{{$personal_info->id_number}}" class="form-control">
                      </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col">
                    <div  class="form-group">
                        <label>Date of birth</label>
                        <input type="date" name="date_of_birth" value="{{$personal_info->date_of_birth}}" class="form-control">
                      </div>
                </div>
                <div class="col">
                    <div  class="form-group">
                        <label>Additional Phone Number</label>
                        <input type="text" name="additional_phone" value="{{$personal_info->additional_phone}}" class="form-control">
                      </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div  class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="fathers_name" value="{{$personal_info->fathers_name}}" class="form-control">
                      </div>
                </div>
                <div class="col">
                    <div  class="form-group">
                        <label>Mother's Name</label>
                        <input type="text" name="mothers_name" value="{{$personal_info->mothers_name}}" class="form-control">
                      </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div  class="form-group">
                        <label>Father's Phone</label>
                        <input type="text" name="fathers_phone" value="{{$personal_info->fathers_phone}}" class="form-control">
                      </div>
                </div>
                <div class="col">
                    <div  class="form-group">
                        <label>Mother's Phone</label>
                        <input type="text" name="mothers_phone" value="{{$personal_info->mothers_phone}}" class="form-control">
                      </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div  class="form-group">
                        <label>Emergency Contact Name</label>
                        <input type="text" name="emergency_name" value="{{$personal_info->emergency_name}}" class="form-control">
                      </div>
                </div>
                <div class="col">
                    <div  class="form-group">
                        <label>Emergency Contact Phone</label>
                        <input type="text" name="emergency_phone" value="{{$personal_info->emergency_phone}}" class="form-control">
                      </div>
                </div>
            </div>
            <div  class="form-group">
                <label>Facebook Profile Link</label>
                <input name="facebook_profile" type="text" value="{{$personal_info->facebook_profile}}" class="form-control">
              </div>
              <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control" cols="30" rows="3">{{$personal_info->short_description}}</textarea>
            </div>
              <div class="form-group">
                <label>Reasons to be getting hired</label>
                <textarea name="reasones_to_get_hired" class="form-control" cols="30" rows="3">{{$personal_info->reasones_to_get_hired}}</textarea>
            </div>
              <div class="form-group">
                <label>overview</label>
                <textarea name="overview" class="form-control" cols="30" rows="3">{{$personal_info->overview}}</textarea>
            </div>
                <button type="submit" class="btn btn-primary">Update Change</button>
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      
    </div>
  </div>
  <script>
      function cityChangedFromTutorPersonalInfo(obj){
          var city=getCity($(obj).val());
          var html="";
          for(var loc of city.locations){
            html+=`<option value="`+loc.id+`" data-select2-id="`+loc.id+`">`+loc.name+`</option>`;
          }
          $("#pi_location").html(html);
          
          $("#pi_location").select2();

      }
  </script>
