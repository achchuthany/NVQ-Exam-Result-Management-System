<?php

namespace App\Http\Controllers;

use App\Course;
use App\Employee;
use App\Student;
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
            ->orderBy('academic_years.name','asc')
            ->paginate(10);

        $courses = array();
        $academic_yers = array();
        foreach ($no_students_course as $stu){
            $courses[] =$stu->number_students;
            $academic_yers [] = $stu->name;
        }

        $no_staff_dept = Employee::select(DB::raw('count(employees.id) as no_staff'),'departments.code')
            ->leftjoin('departments','departments.id','=','employees.department_id')
            ->groupBy('department_id')
            ->groupBy('departments.code')
            ->orderBy('departments.code','asc')
            ->get();


        $departments = array();
        $no_staff_count = array();

        foreach ($no_staff_dept as $stf){
            $departments[] = $stf->code;
            $no_staff_count[] = $stf->no_staff;
        }
        $students = Student::select(DB::raw('count(students.id) as count'),'students.district')
            ->groupBy('students.district')
            ->orderBy('students.district','asc')
            ->get();

        $districts = array();
        $no_of_students_district = array();
        foreach($students as $stu){
            $districts[] = $stu->district;
            $no_of_students_district[] = $stu->count;
        }
        return view('dashboard',['districts'=>json_encode($districts),'no_of_students_district'=>json_encode($no_of_students_district),'departments'=>json_encode($departments),'no_staff_count'=>json_encode($no_staff_count),'courses'=>json_encode($courses),'academic_yers'=>json_encode($academic_yers),'no_tvec_exam_pass'=>$no_tvec_exam_pass,'no_tvec_exam_students' => $no_tvec_exam_students,'no_tvec_exam'=>$no_tvec_exam,'no_course_active'=>$no_course_active,'no_courses'=>$no_courses,'no_students'=>$no_students,'no_students_dropout'=>$no_students_dropout,'no_students_completed'=>$no_students_completed,'no_staff'=>$no_staff,'no_staff_permanent'=>$no_staff_permanent]);
        return response()->json(['$districts'=>$districts,'$no_of_students_district'=>($no_of_students_district),'$academic_yers'=>($academic_yers)],200);

    }
}
