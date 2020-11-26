<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;
use App\Tutor;
use App\TutorPersonalInformation;

use Carbon\Carbon;

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
	public function postDelete(){
		if(!module()->canDelete()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		Tutor::find(request()->id)->delete();
		return redirect()->back()->with('success',"Tuter deleted successfully");
	}
	public function getSms($id){
		dd($id);
	}
	public function getEdit($id){
		if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$tutor=Tutor::findOrFail($id)->user;
		// \dd($tutor);
		$page_title="Edit Tutor";
		return view('admin.tutor.edit',\compact('tutor','page_title'));
	}
	public function postEdit(){
		if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$request=\request();
		$user=User::findOrFail($request->id);
		$user->name=$request->name;
		$user->email=$request->email;
		$user->phone=$request->phone;
		$user->save();
		return redirect()->back()->with('success',"Tuter's data Updated successfully");
	}
	public function postBulkSms(){
		$request=request();
		dd($request);
	}
	public function getIndex(){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$request=request();
		$q=$request->q;
		$limit=$request->limit;
		$city=$request->city;
		$location=$request->location;
		$is_verified=$request->is_verified;
		$is_featured=$request->is_featured;

		$page_title="All Tutors";
		// $tutors = Tutor::with('user')->with('city')->with('location')->where('city.name','Dhaka')->get();
		$query=DB::table('tutors')->join('users','tutors.user_id','users.id')->leftJoin('cities','cities.id','tutors.city_id')->leftJoin('locations','locations.id','tutors.location_id')
		->select('tutors.id','tutors.tutor_id','tutors.is_featured','tutors.is_verified','users.name','users.email','users.phone','locations.name as location','cities.name as city')
		// ->where("is_premium", 0);
		->whereNull('tutors.premium_started_at')->orWhere("tutors.premium_started_at","<", Carbon::now()->subMonths(6));
		if($q!=null){
			$query=$query->where('tutors.tutor_id','like','%'.$q.'%')
						 ->orWhere('users.name','like','%'.$q.'%')
						 ->orWhere('users.email','like','%'.$q.'%')
						 ->orWhere('users.phone','like','%'.$q.'%');
		}
		if($city!=null){
			$query=$query->where('tutors.city_id',$city);
		}
		if($location!=null){
			$query=$query->where('tutors.location_id',$location);
		}
		if($is_verified!=null){
			$query=$query->where('tutors.is_verified',$is_verified);
		}
		if($is_featured!=null){
			$query=$query->where('tutors.is_featured',$is_featured);
		}
		if($limit==null){
			$limit=10;
		}
		$tutors=$query->paginate($limit);
		return view('admin.tutor.all',\compact('tutors','page_title'));
	}
	public function getPremium(){
		if(!module()->canBrowse()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$request=request();
		$q=$request->q;
		$limit=$request->limit;
		$city=$request->city;
		$location=$request->location;
		$is_verified=$request->is_verified;
		$is_featured=$request->is_featured;
		// return Carbon::now()->subMonths(6);
		$page_title="Premium Tutors";
		// $tutors = Tutor::with('user')->with('city')->with('location')->where('city.name','Dhaka')->get();
		$query=DB::table('tutors')->join('users','tutors.user_id','users.id')->leftJoin('cities','cities.id','tutors.city_id')->leftJoin('locations','locations.id','tutors.location_id')
		->select('tutors.id','tutors.tutor_id','tutors.is_featured','tutors.is_verified','users.name','users.email','users.phone','locations.name as location','cities.name as city')
		// ->where("is_premium", 1)
		->orwhere("tutors.premium_started_at",">", Carbon::now()->subMonths(6));
		if($q!=null){
			$query=$query->where('tutors.tutor_id','like','%'.$q.'%')
						 ->orWhere('users.name','like','%'.$q.'%')
						 ->orWhere('users.email','like','%'.$q.'%')
						 ->orWhere('users.phone','like','%'.$q.'%');
		}
		if($city!=null){
			$query=$query->where('tutors.city_id',$city);
		}
		if($location!=null){
			$query=$query->where('tutors.location_id',$location);
		}
		if($is_verified!=null){
			$query=$query->where('tutors.is_verified',$is_verified);
		}
		if($is_featured!=null){
			$query=$query->where('tutors.is_featured',$is_featured);
		}
		if($limit==null){
			$limit=10;
		}
		$tutors=$query->paginate($limit);
		return view('admin.tutor.premium',\compact('tutors','page_title'));
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
