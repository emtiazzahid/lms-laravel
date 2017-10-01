<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $table = 'teacher_courses';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo('App\Model\Course');
    }
    
    public function teacher()
    {
        return $this->belongsTo('App\Model\Teacher','teacher_id','user_id');
    }

    public function teacherCourseStudent()
    {
        return $this->hasMany('App\Model\StudentCourse','teacher_course_id');
    }
    
}
