@extends(getThemePath('layout.layout'))
@section('content')
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-edit"></i>Sms Editor</h1>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="box-body"> 
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>To:</h4>
                            @foreach ($users as $user)
                            <span class="badge badge-dark">{{$user->name}}</span>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    @if ($offer)
                        @php
                            $class=$offer->course->title;
                            $cs=$offer->course_subjects;
                            $subjects=[];
                            foreach($cs as $c){
                                $subjects[]=$c->subject->title;
                            }
                            $subjects= implode(',',$subjects);
                            $location= $offer->location->name.", ".$offer->city->name;
                            $days=$offer->days_in_week;
                            $duration=$offer->tutoring_duration;
                            $time=$offer->time;
                            $salary=$offer->max_salary;
                        @endphp
                        <script>
                            const vals={
                                '-class-':'{{$class}}',
                                '-subjects-':'{{$subjects}}',
                                '-location-':'{{$location}}',
                                '-days-':'{{$days}}',
                                '-duration-':'{{$duration}}',
                                '-salary-':'{{$salary}}',
                                '-time-':'{{$time}}',
                            };
                        </script>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Template</label>
                                    <select onchange="changeTemplate(this)" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($sms_templates as $template)
                                        <option value="{{$template->body}}">{{$template->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <script>
                            function changeTemplate(el){
                                var body=el.value;
                                for(key of Object.keys(vals)){
                                    body = body.replace(key,vals[key]);
                                }
                                $('#SMS_body').val(body);
                                count();
                            }
                            
                        </script>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('send_sms')}}" method="post">
                                @csrf
                                <input type="hidden" name="ids" value="{{$tids}}">
                                <div class="form-group">
                                    <label for="SMS_body">SMS Body</label>
                                    <textarea onkeyup="count()" id="SMS_body" name="body" id="" cols="30" rows="6" class="form-control" required></textarea>
                                </div>
                                <div class="">
                                    <div id="char">0/160</div>
                                    <div>Remaining:<span id="rem">160</span></div>
                                    <div>Message:<span id="msg">0</span></div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary pull-right">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row d-flex justify-content-center">

            </div> --}}
        </div>
    </div>
    @push('head')
        <script src="{{asset('assets/js/sms_counter.js')}}"></script>
    @endpush
    <script>
        function count(){
            const cnt= SmsCounter.count($("#SMS_body").val());
            $("#char").text(cnt.length+"/"+cnt.per_message);
            $("#msg").text(cnt.messages);
            $("#rem").text(cnt.remaining);
        }
    </script>
@endsection