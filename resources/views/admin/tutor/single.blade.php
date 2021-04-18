@extends(getThemePath('layout.layout'))
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> {{$tutor->tutor_id}}</h1>
        </div>
        <div class="box-title bg-secondary" style="color: white">
          <div class="row">
            <ul id="tab_nav" class="nav nav-pills">
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSingle',[$tutor->id]) }}" class="nav-link active">Tutor Information</a></li>
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getEdit',[$tutor->id]) }}" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSinglePresentPending',[$tutor->id]) }}" class="nav-link">Present Pending</a></li>
              <li class="nav-item"><a href="{{ action('AdminTutorsController@getSingleHistory',[$tutor->id]) }}" class="nav-link">History</a></li>
            </ul>
        </div>
        </div>
        <div class="box-body"> 
            <div class="row">
                <div class="col-md-3">
            
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        {{-- <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
                      </div>
                
                      <h3 class="profile-username text-center">@if ($tutor->is_active == 1) <i class="fa fa-circle" style="font-size:20px; color:green;"></i> @endif @if ($tutor->is_active == 0) <i class="fa fa-circle" style="font-size:20px; color:red;"></i> @endif {{$tutor->user->name}}</h3>
                      <p class="text-muted text-center">Phone: {{$tutor->user->phone}}</p>
                      <p class="text-muted text-center">ID: {{$tutor->tutor_id}}</p>
                      <p class="text-muted text-center"> Email: {{$tutor->user->email}}</p>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Verified</b> <a class="float-right">{{$tutor->is_verified==0?"No":"Yes"}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Featured</b> <a class="float-right">{{$tutor->is_featured==0?"No":"Yes"}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Premium Member</b> <a class="float-right">{{$tutor->is_premium==0?"No":"Yes"}}</a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            
                  <!-- About Me Box -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      @php
                          $t_degree=$tutor->tutor_degrees;
                          $pi=$tutor->tutor_personal_information;
                          $pi_location=$pi->location;
                          $pi_city=$pi->city;
                      @endphp
                      @if ($t_degree!=null)
                      <strong> Education</strong>
                        @foreach($t_degree as $t_show)
                          <p class="text-muted"> <i class="fa fa-graduation-cap" aria-hidden="true"></i> {{$t_show->degree->title}} 
                      <br> :::: </i>{{$t_show->institute->title}},{{$t_show->group_or_major}},{{$t_show->education_board}},{{$t_show->passing_year}}
                      <br> {{$t_show->department}},{{$t_show->university_type}},{{$t_show->year_or_semester}}

                       <hr>

                        
                        @endforeach
                      @endif
            </p>
                      @if ($pi_location!=null && $pi_city!=null)
                      <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
            
                      <p class="text-muted">{{$pi_location->name}}, {{$pi_city->name}}</p>
            
                      <hr>
                      @endif
            
                      <strong><i class="fas fa-pencil-alt mr-1"></i> Tuition Categoies</strong>
            
                      <p class="text-muted">
                        @foreach ($tutor->categories as $category)
                            <span class="tag tag-danger">{{$category->title}}</span>
                        @endforeach
                      </p>
            
                      <hr>
            
                      <strong><i class="far fa-file-alt mr-1"></i> Tutoring Experience</strong>
            
                      <p class="text-muted">{{$tutor->tutoring_experience}}</p>
                      
                      <hr>
                      
                      <strong><i class="far fa-file-alt mr-1"></i> Tutoring Experience Details</strong>
            
                      <p class="text-muted">{{$tutor->tutoring_experience_details}}</p>
                      
                      <hr>
                      
                      <strong><i class="far fa-file-alt mr-1"></i>Overview</strong>
            
                      <p class="text-muted">{{$tutor->tutor_personal_information->overview}}</p>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                            <div class="card-header p-2">
                              Personal Information
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">              
                                    <strong><i class="fas fa-gender-alt mr-1"></i>Date of Birth</strong>
                          
                                    <p class="text-muted">{{$pi->date_of_birth}}</p>
                          
                                    <hr>
                                    
                                    <strong><i class="fas fa-gender-alt mr-1"></i> Blood Group</strong>
                          
                                    <p class="text-muted">{{$pi->blood_group}}</p>
                          
                                    <hr>
                                    
                                    <strong><i class="fas fa-gender-alt mr-1"></i> Gender</strong>
                          
                                    <p class="text-muted">{{$pi->gender}}</p>
                          
                                    <hr>
                                    
                                    <strong><i class="fas fa-map-alt mr-1"></i> Nationality</strong>
                          
                                    <p class="text-muted">{{$pi->nationality}}</p>
                          
                                    <hr>
                                    <strong><i class="fas fa-map-alt mr-1"></i> Identity Number</strong>
                          
                                    <p class="text-muted">{{$pi->id_number}}</p>
                          
                                    <hr>
            
                                    @if ($pi_location!=null && $pi_city!=null)
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                          
                                    <p class="text-muted">{{$pi_location->name}}, {{$pi_city->name}}</p>
                          
                                    <hr>
                                    @endif
            
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Full Address</strong>
                          
                                    <p class="text-muted">{{$pi->full_address}}</p>
                                    
                                    <hr>
            
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Additional Phone Number</strong>
                          
                                    <p class="text-muted">{{$pi->additional_phone}}</p>
                                  </div>
                              <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                          </div>
                        </div>
                              <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                          <div class="card-header p-2">
                                            Parent's Information
                                          </div><!-- /.card-header -->
                                          <div class="card-body">
                                              <div class="card-body">              
                                                  <strong><i class="fas fa-gender-alt mr-1"></i>Father's Name</strong>
                                        
                                                  <p class="text-muted">{{$pi->fathers_name}}</p>
                                        
                                                  <hr>
                                                  
                                                  <strong><i class="fas fa-gender-alt mr-1"></i>Father's Phone Number</strong>
                                        
                                                  <p class="text-muted">{{$pi->fathers_phone}}</p>
                                        
                                                  <hr>
                                                  
                                                  <strong><i class="fas fa-gender-alt mr-1"></i>Mother's Name</strong>
                                        
                                                  <p class="text-muted">{{$pi->mothers_name}}</p>
                                        
                                                  <hr>
                                                  
                                                  <strong><i class="fas fa-gender-alt mr-1"></i>Mother's Phone Number</strong>
                                        
                                                  <p class="text-muted">{{$pi->mothers_phone}}</p>
                                                  
                                                </div>
                                            <!-- /.tab-content -->
                                          </div><!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                          <div class="card-header p-2">
                                            Emergency Information
                                          </div><!-- /.card-header -->
                                          <div class="card-body">
                                              <div class="card-body">              
                                                  <strong>Emergency Contact Name</strong>
                                        
                                                  <p class="text-muted">{{$pi->emergency_name}}</p>
                                        
                                                  <hr>
                                                  
                                                  <strong>Emergency Contact Number</strong>
                                        
                                                  <p class="text-muted">{{$pi->emergency_phone}}</p>
                                              
                                                </div>
                                            <!-- /.tab-content -->
                                          </div><!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                              </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header p-2">
                            Tuition Categories
                          </div><!-- /.card-header -->
                          <div class="card-body">
                              <div class="card-body">              
                                  @foreach ($tutor->categories as $category)
                                  <span class="badge badge-pill badge-secondary">{{$category->title}}</span>
                                  @endforeach
                              
                                </div>
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header p-2">
                            Tuition Course and Subjects
                          </div><!-- /.card-header -->
                          <div class="card-body">
                              <div class="card-body">              
                                  @foreach ($tutor->course_subjects as $course_subject)
                                  <strong style="font-size: 18px">{{$course_subject->course->category->title}}</strong> : <strong>{{$course_subject->course->title}}</strong> : {{$course_subject->subject->title}} <br>
                                  @endforeach
                              
                                </div>
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header p-2">
                            Tutoring Information
                          </div><!-- /.card-header -->
                          <div class="card-body">
                              <div class="card-body">              
                                  <strong>Tutoring Methods</strong>
                        
                                  <p class="text-muted">
                                      @foreach ($tutor->teaching_methods as $teaching_method)
                                      {{$teaching_method->title}} <br>
                                      @endforeach
                                  </p>
                        
                                  <hr>
            
                                  <strong>Availablity (day)</strong>
                        
                                  <p class="text-muted">
                                      @foreach ($tutor->days as $day)
                                      {{$day->title}} <br>
                                      @endforeach
                                  </p>
                        
                                  <hr>
                                  
                                  <strong>Availablity (Time)</strong>
                        
                                  <p class="text-muted">{{$tutor->available_from}} to {{$tutor->available_to}}</p>
                              
                                </div>
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header p-2">
                            Experience
                          </div><!-- /.card-header -->
                          <div class="card-body">
                              <div class="card-body">              
                                  <strong>Tutoring Experience</strong>
                        
                                  <p class="text-muted">{{$tutor->tutoring_experience}}</p>
                        
                                  <hr>
                                  
                                  <strong>Emergency Contact Number</strong>
                        
                                  <p class="text-muted">{{$tutor->tutoring_experience_details}}</p>
                              
                                </div>
                               {{-- <div>
                                    @foreach($tutor->certificates as $cc)
                                     <strong>{{$cc->type}}</strong>
                                    <img src="{{url('/')}}/{{$cc->file_path}}" alt="Girl in a jacket" width="100" height="100">
                                    @endforeach
                                </div> --}}
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                          <div class="card-header p-2">
                            Certificates
                          </div><!-- /.card-header -->
                          <div class="card-body">
                                <div>
                                    @foreach($tutor->certificates as $cc)
                                     <div class="card-body">              
                                  <strong>{{$cc->type}}</strong>
                                  <a href="{{url('/')}}/{{$cc->file_path}}" target="_blank"> 
                                      <img width="180" height="72" border="0" align="center"  src="{{url('/')}}/{{$cc->file_path}}"/> </a>
                                </div>
                                     @endforeach
                                </div> 
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
                  <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
              </div>
        </div>
    </div>
@endsection