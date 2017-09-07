<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\ExamStatus;
use App\Model\Course;
use App\Model\Exam;
use App\Model\QuestionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Enumerations\CourseStatus;
use DB;
use Session;

class ExamController extends Controller
{
    public function getExamListPage()
    {
        $teacher_id = Auth::user()->id;
        $exams = Exam::where('teacher_id',$teacher_id)->get();
        $data = [
            'exams' => $exams
        ];
        return view('teacher.exam.exam_list',$data);
    }
    
    public function getExamCreatePage()
    {
        $teacher_id = Auth::user()->id;
        $courses = DB::table('courses')
            ->join('teacher_courses','teacher_courses.course_id','courses.id')
            ->where('teacher_courses.teacher_id',$teacher_id)
            ->where('status',CourseStatus::$APPROVED)
            ->select('courses.*')
            ->get();
        $data = [
            'courses' => $courses
        ];
        return view('teacher.exam.exam_create',$data);
    }

    public function getQuestionFilesByCourse(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $questionFiles = QuestionBank::where('course_id',$request->course)->where('teacher_id',$teacher_id)->get();
        return $questionFiles;
    }

    public function saveExam(Request $request)
    {
        $this->validate($request,[
            'exam_title'      => 'required',
            'course'      => 'required',
            'question_file'     => 'required',
            'passing_score'     => 'required',
            'duration'     => 'required',
        ]);

        $teacher_id = Auth::user()->id;

        $model = new Exam();
        $model->exam_title = $request['exam_title'];
        $model->course_id = $request['course'];
        $model->teacher_id = $teacher_id;
        $model->question_file_id = $request['question_file'];
        $model->syllabus = $request['syllabus'];
        $model->passing_score = $request['passing_score'];
        $model->duration = $request['duration'];
        $model->status = ExamStatus::$RUNNING;
        $model->save();

        Session::flash('Success Message', 'Exam has been created successfully.');

        return redirect()->route('getExamListPage');
    }
    //    post Add or Edit Exam
    public function update(Request $request){
        $model = Exam::find($request->modal_id);
        $model->status = $request['status'];
        $model->save();
        Session::flash('Success Message', 'Exam status has been updated successfully.');
        return redirect()->route('getExamListPage');

    }

//    Delete Exam
    public function delete($id){
        $model = Exam::find($id);
        $model->delete();

        Session::flash('Success Message', 'Exam deleted successfully.');
        return redirect()->route('getExamListPage');
    }
}
