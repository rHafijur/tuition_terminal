<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminLocationsController extends CBController {


    public function cbInit()
    {
        $this->setTable("locations");
        $this->setPermalink("locations");
        $this->setPageTitle("Locations");

        $this->addSelectTable("City","city_id",["table"=>"cities","value_option"=>"id","display_option"=>"name","sql_condition"=>""]);
		$this->addText("Location Name","name")->strLimit(150)->maxLength(255);
		

    }
}
