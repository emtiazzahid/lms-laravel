<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $table = 'teacher_courses';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id','user_id');
    }

    public function teacherCourseStudent()
    {
        return $this->hasMany(StudentCourse::class,'teacher_course_id');
    }
    
}
