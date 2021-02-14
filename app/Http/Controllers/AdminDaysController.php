<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminDaysController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("days");
        $this->setPermalink("days");
        $this->setPageTitle("Days");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
