<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TrendingCourse extends Model
{
    protected $table = 'trending_courses';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo('App\Model\Course');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Model\Teacher','teacher_id','user_id');
    }
    
    public function teacher_course()
    {
        return $this->belongsTo('App\Model\TeacherCourse');
    }
}
