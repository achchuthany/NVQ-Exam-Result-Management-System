<?php

namespace App\Http\Controllers;

use App\Course;
use App\Employee;
use App\StudentEnroll;
use App\TvecExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    //
    public function getDashboard(Request $request){


        $no_students = StudentEnroll::get()->count();
        $no_students_completed = StudentEnroll::where(['status'=>'Completed'])->get()->count();
        $no_students_dropout = StudentEnroll::where(['status'=>'Droupout'])->get()->count();

        $no_staff = Employee::where(['status'=>'Working'])->get()->count();
        $no_staff_permanent = Employee::where([['position_type','Permanent'],['status','Working']])->get()->count();

        $no_courses = Course::get()->count();
        $no_course_active = StudentEnroll::leftjoin('courses','courses.id','=','student_enrolls.course_id')
            ->leftjoin('academic_years','academic_years.id','=','student_enrolls.academic_year_id')
            ->where(['academic_years.status'=>'Active'])
            ->get()->count();

        $no_tvec_exam = TvecExam::get()->count();

        $no_tvec_exam_students = TvecExam::select(DB::raw('sum(number_students) as no_tvec_exam_students'))->first();
        $no_tvec_exam_pass = TvecExam::select(DB::raw('sum(number_pass) as no_tvec_exam_pass'))->first();


        $no_students_course = StudentEnroll::select('academic_year_id','academic_years.name',
            DB::raw('count(student_id) as number_students'))
            ->leftjoin('academic_years','academic_years.id','=','student_enrolls.academic_year_id')
            ->groupBy('academic_year_id')
            ->groupBy('academic_years.name')
            ->paginate(10);

        $courses = array();
        $academic_yers = array();
        foreach ($no_students_course as $stu){
            $courses[] =$stu->number_students;
            $academic_yers [] = $stu->name;
        }
        return view('dashboard',['courses'=>json_encode($courses),'academic_yers'=>json_encode($academic_yers),'no_tvec_exam_pass'=>$no_tvec_exam_pass,'no_tvec_exam_students' => $no_tvec_exam_students,'no_tvec_exam'=>$no_tvec_exam,'no_course_active'=>$no_course_active,'no_courses'=>$no_courses,'no_students'=>$no_students,'no_students_dropout'=>$no_students_dropout,'no_students_completed'=>$no_students_completed,'no_staff'=>$no_staff,'no_staff_permanent'=>$no_staff_permanent]);
        return response()->json(['$no_students_course'=>$no_students_course,'$courses'=>($courses),'$academic_yers'=>($academic_yers)],200);

    }
}
