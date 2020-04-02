<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Nvq;
use App\Module;

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
}
