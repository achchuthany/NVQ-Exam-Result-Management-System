<?php

namespace App\Http\Controllers;

use App\Employee;
use App\StudentEnroll;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function getDashboard(Request $request){


        $no_students = StudentEnroll::get()->count();
        $no_students_completed = StudentEnroll::where(['status'=>'Completed'])->get()->count();
        $no_students_dropout = StudentEnroll::where(['status'=>'Droupout'])->get()->count();
        $no_staff = Employee::get()->count();


        return view('dashboard',['no_students'=>$no_students,'no_students_dropout'=>$no_students_dropout,'no_students_completed'=>$no_students_completed,'no_staff'=>$no_staff]);
        return response()->json(['no_students'=>($no_students),'no_staff'=>($no_staff)],200);

    }
}
