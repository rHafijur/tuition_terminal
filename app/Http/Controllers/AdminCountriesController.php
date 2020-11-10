<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCountriesController extends CBController {


    public function cbInit()
    {
        $this->setTable("countries");
        $this->setPermalink("countries");
        $this->setPageTitle("Countries");

        $this->addText("Name","name")->strLimit(150)->maxLength(255);
		$this->addImage("Flag","flag")->required(false)->encrypt(true);
		

    }
}
