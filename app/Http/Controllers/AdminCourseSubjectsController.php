<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

use App\Course;
use App\Subject;

class AdminCourseSubjectsController extends CBController {


    public function cbInit()
    {
        $this->middleware('admin');
        
        $this->setTable("course_subjects");
        $this->setPermalink("course_subjects");
        $this->setPageTitle("Course Subjects");

        $this->addSelectTable("Subject","subject_id",["table"=>"subjects","value_option"=>"id","display_option"=>"title","sql_condition"=>""]);
		$this->addSelectTable("Course","course_id",["table"=>"courses","value_option"=>"id","display_option"=>"title","sql_condition"=>""]);
		

    }
    public function getEdit($id){
        if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        $page_title="Assign Subjects to Course";
        $course=Course::findOrFail($id);
        $subs=Subject::orderBy('title','asc')->get();
        $subjects=[];
        $ss=$course->subjects;
        foreach($subs as $subject){
            $subject->is_active=false;
            foreach($ss as $s){
                if($s->id==$subject->id){
                    $subject->is_active=true;
                break;
                }
            }
            $subjects[]=$subject;
        }
                // dd($subjects);
        return view('admin.course_subjects.edit',compact('page_title','course','subjects'));
    }
    public function postEditSave($id){
        if(!module()->canUpdate()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        // dd(request());
        $request=request();
        $course=Course::findOrFail($request->course_id);
        $course->subjects()->sync($request->subjects);
        return cb()->redirectBack(cbLang("the_data_has_been_added"), 'success');
    }
}
