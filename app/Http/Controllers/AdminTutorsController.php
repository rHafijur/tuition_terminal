<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tutor;
use App\TutorPersonalInformation;

class AdminTutorsController extends CBController {


    public function cbInit()
    {
        $this->setTable("tutors");
        $this->setPermalink("tutors");
        $this->setPageTitle("Tutors");

        $this->addSelectTable("City","city_id",["table"=>"cities","value_option"=>"name","display_option"=>"name","sql_condition"=>""])->filterable(true);
		$this->addSelectTable("Location","location_id",["table"=>"locations","value_option"=>"id","display_option"=>"name","sql_condition"=>""])->filterable(true);
		$this->addText("Expected Salary","expected_salary")->filterable(true)->strLimit(150)->maxLength(255);
		$this->addText("Tutoring Experience","tutoring_experience")->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Tutoring Experience Detail","tutoring_experience_details")->strLimit(150);
		$this->addText("Is Verified","is_verified")->strLimit(150)->maxLength(255);
		$this->addText("Is Featured","is_featured")->strLimit(150)->maxLength(255);
		$this->addText("Is Premium","is_premium")->strLimit(150)->maxLength(255);
		$this->addDatetime("Premium Started At","premium_started_at");
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Available From","available_from")->strLimit(150)->maxLength(255);
		$this->addText("Available To","available_to")->strLimit(150)->maxLength(255);
		

	} 
	public function getSingle($id){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$tutor=Tutor::findOrFail($id);
		$page_title="Tutor Profile - ".$tutor->user->name;
		// dd($tutor);
		return view('admin.tutor.single',compact('tutor','page_title'));
	}

	public function getNew(){
		$page_title="New Tutor";
		return view('admin.tutor.new',\compact('page_title'));
	}
	public function postNew(){
		$request=request();
		$request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:13|min:11',
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sms_otp' => rand(99999,999999),
            'cb_roles_id' => 3,
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
            'password' => Hash::make("Tuition123#"),
        ]);
        $tutor=Tutor::create([
            'user_id'  => $user->id
        ]);
        $tutor->save_tutor_id();
        TutorPersonalInformation::create([
            'tutor_id'  => $tutor->id
            // 'tutor_id'  => 1
		]);
		return redirect()->back()->with('success','New Tutor Account has been registered successfully');
	}
}
