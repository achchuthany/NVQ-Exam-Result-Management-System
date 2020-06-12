<?php

namespace App\Http\Controllers;

use App\Employee;
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
    public function getLecturerIndex(){
        $user = Auth::user();
        if (!$user) {
            return null;
        }
        $lecturer_id = $user->profile_id;
        $lecturer = Employee::where('id',$lecturer_id)->first();
        if(!$lecturer){
            return redirect()->back()->with(['warning'=>'Lecturer data is not available!']);
        }
        return view('employee.profile',['employee'=>$lecturer]);
    }
}
