<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentEnroll;
class Student extends Model
{
    public function student_enroll(){
        return $this->hasOne('App\StudentEnroll');
    }
    public function tvec_exam_results(){
        return $this->hasMany('App\TvecExamResult');
    }
    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }
    public function hasAttend($session_id)
    {
        return $this->attendances()
            ->leftJoin('attendance_sessions', 'attendances.attendance_session_id', '=', 'attendance_sessions.id')
            ->where('attendance_session_id', $session_id)
            ->first();
    }
}
