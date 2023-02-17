<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = [];
    
    public function student()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'student_id', 'course_id');
    }
}
