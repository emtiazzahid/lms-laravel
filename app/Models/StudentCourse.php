<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = 'course_student';
    protected $guarded = [];
    
    public function teacher_course()
    {
        return $this->belongsTo(TeacherCourse::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id','user_id');
    }

}
