<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Employee;
class Department extends Model
{
    public function courses(){
        return $this->hasMany('App\Course');
    }
    public function employees(){
        return $this->hasMany('App\Employee');
    }
}
