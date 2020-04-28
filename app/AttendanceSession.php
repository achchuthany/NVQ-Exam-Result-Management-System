<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    public function academic_year()
    {
        return $this->belongsTo('App\AcademicYear');
    }
    public function module()
    {
        return $this->belongsTo('App\Module');
    }
}
