<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AcademicYear;
use App\Module;
use App\TvecExamResult;
class TvecExam extends Model
{
    public function academic_year(){
        return $this->belongsTo('App\AcademicYear');
    }
    public function module(){
        return $this->belongsTo('App\Module');
    }
    public function tvec_exam_results(){
        return $this->hasMany('App\TvecExamResult');
    }
}
