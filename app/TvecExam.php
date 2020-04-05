<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AcademicYear;
use App\Module;
class TvecExam extends Model
{
    public function academic_year(){
        return $this->belongsTo('App\AcademicYear');
    } 
    public function module(){
        return $this->belongsTo('App\Module');
    } 
}
