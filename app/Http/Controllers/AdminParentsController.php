<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Hash;
use DB;

use App\User;
use App\Parents;

use Carbon\Carbon;

class AdminParentsController extends CBController {


    public function cbInit()
    {
        $this->setTable("parents");
        $this->setPermalink("parents");
        $this->setPageTitle("Parents");

        $this->addText("Heard From","heard_from")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

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

		$page_title="All Parents";
		// $tutors = Tutor::with('user')->with('city')->with('location')->where('city.name','Dhaka')->get();
		$query=DB::table('parents')->join('users','parents.user_id','users.id')
		->select('parents.id','parents.heard_from','users.name','users.email','users.phone','users.id as user_id');
		// ->where("is_premium", 0);
		if($q!=null){
			$query=$query->where('parents.id','like','%'.$q.'%')
						 ->orWhere('users.name','like','%'.$q.'%')
						 ->orWhere('users.email','like','%'.$q.'%')
						 ->orWhere('users.phone','like','%'.$q.'%')
						 ->orWhere('parents.heard_from','like','%'.$q.'%');
		}
		if($limit==null){
			$limit=10;
		}
		$parents=$query->paginate($limit);
		return view('admin.parent.all',\compact('parents','page_title'));
    }
    
    public function getNew(){
		$page_title="New Parent";
		return view('admin.parent.new',\compact('page_title'));
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
            'cb_roles_id' => 2,
            'phone_verified_at' => now(),
            'email_verified_at' => now(),
            'password' => Hash::make("Tuition123#"),
        ]);
        Parents::create([
            'user_id'  => $user->id,
            'heard_from' =>'Added by admin'
        ]);
		return redirect()->back()->with('success','New Parent Account has been registered successfully');
    }
    public function getEdit($id){
		if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$parent=Parents::findOrFail($id)->user;
		// \dd($tutor);
		$page_title="Edit Parent";
		return view('admin.parent.edit',\compact('parent','page_title'));
	}
	public function postEdit(){
		if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		$request=\request();
		$user=User::findOrFail($request->id);
		$user->name=$request->name;
		$user->email=$request->email;
		$user->phone=$request->phone;
		$user->save();
		return redirect()->back()->with('success',"Parent's data Updated successfully");
    }
    public function postDelete(){
		if(!module()->canDelete()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		Parents::find(request()->id)->user->delete();
		return redirect()->back()->with('success',"Parent deleted successfully");
	}
}
