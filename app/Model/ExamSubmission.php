<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamSubmission extends Model
{
    protected $table = 'exam_submissions';
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo('App\Model\Exam');
    }
    public function student()
    {
        return $this->belongsTo('App\Model\Student','student_id','user_id');
    }
    public function answer_file()
    {
        return $this->belongsTo('App\Model\AnswerBank');
    }
}
