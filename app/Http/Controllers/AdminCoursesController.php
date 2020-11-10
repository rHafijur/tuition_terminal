<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCoursesController extends CBController {


    public function cbInit()
    {
        $this->setTable("courses");
        $this->setPermalink("courses");
        $this->setPageTitle("Courses");

        $this->addSelectTable("Category","category_id",["table"=>"categories","value_option"=>"id","display_option"=>"title","sql_condition"=>""]);
		$this->addText("Course Title","title")->strLimit(150)->maxLength(255);
		

    }
}
