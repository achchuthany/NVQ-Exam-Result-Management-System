<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Batch;

class AcademicYear extends Model
{
    public function batches(){
        return $this->hasMany('App\Batch');
    }
}
