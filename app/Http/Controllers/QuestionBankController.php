<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Libraries\Enumerations\CourseStatus;

class QuestionBankController extends Controller
{
    public function saveQuestionInQuestionBank(Request $request)
    {
        $dataForQuestionBank = [
            'question_title' => $request->question_title,
            'question_type' => $request->question_type,
            'course_id' => $request->course_id,
            'teacher_id' => Auth::user()->id,
            'question_body' => $request->question_string,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        QuestionBank::create($dataForQuestionBank);
        return redirect()->route('getAllQuestionFiles',['course_id' => $request->course_id]);
    }
    public function getAllQuestionFileList(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $courses = DB::table('courses')
            ->join('teacher_courses','teacher_courses.course_id','courses.id')
            ->where('teacher_courses.teacher_id',$teacher_id)
            ->where('courses.status',CourseStatus::$APPROVED)
            ->select('courses.*')
            ->get();
        if (isset($request->course_id)){
            $questionFiles = QuestionBank::where('course_id',$request->course_id)->where('teacher_id',$teacher_id)->get();
            $data = [
                'courses' => $courses,
                'questionFiles' => $questionFiles,
            ];
        }else{
            $data = [
                'courses' => $courses,
            ];
        }
        return view('teacher.question.question_file_list',$data);
    }
    public function questionFileDetails($id)
    {
        $teacher_id = Auth::user()->id;
        $questionFile = QuestionBank::where('id',$id)->where('teacher_id',$teacher_id)->first();
        $questionBody = json_decode($questionFile->question_body);
        $data = [
            'questionBody' => $questionBody,
            'questionType' => $questionFile->question_type,
        ];
        return view('teacher.question.question_file_details',$data);

    }
}
