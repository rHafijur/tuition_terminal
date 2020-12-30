<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable=[
        'user_id',
        'tutor_id',
        'city_id',
        'location_id',
        'expected_salary',
        'tutoring_experience',
        'tutoring_experience_details',
        'is_verified',
        'is_featured',
        'is_premium',
        'premium_started_at',
        'available_to',
        'available_from',
    ];

    public function getProfileComplete(){
        $count=0;
        $info=$this->tutor_personal_information;
        if($this->city_id!=null){
            $count++;
        }
        if($this->location_id!=null){
            $count++;
        }
        if($this->expected_salary!=null){
            $count+=2;
        }
        if($this->tutoring_experience!=null){
            $count+=3;
        }
        if($this->tutoring_experience_details!=null){
            $count+=5;
        }
        if($this->available_to!=null){
            $count++;
        }
        if($this->available_from!=null){
            $count++;
        }
        if($info->city_id!=null){
            $count++;
        }
        if($info->location_id!=null){
            $count++;
        }
        if($info->gender!=null){
            $count+=2;
        }
        if($info->additional_phone!=null){
            $count++;
        }
        if($info->full_address!=null){
            $count+=2;
        }
        if($info->id_number!=null){
            $count+=5;
        }
        if($info->nationality!=null){
            $count++;
        }
        if($info->facebook_profile!=null){
            $count+=2;
        }
        if($info->blood_group!=null){
            $count++;
        }
        if($info->date_of_birth!=null){
            $count++;
        }
        if($info->fathers_name!=null){
            $count++;
        }
        if($info->mothers_name!=null){
            $count++;
        }
        if($info->fathers_phone!=null){
            $count++;
        }
        if($info->mothers_phone!=null){
            $count++;
        }
        if($info->emergency_name!=null){
            $count++;
        }
        if($info->emergency_phone!=null){
            $count++;
        }
        if($info->reasones_to_get_hired!=null){
            $count+=5;
        }
        if($info->overview!=null){
            $count+=5;
        }
        if($this->tutor_degree!=null){
            $count+=20;
        }
        if(count($this->prefered_locations)>0){
            $count+=5;
        }
        if(count($this->categories)>0){
            $count+=5;
        }
        if(count($this->courses)>0){
            $count+=5;
        }
        if(count($this->course_subjects)>0){
            $count+=5;
        }
        if(count($this->teaching_methods)>0){
            $count++;
        }
        if(count($this->days)>0){
            $count+=2;
        }
        if(count($this->certificates)>0){
            $count+=10;
        }
        $pre=10;
        $count= ($count / 100) * 90;
        $total= $pre+$count;
        return $total;
    }

    public function user(){
        return $this->belongsTo("App\User",'user_id');
    }
    public function tutor_personal_information(){
        return $this->hasOne("App\TutorPersonalInformation",'tutor_id');
    }
    public function city(){
        return $this->belongsTo("App\City",'city_id');
    }
    public function location(){
        return $this->belongsTo("App\Location",'location_id');
    }
    public function prefered_locations(){
        return $this->belongsToMany("App\Location",'prefered_location','tutor_id','location_id');
    }
    public function categories(){
        return $this->belongsToMany("App\Category",'category_tutor','tutor_id','category_id');
    }
    public function courses(){
        return $this->belongsToMany("App\Course",'tutor_course','tutor_id','course_id');
    }
    public function course_subjects(){
        return $this->belongsToMany("App\CourseSubject",'course_subject_tutor','tutor_id','course_subject_id');
    }
    public function days(){
        return $this->belongsToMany("App\Day",'day_tutor','tutor_id','day_id');
    }
    public function teaching_methods(){
        return $this->belongsToMany("App\TeachingMethod",'teaching_method_tutor','tutor_id','teaching_method_id');
    }
    public function teaching_types(){
        return $this->belongsToMany("App\TeachingType",'teaching_type_tutor','tutor_id','teaching_type_id');
    }
    public function tutor_degree(){
        return $this->hasOne("App\TutorDegree",'tutor_id');
    }
    public function tutor_degrees(){
        return $this->hasMany("App\TutorDegree",'tutor_id');
    }
    public function tutor_rating(){
        return $this->hasMany("App\TutorRating",'tutor_id');
    }
    public function featured_tutor_requests(){
        return $this->hasMany("App\FeaturedTutorRequest",'tutor_id');
    }
    public function verified_tutor_requests(){
        return $this->hasMany("App\VerifiedTutorRequest",'tutor_id');
    }
    public function premium_membership_requests(){
        return $this->hasMany("App\PremiumMembershipRequest",'tutor_id');
    }
    public function certificates(){
        return $this->hasMany("App\Certificate",'tutor_id');
    }

    public function getStatusIcon(){
        $tutor=$this;
        // dd($tutor->is_premium);
        if($tutor->is_premium==1){
            return '<i style="color:#D9B351" class="fas fa-star"></i>';
        }
        if($tutor->is_featured==1){
            return '<i style="color:#86f780" class="fas fa-asterisk"></i>';
        }
        if($tutor->is_verified==1){
            return '<i style="color:#007BFF" class="far fa-check-circle"></i>';
        }
        return "";
    }
    public function getRating(){
        $rating=4;
        $stars="";
        for($i=0;$i<5;$i++){
            if($i < $rating){
                $stars.='<span style="color:orange" class="fa fa-star"></span>';
            }else{
                $stars.='<span class="fa fa-star"></span>';
            }
        }
        return $stars;
    }
    public function save_tutor_id(){
        $id=$this->id;
        $mod= $id % 1000000;
        $div_res= (int) ($id / 1000000);
        $prefix="AA";
        switch($div_res){
            case 0:
                $prefix='A';
            break;
            case 1:
                $prefix='B';
            break;
            case 2:
                $prefix='C';
            break;
            case 3:
                $prefix='D';
            break;
            case 4:
                $prefix='E';
            break;
            case 5:
                $prefix='F';
            break;
            case 6:
                $prefix='G';
            break;
            case 7:
                $prefix='H';
            break;
            case 8:
                $prefix='I';
            break;
            case 9:
                $prefix='J';
            break;
            case 10:
                $prefix='K';
            break;
            case 11:
                $prefix='L';
            break;
            case 12:
                $prefix='M';
            break;
            case 13:
                $prefix='N';
            break;
            case 14:
                $prefix='O';
            break;
            case 15:
                $prefix='P';
            break;
            case 16:
                $prefix='Q';
            break;
            case 17:
                $prefix='R';
            break;
            case 18:
                $prefix='S';
            break;
            case 19:
                $prefix='T';
            break;
            case 20:
                $prefix='U';
            break;
            case 21:
                $prefix='V';
            break;
            case 22:
                $prefix='W';
            break;
            case 23:
                $prefix='X';
            break;
            case 24:
                $prefix='Y';
            break;
            case 25:
                $prefix='Z';
            break;
        }
        $num= sprintf("%06d", $mod);
        $this->tutor_id= $prefix.$num;
        $this->save();
        return true;
    }
    
}
