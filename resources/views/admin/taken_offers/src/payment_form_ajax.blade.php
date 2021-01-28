<form id="paymentForm" action="{{cb()->getAdminUrl("taken_offers/save-payment")}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$app->id}}">
    <div class="form-row">
        <div class="form-group col">
            <select name="method" class="form-control" required>
                <option value="">Select Payment Method</option>
                <option value="Bank">Bank</option>
                <option value="Bkash">Bkash</option>
                <option value="Rocket">Rocket</option>
                <option value="Nagad">Nagad</option>
            </select>
        </div>
        <div class="form-group col">
            <select name="sent_to" class="form-control" required>
                <option value="">Received Number</option>
                <option value="01728611186">01728611186</option>
                <option value="01715930910">01715930910</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label>Net Receivable Amount</label>
            <input id="nra" type="number" value="{{$app->net_receivable_amount - $app->received_amount}}" readonly class="form-control">
        </div>
        <div class="form-group col">
            <label>Received Amount</label>
            <input onchange="received_changed()" id="ra" type="number" name="received_amount" class="form-control" required>
        </div>
    </div>
    <span style="display: block">
        <span style="font-size: 22px; display:inline">Due <input type="checkbox" onchange="hasDueChanged(this)" name="has_due" value="1"  id="has_due"></span>
    </span>
    <div id="due_fields" class="form-row hide">
        <div class="form-group col">
            <label>Due Amount</label>
            <input id="da" type="number" id="due_amount"  name="due_amount" class="form-control due_fs">
        </div>
        <div class="form-group col">
            <label>Due Payment Date</label>
            <input type="date" id="due_date" name="due_date" class="form-control due_fs">
        </div>
    </div>
    <span style="display: block">
        <span style="font-size: 22px; display:inline">Turn off payment <input type="checkbox" onchange="turnOffChanged(this)" name="is_turend_off" id="is_turend_off" value="1"></span>
    </span>
    <div id="turn_off_fields" class="form-row hide">
        <div class="form-group col">
            <label>Amount</label>
            <input type="number" id="turned_off_amount"  name="turned_off_amount" class="form-control turn-off_fs">
        </div>
        <div class="form-group col">
            <label>Reason</label>
            <input type="text" id="payment_turned_off_reason" name="payment_turned_off_reason" class="form-control turn-off_fs">
        </div>
    </div>
    <span style="display: block">
        <span style="font-size: 22px; display:inline">Reference <input onchange="hasReferenceChanged(this)" type="checkbox" id="reference"></span>
    </span>
    <div id="reference_fields" class="form-row hide">
        <div class="form-group col">
            <label>Name</label>
            <input type="text" value="{{$app->job_offer->reference_name}}" class="form-control reference_fs">
        </div>
        <div class="form-group col">
            <label>Phone</label>
            <input type="text" value="{{$app->job_offer->reference_contact}}" class="form-control reference_fs">
        </div>
        <div class="form-group col">
            <label>Amount</label>
            <input type="number" id="reference_amount" name="reference_amount" class="form-control reference_fs">
        </div>
    </div>                    
</form>
