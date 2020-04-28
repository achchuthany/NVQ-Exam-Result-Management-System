<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Batch;
use App\StudentEnroll;
use App\TvecExam;
class AcademicYear extends Model
{
    public function batches(){
        return $this->hasMany('App\Batch');
    }
    public function student_enrolls(){
        return $this->hasMany('App\StudentEnroll');
    }
    public function tvec_exams(){
        return $this->hasMany('App\TvecExam');
    }
    public function attendance_sessions()
    {
        return $this->hasMany('App\AttendanceSession');
    }
}
