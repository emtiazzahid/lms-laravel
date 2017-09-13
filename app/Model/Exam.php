<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo('App\Model\Course');
    }
    
    public function teacher()
    {
        return $this->belongsTo('App\Model\Teacher','teacher_id','user_id');
    }
    
    public function question_file()
    {
        return $this->belongsTo('App\Model\QuestionBank','question_file_id');
    }
    public function submissions()
    {
        return $this->hasMany('App\Model\ExamSubmission');
    }

}
