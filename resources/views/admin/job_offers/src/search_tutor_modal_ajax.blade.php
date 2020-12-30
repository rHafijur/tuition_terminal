<div class="row">
    <button type="button" class="btn btn-success btn-lg btn-block">Search Tutor</button>
    <small class="pull-right">Search Result {{count($tutors)}} Tutors</small>
    <table class="table">
        <tbody>
            @foreach ($tutors as $tutor)
            <tr>
                <td>
                    <a href="#"><strong>{{$tutor->user->name}}</strong></a> {!!$tutor->getStatusIcon()!!} @if($tutor->applied)<span class="badge badge-success">P</span>@endif <br>
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
                    <input type="checkbox" class="message_check" data-id="{{$tutor->id}}" checked>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>