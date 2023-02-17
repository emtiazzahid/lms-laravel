<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\QuestionTypes;
use App\Models\Exam;
use App\Models\ExamSubmission;
use App\Models\TeacherCourse;
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
            'examId' => $examId,
            'examSubmissions' => $examSubmissions,
        ];
//        dd($examSubmissions->toArray());
        return view('teacher.exam.exam_submission_list',$data);
    }
    
    public function judgeStudentExamSubmission($examSubmissionId)
    {
        $examSubmission = ExamSubmission::with(['student'=>function($q){
            $q->with('user');
        },'answer_file','exam'=>function($q){
            $q->with(['course','teacher'=>function($q){
                $q->with('user');
            }]);
        }])->where('id',$examSubmissionId)->first();

        if ($examSubmission->answer_file->question_type == QuestionTypes::$WRITTEN){
            $answerFile = json_decode($examSubmission->answer_file->question_answer_body);
            $data = [
                'examSubmission' => $examSubmission,
                'answerFile' => $answerFile,
            ];
//            dd($answerFile);
//            dd($examSubmission->toArray());
            return view('teacher.exam.written_exam_judge',$data);

        }elseif ($examSubmission->answer_file->question_type == QuestionTypes::$MCQ){
            dd('sorry! in current system, mcq exam submissions will judge by computer');
        }


    }
    
    public function viewStudentExamSubmissionFile($examSubmissionId)
    {
        $examSubmission = ExamSubmission::with(['student'=>function($q){
            $q->with('user');
        },'answer_file','exam'=>function($q){
            $q->with(['course','teacher'=>function($q){
                $q->with('user');
            }]);
        }])->where('id',$examSubmissionId)->first();
//        dd($examSubmission->toArray());

        if ($examSubmission->answer_file->question_type == QuestionTypes::$WRITTEN){
            $answerFile = json_decode($examSubmission->answer_file->question_answer_body);
            $data = [
                'examSubmissionId' => $examSubmissionId,
                'examSubmission' => $examSubmission,
                'answerFile' => $answerFile,
            ];
//            dd($examSubmission->toArray());
            return view('teacher.exam.written_exam_show',$data);

        }elseif ($examSubmission->answer_file->question_type == QuestionTypes::$MCQ){
            $mcqAnswerFile = json_decode($examSubmission->answer_file->question_answer_body);
            $data = [
                'examSubmissionId' => $examSubmissionId,
                'examSubmission' => $examSubmission,
                'answerFile' => $mcqAnswerFile,
            ];
//            dd($examSubmission->toArray());
            return view('teacher.exam.mcq_exam_show',$data);
        }
    }
    
    
}
