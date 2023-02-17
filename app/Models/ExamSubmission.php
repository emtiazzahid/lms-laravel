<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSubmission extends Model
{
    protected $table = 'exam_submissions';
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','user_id');
    }
    public function answer_file()
    {
        return $this->belongsTo(AnswerBank::class);
    }
}
