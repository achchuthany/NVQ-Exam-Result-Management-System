<?php

namespace App\Http\Controllers;

use App\StudentEnroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentEnrollController extends Controller
{
    private $semesters = array('1'=>'Semester 1','2'=>'Semester 2');
    private $exams = array('T'=>'Theory','P'=>'Practical','B'=>'Theory and Practical');
    public function getStudentCoursesIndex(){
        $enrolls = StudentEnroll::where('student_id',Auth::user()->profile_id)->get();
        return view('academic.courses_student',['enrolls'=>$enrolls,'semesters'=>$this->semesters,'exams'=>$this->exams]);
        //return response()->json(['enrolls'=>$enrolls ],200);
    }
}
