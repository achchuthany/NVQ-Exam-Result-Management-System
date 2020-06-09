<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Attendance;
use App\AttendanceSession;
use App\Employee;
use App\Module;
use App\Student;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceSessionController extends Controller
{
    public function getManageIndex($mid,$aid){
        $user = Auth::user();
        $message = $warning = null;
        $employees = Employee::leftjoin('employee_module', 'employee_module.employee_id','=', 'employees.id')
                                ->where([['module_id', $mid], ['academic_year_id', $aid]])
                                ->get();

        //check to login teacher to edit
        if($user->hasRole('Lecturer')){
            foreach( $employees as $employee){
                if($employee->employee_id != $user->profile_id){
                    return redirect()->back()->with(['warning'=>'You are not enrolled to this module!']);
                }
            }
        }

        $module = Module::where('id',$mid)->first();
        $academic = AcademicYear::where('id',$aid)->first();
        if (!$module || !$academic ||  !$employees){
            $warning = "Please check you data!";
            return redirect()->back()->with(['message' => $message, 'warning' => $warning]);
        }
        $sessions = AttendanceSession::where([['module_id',$mid],['academic_year_id',$aid]])->orderBy('date', 'asc')->paginate(20);
        //return response()->json($role, 200);
       return view('attendance.manage',['sessions'=> $sessions,'module'=> $module, 'academic' => $academic, 'employees' => $employees]);
    }

      public function getSessionIndex($mid,$aid){
        $user = Auth::user();
        $message = $warning = null;
          $employees = Employee::leftjoin('employee_module', 'employee_module.employee_id','=', 'employees.id')
              ->where([['module_id', $mid], ['academic_year_id', $aid]])
              ->get();

          //check to login teacher to edit
          if($user->hasRole('Lecturer')){
              foreach( $employees as $employee){
                  if($employee->employee_id != $user->profile_id){
                      return redirect()->back()->with(['warning'=>'You are not enrolled to this module!']);
                  }
              }
          }
        $module = Module::where('id', $mid)->first();
        $academic = AcademicYear::where('id', $aid)->first();
        if (!$module || !$academic) {
            $warning = "Please check you data!";
            return redirect()->route('departments')->with(['message' => $message, 'warning' => $warning]);
        }
        return view('attendance.session', ['module' => $module, 'academic' => $academic]);
      }

      public function postSessionCreate(Request $request){
        $message = $warning = null;
        $this->validate($request, [
            'date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required'
        ]);

        $date = new Carbon(new DateTime($request['date']));
        $repeat_date = new Carbon(new DateTime($request['repeat_date']));
        $repeats = $request['repeats'];
        $time_from = new Carbon(new DateTime($request['time_from']));
        $time_to = new Carbon(new DateTime($request['time_to']));
        $description = $request['description'];
        $module_id = $request['module_id'];
        $academic_year_id = $request['academic_year_id'];

        if($time_from->DiffInMinutes($time_to) <= 45){
            $warning = " The end time must be greater than start time and minimum duration is 45 minutes";
            return redirect()->back()->with(['warning' => $warning]);
        }
        $dates =array();
        $i=0;
        if($repeat_date && $repeats && $repeat_date->greaterThan($date)){
            while($date->lessThanOrEqualTo($repeat_date)){
                foreach($repeats as $repeat){
                    if($repeat == $date->isoFormat('dddd'))
                        $dates[] =$date->format('Y-m-d');
                }
                $date->addDay();
            }
        }else{
            $da = new Carbon(new DateTime($request['date']));
            $dates[] = $da->format('Y-m-d');
        }
        $message = 'Attendance Session on ';
        foreach ($dates as $date) {
            $as = new AttendanceSession();
            $as->date = $date;
            $as->time_from = $time_from->format('H:i');
            $as->time_to = $time_to->format('H:i');
            $as->module_id = $module_id;
            $as->academic_year_id = $academic_year_id;
            $as->description = $description;
            if($as->save()){
                $message .= $as->date .', ';
            }else{
                $warning .= 'Attendance Session not created. Try again!';
            }
        }
            $message .= 'created successfully';
       // return response()->json(['date'=> $date , 'repeat_date'=> $repeat_date,'dates'=>$dates], 200);
        return redirect()->route('attendance.manage',['mid'=> $module_id,'aid'=> $academic_year_id])->with(['message' => $message, 'warning' => $warning]);
      }
    public function postSessionsDelete(Request $request){
        $message = $warning = null;
        $this->validate($request, [
            'selected' => 'required'
        ]);

        foreach ($request['selected'] as $id) {
            $session = AttendanceSession::where('id',$id)->first();
            $attendance = Attendance::where('attendance_session_id',$id)->delete();
            if($session->delete()){
                $message = "Attendance Sessions Successfully Deleted!";
            }else{
                $warning = "Attendance Sessions was not Deleted, Try Again!";
            }
        }
        //return response()->json(['attendance'=> $attendance], 200);
        return redirect()->back()->with(['message' => $message, 'warning' => $warning]);
    }
    public function postSessionDelete($id){

    }
}
