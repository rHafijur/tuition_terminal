<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

use App\Payment;
class AdminPaymentsController extends CBController {


    public function cbInit()
    {
		$this->middleware('admin');
		
        $this->setTable("payments");
        $this->setPermalink("payments");
        $this->setPageTitle("Payments");

        $this->addSelectTable("User","user_id",["table"=>"users","value_option"=>"id","display_option"=>"name","sql_condition"=>""])->showEdit(false);
		$this->addText("Method","method")->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Sent From","sent_from")->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Sent To","sent_to")->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Amount","amount")->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Note","note")->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addSelectOption("Confirmed","confirmed")->options([0=>'No',1=>'Yes']);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);

		$this->addActionButton("Mark as Confirmed", function($row) {
		    return action("AdminPaymentsController@getMarkAsConfirmed",[$row->primary_key]);
        }, function($row) {
		    return $row->confirmed == 0;
        }, "fa fa-check", 'success', false);
		

	}
	public function getMarkAsConfirmed($id){
		$payment=Payment::findOrFail($id);
		$payment->confirmed=1;
		$payment->save();
		return cb()->redirectBack("The data has been updated!","success");
	}
}
