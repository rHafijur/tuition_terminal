@php
    use Carbon\Carbon;
    $apps=$offer->applications()->whereNotNull('taken_by_id')->get();
@endphp
<div class="row">
    <button type="button" class="btn btn-success btn-lg btn-block">First Time</button>
    @if (isset($apps[0]))
    @php
        $one=$apps[0];
        $unis= $one->tutor->tutor_degrees()->whereIn('degree_id',[3,4])->get();
        // dd($unis);
    @endphp
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item"><strong>Tutor ID:-</strong> {{$one->tutor->tutor_id}}</li>
            <li class="list-group-item"><strong>Tutor Name:-</strong> {{$one->tutor->user->name}}</li>
            <li class="list-group-item">
                <strong>University:-</strong>
                @foreach ($unis as $uni)
                {{$uni->degree->title}}: {{$uni->Institute->title}}@if (!$loop->last),@endif
                @endforeach
            </li>
            <li class="list-group-item"><strong>Current Stage:-</strong> {{$one->current_stage}}</li>
            <li class="list-group-item"><strong>Taken by:-</strong> {{$one->taken_by->name}}</li>
            <li class="list-group-item"><strong>Taken at:-</strong> {{Carbon::parse($one->taken_at)->toDateString()}}</li>
          </ul>
    </div>
    @endif
</div>
<div class="row">
    <button type="button" class="btn btn-success btn-lg btn-block">Second Time</button>
    @if (isset($apps[1]))
    @php
        $tow=$apps[1];
        $unis= $tow->tutor->tutor_degrees()->whereIn('degree_id',[3,4])->get();
        // dd($unis);
    @endphp
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item"><strong>Tutor ID:-</strong> {{$tow->tutor->tutor_id}}</li>
            <li class="list-group-item"><strong>Tutor Name:-</strong> {{$tow->tutor->user->name}}</li>
            <li class="list-group-item">
                <strong>University:-</strong>
                @foreach ($unis as $uni)
                {{$uni->degree->title}}: {{$uni->Institute->title}}@if (!$loop->last),@endif
                @endforeach
            </li>
            <li class="list-group-item"><strong>Current Stage:-</strong> {{$tow->current_stage}}</li>
            <li class="list-group-item"><strong>Taken by:-</strong> {{$tow->taken_by->name}}</li>
            <li class="list-group-item"><strong>Taken at:-</strong> {{Carbon::parse($tow->taken_at)->toDateString()}}</li>
          </ul>
    </div>
    @endif
</div>