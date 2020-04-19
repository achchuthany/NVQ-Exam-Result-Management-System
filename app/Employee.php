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
    public function teachModules($id){
        return $this->modules()
        ->select('employee_module.id','courses.id as course_id','courses.name as course_name','modules.id as modules_id','modules.course_id','modules.code','modules.name','academic_years.name as academic_year_name','academic_years.status as academic_year_status')
        ->leftJoin('academic_years','academic_years.id','=','employee_module.academic_year_id')
        ->leftJoin('courses','courses.id','=','modules.course_id')
        ->where('employee_id',$id)
        ->orderBy('academic_year_name','desc')
        ->orderBy('code','asc')
        ->get();
    }
    public function teachModulesActive($id){
        return $this->modules()
        ->select('employee_module.id', 'modules.id as modules_id', 'modules.course_id', 'modules.code', 'modules.name', 'academic_years.name as academic_year_name', 'academic_years.status as academic_year_status')
        ->leftJoin('academic_years','academic_years.id','=','employee_module.academic_year_id')
        ->where([['employee_id',$id],['academic_years.status','Active']])->get();
    }
}
