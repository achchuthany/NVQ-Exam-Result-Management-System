<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvecExamResult extends Model
{
    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function tvec_exam(){
        return $this->belongsTo('App\TvecExam');
    }
}
