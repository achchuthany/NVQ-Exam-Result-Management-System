<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\AcademicYear;

class Batch extends Model
{
    public function course(){
        return $this->belongsTo('App\Course');
    } 
    public function academic_year(){
        return $this->belongsTo('App\AcademicYear');
    }  
}
