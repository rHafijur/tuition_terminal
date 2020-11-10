<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCitiesController extends CBController {


    public function cbInit()
    {
        $this->setTable("cities");
        $this->setPermalink("cities");
        $this->setPageTitle("Cities");

        $this->addSelectTable("Country","country_id",["table"=>"countries","value_option"=>"id","display_option"=>"name","sql_condition"=>""]);
		$this->addText("City Name","name")->strLimit(150)->maxLength(255);
		

    }
}
