<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherReview extends Model
{
    protected $table = 'teacher_reviews';
    protected $guarded = [];

    public function student()
    {
        $this->belongsTo(Student::class);
    }
}
