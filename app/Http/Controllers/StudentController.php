<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudents(){
        return view('student.students');
    }
    public function getStudentCreate(){      
        return view('student.student');
    }
}
