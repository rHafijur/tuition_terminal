@php
    use Carbon\Carbon;
    function formatDate($date){
        if($date!=null){
            return Carbon::parse($date)->toDateString();
        }
        return "";
    }
@endphp
<table class="table">
    <thead>
        <tr>
            <th>Stage Change Date</th>
            <th>Action Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Taken Date:{{formatDate($app->taken_date)}}</td>
            <td></td>
        </tr>
        <tr>
            <td>Waiting Stage:{{formatDate($app->waiting_stage)}}</td>
            <td>Waiting Date:{{formatDate($app->waiting_date)}}</td>
        </tr>
        <tr>
            <td>Meeting Stage:{{formatDate($app->meeting_stage)}}</td>
            <td>Meeting Date:{{formatDate($app->meeting_date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Repost Date:{{formatDate($app->repost_date)}}</td>
        </tr>
        <tr>
            <td>Cancel Stage:{{formatDate($app->cancel_stage)}}</td>
            <td></td>
        </tr>
        <tr>
            <td>Confirm Stage:{{formatDate($app->confirm_stage)}}</td>
            <td>Confirm Date:{{formatDate($app->confirm_date)}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Payment Date:{{formatDate($app->payment_date)}}</td>
        </tr>
    </tbody>
</table>