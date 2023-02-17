<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrendingCourse extends Model
{
    protected $table = 'trending_courses';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id','user_id');
    }
    
    public function teacher_course()
    {
        return $this->belongsTo(TeacherCourse::class);
    }
}
