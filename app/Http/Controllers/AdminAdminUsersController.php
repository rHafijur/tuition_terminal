<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Hash;

class AdminAdminUsersController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');

        
        $this->setTable("users");
        $this->setPermalink("admin_users");
        $this->setPageTitle("Admin Users");

        $this->addText("Name","name")->strLimit(150)->maxLength(255);
		$this->addEmail("Email","email");
		$this->addPassword("Password","password");
        $this->addText("Phone","phone")->strLimit(150)->maxLength(255);
        $this->addRadio("Role","cb_roles_id")->options([
            "1"  => "Super Admin",
            "2" => "Employee"
        ]);
		
        // $this->hookBeforeInsert(function($data) {
        //     // Todo: code here
        //     // $data['cb_roles_id'] = 2;
        //     $data['password'] = Hash::make($data['password']);
        //     // dd($data);
    
        //     // Don't forget to return back
        //     return $data;
        // });
        $this->hookIndexQuery(function($query) {
            $query->whereIn("cb_roles_id", [1,2]);
    
            return $query;
        });
    }
}
