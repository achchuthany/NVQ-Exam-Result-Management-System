<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Course;
use Illuminate\Http\Request;
use App\Employee;
use App\Module;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class EmployeeModuleController extends Controller
{
    public function getEnrollIndex(){
        $academic_year = AcademicYear::where('status','Active')->first();
        $employees = Employee::orderBy('fullname','asc')->paginate(30);
        //return response()->json(['employees'=>$employees],200);

        $courses = Course::orderBy('name','asc')->get();
        $academic_years = AcademicYear::orderBy('name','desc')->paginate(30);

        return view('employee.enrolls',['employees'=>$employees,'academic_year'=>$academic_year,'courses'=>$courses,'academic_years'=>$academic_years]);
    }
    public function getEnrollCreateIndex(){
        $employees = Employee::orderBy('fullname','asc')->get();
        $courses = Course::orderBy('name','asc')->get();
        $academic_years = AcademicYear::orderBy('name','desc')->paginate(30);
        return view('employee.enroll',['employees'=>$employees,'courses'=>$courses,'academic_years'=>$academic_years]);
    }
    public function getProfileIndex($id){
        $employee = Employee::where('id',$id)->first();
        return view('employee.profile',['employee'=>$employee]);
    }
    public function postEnrollCreate(Request $request){
        $this->validate($request,[
            'employee'=>'required',
            'academic_year_id'=>'required',
            'course_id'=>'required',
            'modules'=>'required'
        ]);
        $employee = Employee::where('id',$request['employee'])->first();
        $module = Module::where('id',$request['modules'])->first();
        $academic = AcademicYear::where('id',$request['academic_year_id'])->first();
        $message=$warning=null;
       if(DB::table('employee_module')->where([['employee_id', $request['employee']],['academic_year_id', $request['academic_year_id']],['module_id', $request['modules']]])->first()){
            $warning = 'Already Created!!';
       }
        else{
            $module->employees()->attach($employee,['academic_year_id'=>$request['academic_year_id']]);
            $message = $employee->fullname.' successfully enrolled to '.$module->name .' in '.$academic->name;
        }
        return redirect()->back()->with(['message'=>$message,'warning'=>$warning]);
    }

    public function getDeleteEnroll($id){
        $message = $warning = null;

        try{
            $enroll = DB::table('employee_module')->where('id', $id)->delete();
            $message = 'Successfully deleted';
        }catch(QueryException $e){
            $warning = 'There was an error';
        }
        return redirect()->back()->with(['message' => $message, 'warning' => $warning]);

    }
    public function getEnrolledModules(){
        $lecturer = Auth::user();
        if(!$lecturer){
            return redirect()->back()->with(['warning'=>'Lecturer data is not available!']);
        }
        $lecturer_id = $lecturer->profile_id;
        $employee = Employee::where('id',$lecturer_id)->first();
        return view('employee.enrolledModules',['employee'=>$employee]);
    }
}
