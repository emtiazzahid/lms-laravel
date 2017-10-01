<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = [];
    
    public function student()
    {
        return $this->belongsToMany('App\Model\Student', 'course_student', 'student_id', 'course_id');
    }
}
