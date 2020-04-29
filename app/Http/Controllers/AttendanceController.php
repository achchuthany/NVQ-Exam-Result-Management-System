<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicYear;
use App\AttendanceSession;
use App\Module;
use App\Student;
use App\Attendance;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function getTakeIndex($id)
    {
        $message = $warning = null;
        $session = AttendanceSession::where('id', $id)->first();
        if (!$session) {
            $warning = "Please check you data!";
            return redirect()->route('attendance.manage')->with(['message' => $message, 'warning' => $warning]);
        }
        $module = Module::where('id', $session->module_id)->first();
        $academic = AcademicYear::where('id', $session->academic_year_id)->first();
        if (!$module || !$academic) {
            $warning = "Please check you data!";
            return redirect()->route('attendance.manage')->with(['message' => $message, 'warning' => $warning]);
        }
        $students = Student::leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
            ->select('student_id as id', "reg_no", "title", "fullname", "email", "nic")
            ->where([['course_id', $module->course_id], ['academic_year_id', $academic->id]])
            ->orderBy('reg_no', 'asc')
            ->get();

        return view('attendance.take', ['session' => $session, 'students' => $students, 'module' => $module, 'academic' => $academic]);
    } 

    public function getTakeCreate(Request $request)
    {
        $message = $warning = null;
        $attendance_session_id = $request['session_id'];
        $students = array();
        $attendances = array();
        foreach ($request['take'] as $key => $value) {
            $students[] = $key;
        }
        foreach ($request['take'] as $value) {
            $attendances[] = $value[0];
        }
        $present=$absent = 0;
        foreach($attendances as $attend){
            if($attend == '1'){
                $present++;
            }
            else{
                $absent++;
            }
        }
        //update present details in session
        $attend_session = AttendanceSession::where('id',$attendance_session_id)->first();
        if(!$attend_session){
            $warning = "Attendance Session not exits!";
            return redirect()->back()->with(['message' => $message, 'warning' => $warning]);
        }
        $attend_session->present = $present;
        $attend_session->absent = $absent;
        if($attend_session->update()){
            $message .= 'Attendance Session record updated successfully ';
        }

        //save or update student record
        foreach ($students as $id) {
            $isUpdate = true;
            $attendance = Attendance::where([['attendance_session_id', $attendance_session_id],['student_id',$id]])->first();
            if(!$attendance){
                $attendance = new Attendance();
                $isUpdate = false;
            }
            $attendance->attendance_session_id = $attendance_session_id;
            $attendance->student_id = $id;
            $attendance->is_present = $request['take'][$id][0];

            if($isUpdate && $attendance->update()){
                $message = 'Attendance record updated successfully ';
            }else if(!$isUpdate && $attendance->save()){
                $message = 'Attendance recorded successfully ';
            }else {
                $warning = 'Attendance record not created. Try again!';
            }
        }
        return redirect()->back()->with(['message' => $message, 'warning' => $warning]);
        //return response()->json(['present' => $present, 'absent' => $absent, 'request' => $request['take']], 200);
    }
}
