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
}
