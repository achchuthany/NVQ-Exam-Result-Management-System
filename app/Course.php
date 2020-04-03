<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Nvq;
use App\Module;
use App\Batch;
class Course extends Model
{
    public function department(){
        return $this->belongsTo('App\Department');
    }
    public function nvq(){
        return $this->belongsTo('App\Nvq');
    }  
    public function modules(){
        return $this->hasMany('App\Module');
    } 
    public function batches(){
        return $this->hasMany('App\Batch');
    }   
    public function student_enrolls(){
        return $this->hasMany('App\StudentEnroll');
    }   
}
