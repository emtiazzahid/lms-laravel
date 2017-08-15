<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class QuestionRepo
{
    public function getWrittenQuestionsByFilter($courseId = null, $lessonId = null, $part = null)
    {
        if ($courseId!=null && $lessonId!=null && $part!=null){
            $written_questions = DB::table('questions')
                ->join('teacher_course_lessons','teacher_course_lessons.id','questions.lesson_id')
                ->where('teacher_course_lessons.course_id',$courseId)
                ->where('teacher_course_lessons.id',$lessonId)
                ->where('questions.part_number',$part)
                ->get();
        }
        else if($courseId!=null && $lessonId!=null){
            $written_questions = DB::table('questions')
                ->join('teacher_course_lessons','teacher_course_lessons.id','questions.lesson_id')
                ->where('teacher_course_lessons.course_id',$courseId)
                ->where('teacher_course_lessons.id',$lessonId)
                ->get();
        }
        else if($courseId!=null){
            $written_questions = DB::table('questions')
                ->join('teacher_course_lessons','teacher_course_lessons.id','questions.lesson_id')
                ->where('teacher_course_lessons.course_id',$courseId)
                ->get();
        }
        if ($written_questions){
            return $written_questions;
        }
        return false;

      
       
    }
    public function getMcqQuestionsByFilter($courseId = null, $lessonId = null, $part = null)
    {
        if ($courseId!=null && $lessonId!=null && $part!=null){
            $mcq_questions = DB::table('mcqs')
                ->join('teacher_course_lessons','teacher_course_lessons.id','mcqs.lesson_id')
                ->where('teacher_course_lessons.course_id',$courseId)
                ->where('teacher_course_lessons.id',$lessonId)
                ->where('mcqs.part_number',$part)
                ->get();
        }
        else if($courseId!=null && $lessonId!=null){
            $mcq_questions = DB::table('mcqs')
                ->join('teacher_course_lessons','teacher_course_lessons.id','mcqs.lesson_id')
                ->where('teacher_course_lessons.course_id',$courseId)
                ->where('teacher_course_lessons.id',$lessonId)
                ->get();
        }
        else if($courseId!=null){
            $mcq_questions = DB::table('mcqs')
                ->join('teacher_course_lessons','teacher_course_lessons.id','mcqs.lesson_id')
                ->where('teacher_course_lessons.course_id',$courseId)
                ->get();
        }
        if ($mcq_questions){
            return $mcq_questions;
        }
        return false;
    }
}