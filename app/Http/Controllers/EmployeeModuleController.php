<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Course;
use Illuminate\Http\Request;
use App\Employee;
use App\Module;
use Illuminate\Database\QueryException;

class EmployeeModuleController extends Controller
{
    public function getEnrollIndex(){
        $academic_year = AcademicYear::where('status','Active')->first();
        $employees = Employee::orderBy('fullname','asc')->paginate(30);
        //return response()->json(['employees'=>$employees],200);
        return view('employee.enrolls',['employees'=>$employees,'academic_year'=>$academic_year]);
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
       
        try{
            $module->employees()->attach($employee,['academic_year_id'=>$request['academic_year_id']]);
            $message = $employee->fullname.' successfully enrolled to '.$module->name .' in '.$academic->name;
        }catch (QueryException  $e){
            $warning = 'There was an error';
        }
        return redirect()->route('employees.enroll')->with(['message'=>$message,'warning'=>$warning]);
    }
}
