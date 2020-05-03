<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getStudentIndex(){
        $student = Auth::user();
        if(!$student){
            return null;
        }
        $student_id = $student->profile_id;
        $student = Student::where('id',$student_id)->first();
        if(!$student){
            return redirect()->back()->with(['warning'=>'Student data is not available!']);
        }
        return view('profile.student',['student'=>$student]);
    }
}
