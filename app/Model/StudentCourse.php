<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = 'course_student';
    protected $guarded = [];
    
    public function course()
    {
        return $this->belongsTo('App\Model\Course');
    }
    public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }

}
