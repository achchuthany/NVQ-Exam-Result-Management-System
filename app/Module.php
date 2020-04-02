<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
class Module extends Model
{
    public function course(){
        return $this->belongsTo('App\Course');
    }
}
