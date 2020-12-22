<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\User;
use App\Tutor;
use App\TutorPersonalInformation;
use App\Category;
use App\Course;
use App\City;
use App\Institute;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CityResource;
use App\Certificate;

class TutorController extends Controller
{   
    protected function institute_id($institute){
        if(is_numeric($institute)){
            return $institute;
        }
        $ins=Institute::where('title',$institute)->first();
        if($ins != null){
            return $ins->id;
        }
        return Institute::create([
            'title' => $institute,
            'type' => 'school'
        ])->id;
    }
    public function registration(){
        $tutor=null;
        $categories=null;
        $categories_collection=null;
        $courses_collection=null;
        $city_collection=null;
        if(auth()->check()){
            $tutor=auth()->user()->tutor;
            $categories=Category::all();
            $categories_collection=CategoryResource::collection($categories);
            $courses_collection=CourseResource::collection(Course::all());
            $city_collection=CityResource::collection(City::all());
        }
        return view('tutor.registration',compact('tutor','categories','categories_collection','courses_collection','city_collection'));
    }
    public function create(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:11|min:11',
            'password' => 'required|confirmed|max:100|min:6',
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sms_otp' => rand(99999,999999),
            'cb_roles_id' => 3,
            'password' => Hash::make($request->password),
        ]);
        $tutor=Tutor::create([
            'user_id'  => $user->id
        ]);
        $tutor->save_tutor_id();
        TutorPersonalInformation::create([
            'tutor_id'  => $tutor->id
            // 'tutor_id'  => 1
        ]);
        // $user->sendEmailVerificationNotification();
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // return view('auth.verify');
        return redirect(route('tutor_registration')."?tab=pi")->with('success','Tutor Account Created Successfully. Please Complete your profile');
    }
    public function dashboard(){
        $tutor=auth()->user()->tutor;
        $categories=Category::all();
        $categories_collection=CategoryResource::collection($categories);
        $courses_collection=CourseResource::collection(Course::all());
        $city_collection=CityResource::collection(City::all());
        // return $city_collection;
        // dd($tutor->course_subjects[0]);
        return view('tutor.dashboard',\compact('tutor','categories','categories_collection','courses_collection','city_collection'));
    }
    public function update_ti(Request $request){
        $tutor = auth()->user()->tutor;
        $tutor->city_id=$request->city;
        $tutor->location_id=$request->locations;
        $tutor->expected_salary=$request->expected_salary;
        $tutor->tutoring_experience=$request->tutoring_experience;
        $tutor->tutoring_experience_details=$request->tutoring_experience_details;
        $tutor->available_from=$request->available_from;
        $tutor->available_to=$request->available_to;
        $tutor->save();
        $tutor->categories()->sync($request->categories);
        $tutor->courses()->sync($request->courses);
        $tutor->course_subjects()->sync($request->subjects);
        $tutor->days()->sync($request->days);
        $tutor->prefered_locations()->sync($request->prefered_locations);
        $tutor->teaching_methods()->sync($request->teaching_methods);

        return redirect(route('tutor_dashboard')."?tab=ti")->with('success','Information Updated Successfully');
    }
    public function update_ei(Request $request){
        // dd($request);
        $tutor = auth()->user()->tutor;
        $ssc=$tutor->tutor_degrees()->where('degree_id',6)->first();
        $hsc=$tutor->tutor_degrees()->where('degree_id',5)->first();
        $bachelors=$tutor->tutor_degrees()->where('degree_id',4)->first();
        $masters=$tutor->tutor_degrees()->where('degree_id',3)->first();
        $isDiploma=$request->is_diploma_student;
        $parsonalData=$tutor->tutor_personal_information;
        if($isDiploma==null){
            $isDiploma=0;
        }
        $ssc_data=[
            "degree_id" => 6,
            "institute_id" => $this->institute_id($request->institute[6]),
            "curriculum_id" => $request->curriculum[6],
            "group_or_major" => $request->group_or_major[6],
            "passing_year" => $request->passing_year[6],
            "gpa" => $request->gpa[6],
            "education_board" => $request->education_board[6],
        ];
        if($isDiploma==0){
            $hsc_data=[
                "degree_id" => 5,
                "institute_id" => $this->institute_id($request->institute[5]),
                "curriculum_id" => $request->curriculum[5],
                "group_or_major" => $request->group_or_major[5],
                "passing_year" => $request->passing_year[5],
                "gpa" => $request->gpa[5],
                "education_board" => $request->education_board[5],
            ];
        }
        $bachelors_data=[
            "degree_id" => 4,
            "institute_id" => $this->institute_id($request->institute[4]),
            "gpa" => $request->gpa[4],
            "currently_studying" => $request->currently_studing[4],
            'study_type_id' => $request->study_type_id[4],
            'department' => $request->department[4],
            'university_type' => $request->university_type[4],
            'year_or_semester' => $request->year_or_semester[4],
        ];
        if($request->has_masters==1){
            $masters_data=[
                "degree_id" => 3,
                "institute_id" => $this->institute_id($request->institute[3]),
                "gpa" => $request->gpa[3],
                "currently_studying" => $request->currently_studing[3],
                'study_type_id' => $request->study_type_id[3],
                'department' => $request->department[3],
                'university_type' => $request->university_type[3],
                'year_or_semester' => $request->year_or_semester[3],
            ];
        }
        if($ssc!=null){
            $ssc->update($ssc_data);
        }else{
            $tutor->tutor_degrees()->create($ssc_data);
        }
        if($isDiploma==0){
            $parsonalData->is_diploma_student=0;
            $parsonalData->save();
            if($hsc!=null){
                $hsc->update($hsc_data);
            }else{
                $tutor->tutor_degrees()->create($hsc_data);
            }
        }else{
            $parsonalData->is_diploma_student=1;
            $parsonalData->save();
            if($hsc!=null){
                $hsc->delete();
            }
        }
        if($bachelors!=null){
            $bachelors->update($bachelors_data);
        }else{
            $tutor->tutor_degrees()->create($bachelors_data);
        }
        if($masters!=null){
            if($request->has_masters==null){
                $masters->delete();
            }else{
                $masters->update($masters_data);
            }
        }else{
            if($request->has_masters==1){
                $tutor->tutor_degrees()->create($masters_data);
            }
        }
        return redirect(route('tutor_dashboard')."?tab=ei")->with('success','Information Updated Successfully');
    }
    public function update_pi(Request $request){
        // dd($request);
        $tutor = auth()->user()->tutor;
        $tutor->tutor_personal_information()->update([
        'city_id' => $request->city,
        'location_id' => $request->location,
        'gender' => $request->gender,
        'additional_phone' => $request->additional_phone,
        'full_address' => $request->full_address,
        'id_number' => $request->id_number,
        'nationality' => $request->nationality,
        'facebook_profile' => $request->facebook_profile,
        'blood_group' => $request->blood_group,
        'date_of_birth' => $request->date_of_birth,
        'fathers_name' => $request->fathers_name,
        'mothers_name' => $request->mothers_name,
        'fathers_phone' => $request->fathers_phone,
        'mothers_phone' => $request->mothers_phone,
        'emergency_name' => $request->emergency_name,
        'emergency_phone' => $request->emergency_phone,
        'short_description' => $request->short_description,
        'reasones_to_get_hired' => $request->reasones_to_get_hired,
        'overview' => $request->overview,
        ]);

        return redirect(route('tutor_dashboard')."?tab=pi")->with('success','Information Updated Successfully');
    }

    public function ti(Request $request){
        $tutor = auth()->user()->tutor;
        $tutor->city_id=$request->city;
        $tutor->location_id=$request->locations;
        $tutor->expected_salary=$request->expected_salary;
        $tutor->tutoring_experience=$request->tutoring_experience;
        $tutor->tutoring_experience_details=$request->tutoring_experience_details;
        $tutor->available_from=$request->available_from;
        $tutor->available_to=$request->available_to;
        $tutor->save();
        $tutor->categories()->sync($request->categories);
        $tutor->courses()->sync($request->courses);
        $tutor->course_subjects()->sync($request->subjects);
        $tutor->days()->sync($request->days);
        $tutor->prefered_locations()->sync($request->prefered_locations);
        $tutor->teaching_methods()->sync($request->teaching_methods);

        return redirect(route('verifyEmailPage'))->with('success','Information Updated Successfully');
    }
    public function ei(Request $request){
        // dd($request);
        $tutor = auth()->user()->tutor;
        $ssc=$tutor->tutor_degrees()->where('degree_id',6)->first();
        $hsc=$tutor->tutor_degrees()->where('degree_id',5)->first();
        $bachelors=$tutor->tutor_degrees()->where('degree_id',4)->first();
        $masters=$tutor->tutor_degrees()->where('degree_id',3)->first();
        $isDiploma=$request->is_diploma_student;
        $parsonalData=$tutor->tutor_personal_information;
        if($isDiploma==null){
            $isDiploma=0;
        }
        $ssc_data=[
            "degree_id" => 6,
            "institute_id" => $this->institute_id($request->institute[6]),
            "curriculum_id" => $request->curriculum[6],
            "group_or_major" => $request->group_or_major[6],
            "passing_year" => $request->passing_year[6],
            "gpa" => $request->gpa[6],
            "education_board" => $request->education_board[6],
        ];
        if($isDiploma==0){
            $hsc_data=[
                "degree_id" => 5,
                "institute_id" => $this->institute_id($request->institute[5]),
                "curriculum_id" => $request->curriculum[5],
                "group_or_major" => $request->group_or_major[5],
                "passing_year" => $request->passing_year[5],
                "gpa" => $request->gpa[5],
                "education_board" => $request->education_board[5],
            ];
        }
        $bachelors_data=[
            "degree_id" => 4,
            "institute_id" => $this->institute_id($request->institute[4]),
            "gpa" => $request->gpa[4],
            "currently_studying" => $request->currently_studing[4],
            'study_type_id' => $request->study_type_id[4],
            'department' => $request->department[4],
            'university_type' => $request->university_type[4],
            'year_or_semester' => $request->year_or_semester[4],
        ];
        if($request->has_masters==1){
            $masters_data=[
                "degree_id" => 3,
                "institute_id" => $this->institute_id($request->institute[3]),
                "gpa" => $request->gpa[3],
                "currently_studying" => $request->currently_studing[3],
                'study_type_id' => $request->study_type_id[3],
                'department' => $request->department[3],
                'university_type' => $request->university_type[3],
                'year_or_semester' => $request->year_or_semester[3],
            ];
        }
        if($ssc!=null){
            $ssc->update($ssc_data);
        }else{
            $tutor->tutor_degrees()->create($ssc_data);
        }
        if($isDiploma==0){
            $parsonalData->is_diploma_student=0;
            $parsonalData->save();
            if($hsc!=null){
                $hsc->update($hsc_data);
            }else{
                $tutor->tutor_degrees()->create($hsc_data);
            }
        }else{
            $parsonalData->is_diploma_student=1;
            $parsonalData->save();
            if($hsc!=null){
                $hsc->delete();
            }
        }
        if($bachelors!=null){
            $bachelors->update($bachelors_data);
        }else{
            $tutor->tutor_degrees()->create($bachelors_data);
        }
        if($masters!=null){
            if($request->has_masters==null){
                $masters->delete();
            }else{
                $masters->update($masters_data);
            }
        }else{
            if($request->has_masters==1){
                $tutor->tutor_degrees()->create($masters_data);
            }
        }

        return redirect(route('tutor_registration')."?tab=ti")->with('success','Education Information Saved Successfully');
    }
    public function pi(Request $request){
        // dd($request);
        $tutor = auth()->user()->tutor;
        $tutor->tutor_personal_information()->update([
        'city_id' => $request->city,
        'location_id' => $request->location,
        'gender' => $request->gender,
        'additional_phone' => $request->additional_phone,
        'full_address' => $request->full_address,
        'id_number' => $request->id_number,
        'nationality' => $request->nationality,
        'facebook_profile' => $request->facebook_profile,
        'blood_group' => $request->blood_group,
        'date_of_birth' => $request->date_of_birth,
        'fathers_name' => $request->fathers_name,
        'mothers_name' => $request->mothers_name,
        'fathers_phone' => $request->fathers_phone,
        'mothers_phone' => $request->mothers_phone,
        'emergency_name' => $request->emergency_name,
        'emergency_phone' => $request->emergency_phone,
        'short_description' => $request->short_description,
        'reasones_to_get_hired' => $request->reasones_to_get_hired,
        'overview' => $request->overview,
        ]);

        return redirect(route('tutor_registration')."?tab=ei")->with('success','Parsonal Information Saved Successfully');
    }
    public function view_info(){
        $tutor = auth()->user()->tutor;
        return view("tutor.view_info",\compact('tutor'));
    }
    public function edit_profile(){
        return view('tutor.edit_profile');
    }
    public function update_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed|max:100|min:6',
        ]);
        $user = auth()->user();
        if(Hash::check($request->current_password, $user->password)){
            $user->password= Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success','Password Successfully Changed');
        }
        return redirect()->back()->with('incorrect_password','Incorrect Password');
    }
    public function update_profile(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100|min:3',
            'phone' => 'required|max:11|min:11',
        ]);
        if ($validator->fails()) {
            return redirect(route('tutor_edit_profile')."?tab=profile")
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = auth()->user();
        $user->name=$request->name;
        $user->phone=$request->phone;
        return redirect(route('tutor_edit_profile')."?tab=profile")->with('success','Profile Updated Successfully');
    }
    public function upload_certificate(Request $request){
        $path = $request->file('certificate')->store('certificates');
        // dd($request);
        auth()->user()->tutor->certificates()->create([
            'type' => $request->type,
            'file_path'=>$path
        ]);
        return redirect()->back()->with('success','File uploaded successfully');
    }
    public function change_profile_picture(){
        return view('tutor.upload_profile_picture');
    }
    public function update_profile_picture(Request $request){
        $base64_str = substr($request->image, strpos($request->image, ",")+1);
        $file =base64_decode($base64_str);
        $folderName = 'public/uploads/';
        $safeName = Str::random(20).'.'.'png';
        $destinationPath = public_path() . $folderName;
        $success = file_put_contents(public_path().'/uploads/'.$safeName, $file);
        if($success){
            $user=auth()->user();
            $user->photo="uploads/".$safeName;
            $user->save();
            return redirect()->back()->with('success','Profile Picture Updated successfully');
        }else{
            return redirect()->back()->with('error','Profile Picture could not be Updated');
        }
    }
    public function my_status(){
        return view('tutor.my_status');
    }
}
