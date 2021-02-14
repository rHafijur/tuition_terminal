<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCurriculaController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("curricula");
        $this->setPermalink("curricula");
        $this->setPageTitle("Curricula");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
