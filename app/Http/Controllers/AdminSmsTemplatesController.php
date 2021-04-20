<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminSmsTemplatesController extends CBController {


    public function cbInit()
    {
        $this->setTable("sms_templates");
        $this->setPermalink("sms_templates");
        $this->setPageTitle("Sms Templates");

        $this->addText("Title","title")->strLimit(150)->maxLength(255);
		$this->addTextArea("Body","body")->help("Variables: -class- , -subjects-, -location-, -days-, -duration- , -time- , -salary-")->strLimit(150);
		

    }
}
