<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="noteModalLabel">Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="noteForm" action="{{cb()->getAdminUrl("job_offers/application-update-note")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputNoteId">
                    <textarea name="note" id="inputNoteText" class="form-control" cols="30" rows="7"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#noteForm').submit()" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="datesModal" tabindex="-1" aria-labelledby="datesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="datesModalLabel">Dates</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="dates_modal_body">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="setWaitingModal" tabindex="-1" aria-labelledby="setWaitingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setWaitingModalLabel">Set Waiting Date</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="setWaitingForm" action="{{cb()->getAdminUrl("taken_offers/set-waiting")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputSetWaitingId">
                    <input type="date" class="form-control" name="waiting_date" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#setWaitingForm').submit()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="setMeetingModal" tabindex="-1" aria-labelledby="setMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setMeetingModalLabel">Set Meeting Date</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="setMeetingForm" action="{{cb()->getAdminUrl("taken_offers/set-meeting")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputSetMeetingId">
                    <input type="date" class="form-control" name="meeting_date" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#setMeetingForm').submit()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="setTrialModal" tabindex="-1" aria-labelledby="setTrialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setTrialModalLabel">Set Trial Date</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="setTrialForm" action="{{cb()->getAdminUrl("taken_offers/set-trial")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputSetTrialId">
                    <input type="date" class="form-control" name="trial_date" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#setTrialForm').submit()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="setRepostModal" tabindex="-1" aria-labelledby="setRepostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setRepostModalLabel">Write the cause of repost</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="setRepostForm" action="{{cb()->getAdminUrl("taken_offers/set-repost")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputSetRepostId">
                    <textarea name="repost_note" class="form-control" required></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#setRepostForm').submit()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="setCancelModal" tabindex="-1" aria-labelledby="setCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setCancelModalLabel">Write the cause of cancel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="setCancelForm" action="{{cb()->getAdminUrl("taken_offers/set-cancel")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputSetCancelId">
                    <textarea name="cancel_note" class="form-control" required></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#setCancelForm').submit()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="setConfirmModal" tabindex="-1" aria-labelledby="setConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setConfirmModalLabel">Confirm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="setConfirmForm" action="{{cb()->getAdminUrl("taken_offers/set-confirm")}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="inputSetConfirmId">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputSetConfirmConfirmDate">Confirm Date</label>
                            <input type="date" id="inputSetConfirmConfirmDate" name="confirm_date" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label for="inputSetConfirmPaymentDate">Payment Date</label>
                            <input type="date" id="inputSetConfirmPaymentDate" name="payment_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputSetConfirmTuitionSalary">Tuition Salary</label>
                            <input onchange="calculatePayment()" type="number" id="inputSetConfirmTuitionSalary" name="tuition_salary" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label for="inputSetConfirmCommission">Commission</label>
                            <select onchange="calculatePayment()" id="inputSetConfirmCommission" name="commission" class="form-control" required>
                                <option value="20">20%</option>
                                <option value="25">25%</option>
                                <option value="30">30%</option>
                                <option value="35">35%</option>
                                <option value="40">40%</option>
                                <option value="45">45%</option>
                                <option value="50">50%</option>
                                <option value="55">55%</option>
                                <option value="60">60%</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputSetConfirmReceivableAmount">Receivable Amount</label>
                            <input type="number" id="inputSetConfirmReceivableAmount" name="receivable_amount" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label for="inputSetConfirmNetReceivableAmount">Net Receivable Amount</label>
                            <input type="number" id="inputSetConfirmNetReceivableAmount" name="net_receivable_amount" class="form-control" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="$('#setConfirmForm').submit()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
<script>
    function loadDataToNoteModal(el){
      el=$(el);
      $("#inputNoteId").val(el.data('id'));
      $("#inputNoteText").text(el.data('note'));
    }
    function dateButtonClicked(id){
        $("#datesModal").modal('show');
        $("#dates_modal_body").html("Loading....");
        
        $.get('{{cb()->getAdminUrl("taken_offers/view-dates-ajax")}}/'+id,
            function (data, status) {
                if(status=="success"){
                    $("#dates_modal_body").html(data);
                }else{
                    $("#dates_modal_body").html("Something Went Wrong");
                }
            }
        );
    }
    function stageOptionChanged(el,id){
        switch (el.value) {
            case "waiting":
                openSetWaitingModal(id);
                break;
            case "meet":
                openSetMeetingModal(id);
                break;
            case "trial":
                openSetTrialModal(id);
                break;
            case "repost":
                openSetRepostModal(id);
                break;
            case "cancel":
                openSetCancelModal(id);
                break;
            case "confirm":
                openSetConfirmModal(id);
                break;
        
            default:
                break;
        }
    }
    function openSetWaitingModal(id){
        $("#inputSetWaitingId").val(id);
        $("#setWaitingModal").modal('show');
    }
    function openSetMeetingModal(id){
        $("#inputSetMeetingId").val(id);
        $("#setMeetingModal").modal('show');
    }
    function openSetTrialModal(id){
        $("#inputSetTrialId").val(id);
        $("#setTrialModal").modal('show');
    }
    function openSetRepostModal(id){
        $("#inputSetRepostId").val(id);
        $("#setRepostModal").modal('show');
    }
    function openSetCancelModal(id){
        $("#inputSetCancelId").val(id);
        $("#setCancelModal").modal('show');
    }
    function openSetConfirmModal(id){
        $("#inputSetConfirmId").val(id);
        $("#setConfirmModal").modal('show');
    }
    function calculatePayment(){
        var commission_rate = $("#inputSetConfirmCommission").val();
        var salary = $("#inputSetConfirmTuitionSalary").val();

        var commission = (salary / 100) * commission_rate;
        commission=Math.round(commission);

        $("#inputSetConfirmNetReceivableAmount").val(commission);
        $("#inputSetConfirmReceivableAmount").val(commission);
    }
</script>