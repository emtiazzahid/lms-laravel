<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsToMany('App\Model\Course', 'course_student', 'student_id', 'course_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
