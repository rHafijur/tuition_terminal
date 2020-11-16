<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable=[
        'user_id',
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
    
}
