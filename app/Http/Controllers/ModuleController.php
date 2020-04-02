<?php

namespace App\Http\Controllers;

use App\Module;
use App\Course;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    private $semesters = array('1'=>'Semester 1','2'=>'Semester 2');
    private $exams = array('1'=>'Theory','2'=>'Practical','3'=>'Theory and Practical');
    public function getModules(){

        $modules = Module::orderBy('id','asc')->paginate(10);
        return view('academic.modules',['modules' =>$modules,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function getModuleCreate(){
        $courses = Course::orderBy('name','asc')->get();
        return view('academic.module',['courses' =>$courses,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function postModuleCreate(Request $request){
        $this->validate($request,[
            'modulename'=>'required|max:255',
            'code'=>'required|max:20',
            'coursename' => 'required|max:255',
            'notionalhours'=>'required|numeric',
            'lecturehours'=>'required|numeric',
            'practicalhours'=>'required|numeric',
            'selfhours'=>'required|numeric',
            'semester'=>'required|numeric',
            'examtype'=>'required'
            ]);
        $Course = Course::find($request['coursename']);
        if(!$Course){
            return null;
        }
        $module = new Module();
        $module->name = $request['modulename'];
        $module->course_id = $request['coursename'];
        $module->code = $request['code'];
        $module->aim = $request['aim'];
        $module->learning_hours = $request['notionalhours'];
        $module->resources = $request['resources'];
        $module->learning_outcomes = $request['outcomes'];
        $module->semester_id = $request['semester'];
        $module->exam_type = $request['examtype'];
        $module->reference = $request['references'];
        $module->relative_units = $request['relativeunit'];
        $module->lecture_hours = $request['lecturehours'];
        $module->practical_hours = $request['practicalhours'];
        $module->self_study_hours = $request['selfhours'];
        $message = 'There was an error';
        if($module->save()){
           $message = 'Course successfully created';
        }
        return redirect()->route('modules')->with(['message'=>$message]);
    }
    public function getDeleteModule($id){
        $post = Module::where('id',$id)->first();
        try {
            $result = $post->delete();
            $message = "Module Successfully Deleted!";
        } catch (QueryException  $e) {       
            $message = "Module was not Deleted, Try Again!";
        }
        return redirect()->route('modules')->with(['message'=>$message]);
    }
 
}
