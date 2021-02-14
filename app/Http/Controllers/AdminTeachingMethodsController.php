<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminTeachingMethodsController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("teaching_methods");
        $this->setPermalink("teaching_methods");
        $this->setPageTitle("Teaching Methods");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
