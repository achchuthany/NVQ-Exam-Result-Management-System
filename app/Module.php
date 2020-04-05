<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\TvecExam;
class Module extends Model
{
    public function course(){
        return $this->belongsTo('App\Course');
    }
    public function tvec_exams(){
        return $this->hasMany('App\TvecExam');
    }
}
