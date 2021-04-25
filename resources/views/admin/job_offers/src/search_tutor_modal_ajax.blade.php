<div class="row">
    @php
        $cnt=count($tutors);
    @endphp
    <button type="button" class="btn btn-info btn-lg btn-block">Search Tutor</button>
    <small class="pull-right">Search Result {{$cnt}} Tutors</small>
    <table class="table">
        <tbody>
            @foreach ($tutors as $tutor)
            <tr>
                <td>
                    <a href="{{ action('AdminTutorsController@getSingle',[$tutor->id]) }}"><strong>{{$tutor->user->name}}</strong></a> {!!$tutor->getStatusIcon()!!} @if($tutor->applied)<span class="badge badge-success">P</span>@endif <br>
                    {!!$tutor->getRating()!!} <br>
                    @php
                        $uni = $tutor->tutor_degrees()->whereIn('degree_id',[4,3])->orderBy('degree_id','desc')->first();
                    @endphp
                    @if ($uni!=null)
                        {{$uni->institute->title}}
                    @endif
                </td>
                <td><span class="badge badge-success">{{$tutor->mathcing_rate}}%</span></td>
                <td>
                    <input type="checkbox" class="message_check" data-id="{{$tutor->user_id}}" checked>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($cnt>0)
    <button type="button" onclick="sendSmsToSearchedTutor()" class="btn btn-success btn-lg btn-block">Send SMS</button>
    @endif
</div>
<script>
    function sendSmsToSearchedTutor(){
            var ids=[];
            for(var selector of $('.message_check')){
                if(selector.checked){
                    ids.push($(selector).data('id'));
                }
            } 
            if(ids.length<1){
                alert("Please select atleast one tutor");
                return;
            }
            $("#ids").val(JSON.stringify(ids));
            $("#job_id_field").val({{$offer->id}});
            $("#bulk_sms_form").submit();
        }
</script>