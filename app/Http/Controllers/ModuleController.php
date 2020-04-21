<?php

namespace App\Http\Controllers;

use App\Module;
use App\Course;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    private $semesters = array('1'=>'Semester 1','2'=>'Semester 2');
    private $exams = array('T'=>'Theory','P'=>'Practical','B'=>'Theory and Practical');
    public function getModules(){

        $modules = Module::orderBy('code','asc')->paginate(20);
        return view('academic.modules',['modules' =>$modules,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function getModulesbyCourse($id){

        $modules = Module::where('course_id',$id)
                            ->orderBy('code','asc')
                            ->paginate(20);
        return view('academic.modules',['modules' =>$modules,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function getModuleCreate(){
        $courses = Course::orderBy('code','asc')->get();
        return view('academic.module',['courses' =>$courses,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function postModuleCreate(Request $request){
        $message = $warning = null;
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
        $isUpdate = true;
        $module = null;
        if($request['id']){
            $module = Module::where('id',$request['id'])->first();
        }
        if(!$module){
            $module = new Module();
            $isUpdate = false;
        }    
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
        $warning = 'There was an error';
        if($isUpdate && $module->update()){
            $message = $module->name.' successfully updated';
            $warning= null;
        }
        else if(!$isUpdate && $module->save()) {
            $message = $module->name . ' successfully created';
            $warning = null;
        }
        return redirect()->route('modules')->with(['message' => $message, 'warning' => $warning]);
    }
    public function getDeleteModule($id){
        $message = $warning = null;
        $post = Module::where('id',$id)->first();
        try {
            $result = $post->delete();
            $message = $post->name."  successfully Deleted!";
        } catch (QueryException  $e) {
            $warning = $post->name . " was not Deleted, Try Again!";
        }
        return redirect()->route('modules')->with(['message' => $message, 'warning' => $warning]);
    }
    public function getModuleEdit($id){
        $courses = Course::orderBy('name', 'asc')->get();
        $module = Module::where('id',$id)->first();
        return view('academic.module', ['module'=> $module,'courses' => $courses, 'semesters' => $this->semesters, 'exams' => $this->exams]);
    }
}
