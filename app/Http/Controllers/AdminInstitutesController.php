<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminInstitutesController extends CBController {


    public function cbInit()
    {
        $this->setTable("institutes");
        $this->setPermalink("institutes");
        $this->setPageTitle("Institutes");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
