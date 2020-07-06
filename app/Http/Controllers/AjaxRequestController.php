<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Module;
use App\Student;
use Illuminate\Http\Request;

class AjaxRequestController extends Controller
{
    public function postGetModulesbyCourse(Request $request){
        $this->validate($request,['id'=>'required']);
        $modules = Module::where('course_id',$request['id'])->orderBy('code','asc')->get();
        return response()->json(['modules' => $modules], 200);

    }
    public function postGetStudentsbyBatch(Request $request){
        $this->validate($request,['id'=>'required']);
        $batch = Batch::where('id',$request['id'])->first();
        $students = Student::leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
        ->select('student_id as id',"reg_no","title","fullname","shortname","gender","civil_status","email","nic","date_birth","phone","address","zip","district","divisional","province","blood","emergency_name","emergency_address","emergency_phone","emergency_relationship")
        ->where([['course_id',$batch->course_id],['academic_year_id',$batch->academic_year_id]])
        ->orderBy('reg_no','asc')
        ->get();
        return response()->json(['students' => $students], 200);

    }

    public function postGetStudentbyReg(Request $request){
        $this->validate($request,['id'=>'required']);
        $students = Student::where('reg_no','Like',$request['id'].'%')->get();
        return response()->json(['students' => $students], 200);

    }

    public function postGetBatchesbyCourse(Request $request){
        $this->validate($request,['id'=>'required']);
        $batches = Batch::where('course_id',$request['id'])->orderBy('name','desc')->get();
        return response()->json(['batches' => $batches], 200);
    }
}
