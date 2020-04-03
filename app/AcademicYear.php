<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Batch;
use App\StudentEnroll;
class AcademicYear extends Model
{
    public function batches(){
        return $this->hasMany('App\Batch');
    }
    public function student_enrolls(){
        return $this->hasMany('App\StudentEnroll');
    }
}
