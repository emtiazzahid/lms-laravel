<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id','user_id');
    }
    
    public function question_file()
    {
        return $this->belongsTo(QuestionBank::class,'question_file_id');
    }
    public function submissions()
    {
        return $this->hasMany(ExamSubmission::class);
    }

}
