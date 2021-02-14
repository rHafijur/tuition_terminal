<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminStudyTypesController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("study_types");
        $this->setPermalink("study_types");
        $this->setPageTitle("Study Types");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
