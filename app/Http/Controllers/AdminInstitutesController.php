<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminInstitutesController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("institutes");
        $this->setPermalink("institutes");
        $this->setPageTitle("Institutes");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		$this->addSelectOption("Institute Type","type")->options(['school'=>'School','school and college'=>'School and College','college'=>'College','university'=>'University']);
		

    }
}
