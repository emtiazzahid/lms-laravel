<?php

namespace App\Http\Controllers;

use App\Model\Exam;
use App\Model\ExamSubmission;
use App\Model\TeacherCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamSubmissionController extends Controller
{
    public function getStudentExamSubmissionsByCourse(Request $request)
    {
        $loggedTeacherId = Auth::user()->id;

        $teacherCourses = TeacherCourse::with('course')->where('teacher_id',$loggedTeacherId)->get();

        $exams = Exam::with(['submissions','course','question_file'])->where('teacher_id',$loggedTeacherId)->get();
        if ($request->has('course_id')){
            $exams = $exams->where('course_id',$request->course_id);
        }
        
        $data = [
            'teacherCourses' => $teacherCourses,
            'exams' => $exams,
        ];
//        dd($exams->toArray());
        return view('teacher.exam.students_exam_submissions',$data);
    }

    public function getStudentSubmissionsPageByExam($examId)
    {
        $examSubmissions = ExamSubmission::with(['student'=>function($q){
            $q->with('user');
        },'answer_file'])->where('exam_id',$examId)->get();


        $data = [
            'examSubmissions' => $examSubmissions,
        ];
//        dd($examSubmissions->toArray());
        return view('teacher.exam.exam_submission_list',$data);
    }
    
    public function judgeStudentExamSubmission($examSubmissionId)
    {
        $examSubmission = ExamSubmission::with(['student'=>function($q){
            $q->with('user');
        },'answer_file'])->where('id',$examSubmissionId)->first();


        $data = [
            'examSubmissions' => $examSubmission,
        ];
        dd($examSubmission->toArray());
        return view('teacher.exam.exam_submission_list',$data);
    }
    
    
}
