<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminDegreesController extends CBController {


    public function cbInit()
    {
        $this->setTable("degrees");
        $this->setPermalink("degrees");
        $this->setPageTitle("Degrees");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
