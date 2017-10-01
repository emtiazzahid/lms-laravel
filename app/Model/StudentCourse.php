<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = 'course_student';
    protected $guarded = [];
    
    public function teacher_course()
    {
        return $this->belongsTo('App\Model\TeacherCourse');
    }
    public function student()
    {
        return $this->belongsTo('App\Model\Student' , 'student_id','user_id');
    }

}
