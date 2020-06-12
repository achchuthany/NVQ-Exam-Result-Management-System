<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AttendanceSession;
use App\StudentEnroll;
use App\TvecExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    public function getIndex(){
        $student = Auth::user();
        if(!$student){
            return null;
        }
        $logs = AttendanceSession::select('attendance_sessions.module_id', 'attendance_sessions.academic_year_id', DB::raw('count(attendances.id) as total'), DB::raw('sum(attendances.is_present) as present'))
            ->leftJoin('attendances', 'attendances.attendance_session_id', '=', 'attendance_sessions.id')
            ->groupBy('module_id')
            ->groupBy('academic_year_id')
            ->where('student_id',$student->profile_id)
            ->get();
        $datas = array();
        $labels = array();

        foreach ($logs as $log){
            $datas[] = round(($log->present/$log->total)*100);
            $labels[]=$log->module->name;
        }

        //GET STUDENT TVEC EXAM DATA
        $enroll = StudentEnroll::select(DB::raw('sum(tvec_exam_modules) as tvec_exam_modules'),DB::raw('sum(tvec_exam_pass) as tvec_exam_pass'))->groupBy(['student_id'])->where('student_id',$student->profile_id)->first();

        $count_course = StudentEnroll::select(DB::raw('count(course_id) as count'))->where('student_id',$student->profile_id)->first();
        $count_exams = TvecExamResult::select(DB::raw('count(student_id) as count'))->where('student_id',$student->profile_id)->first();
        $count_exams_pass = TvecExamResult::select(DB::raw('count(student_id) as count'))->where([['student_id',$student->profile_id],['result','P']])->first();
        $count_attendance = Attendance::select(DB::raw('sum(is_present) as present'),DB::raw('count(student_id) as count'))->where('student_id',$student->profile_id)->first();

        $enrolls = StudentEnroll::where('student_id',$student->profile_id)->get();
        return view('dashboard.student',['datas'=>json_encode($datas), 'labels'=>json_encode($labels),'enroll'=>$enroll,'enrolls'=>$enrolls,
            'count_course'=>$count_course,'count_exam'=>$count_exams,'count_exams_pass'=>$count_exams_pass,'count_attendance'=>$count_attendance]);
        return response()->json(['datas'=>($count_exams),'labels'=>($count_exams_pass)],200);
    }
}
