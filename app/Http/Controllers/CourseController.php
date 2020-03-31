<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Nvq;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses(){

        $courses = Course::orderBy('id','asc')->paginate(10);
        $departments = Department::orderBy('name','asc')->get();
        $nvqs = Nvq::orderBy('id','asc')->get();
        return view('academic.courses',['courses' =>$courses,'departments' =>$departments,'nvqs'=>$nvqs]);
    }
    public function getCourseCreate(){
        $departments = Department::orderBy('name','asc')->get();
        $nvqs = Nvq::orderBy('id','asc')->get();
        return view('academic.course',['departments' =>$departments,'nvqs'=>$nvqs]);
    }
    public function postCourseCreate(Request $request){
        $this->validate($request,[
            'name'=>'required|max:255',
            'department_id' => 'required',
            'nvq_id'=>'required',
            'duration'=>'required|numeric',
            'ojt_duration'=>'required|numeric'

            ]);
        $department = Department::find($request['department_id']);
        if(!$department){
            return null;
        }
        $nvq = Nvq::find($request['nvq_id']);
        if(!$nvq){
          return null;
        }
        $course = new Course();
        $course->name = $request['name'];
        $course->department_id = $request['department_id'];
        $course->nvq_id = $request['nvq_id'];
        $course->duration = $request['duration'];
        $course->ojt_duration = $request['ojt_duration'];
        $message = 'There was an error';
        if($course->save()){
           $message = 'Course successfully created';
        }
        return redirect()->route('courses')->with(['message'=>$message]);
    }
}
