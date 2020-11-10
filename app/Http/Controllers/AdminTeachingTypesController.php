<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminTeachingTypesController extends CBController {


    public function cbInit()
    {
        $this->setTable("teaching_types");
        $this->setPermalink("teaching_types");
        $this->setPageTitle("Teaching Types");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
