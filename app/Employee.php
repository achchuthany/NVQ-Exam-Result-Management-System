<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
class Employee extends Model
{
    public function department(){
        return $this->belongsTo('App\Department');
    }
    public function modules(){
        return $this->belongsToMany('App\Module', 'employee_module', 'employee_id', 'module_id');
    }
}
