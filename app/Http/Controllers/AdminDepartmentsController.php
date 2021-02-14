<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminDepartmentsController extends CBController {


    public function cbInit()
    {
        $this->setTable("departments");
        $this->setPermalink("departments");
        $this->setPageTitle("Departments");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
