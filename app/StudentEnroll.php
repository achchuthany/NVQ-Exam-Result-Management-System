<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEnroll extends Model
{
    public function student(){
        return $this->hasOne('App\Student');
    }
    public function academic_year(){
        return $this->belongsTo('App\AcademicYear');
    } 
    public function course(){
        return $this->belongsTo('App\Course');
    } 
}
