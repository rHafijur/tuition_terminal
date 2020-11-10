<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminSubjectsController extends CBController {


    public function cbInit()
    {
        $this->setTable("subjects");
        $this->setPermalink("subjects");
        $this->setPageTitle("Subjects");

        $this->addText("Subject Title","title")->strLimit(150)->maxLength(255);
		

    }
}
