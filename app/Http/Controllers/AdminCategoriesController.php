<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCategoriesController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("categories");
        $this->setPermalink("categories");
        $this->setPageTitle("Categories");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		

    }
}
