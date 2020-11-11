<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;

class AdminCoursesController extends CBController {


    public function cbInit()
    {
        $this->setTable("courses");
        $this->setPermalink("courses");
        $this->setPageTitle("Courses");

        $this->addSelectTable("Category","category_id",["table"=>"categories","value_option"=>"id","display_option"=>"title","sql_condition"=>""]);
        $this->addText("Course Title","title")->strLimit(150)->maxLength(255);
        
        $this->addActionButton("Assign Subjects", function($row) {
                return action("AdminCourseSubjectsController@getEdit",[$row->primary_key]);
            }, function($row) {
                return true;
            }, "fa fa-pencil", ButtonColor::LIGHT_BLUE, false);
        // $this->addIndexActionButton("Assign Subjects", action("AdminCourseSubjectsController@getAdd",["id"=>$row->primary_key]), "fa fa-pencil", ButtonColor::class);
		

    }
}
