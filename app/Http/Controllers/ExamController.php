<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\ExamStatus;
use App\Libraries\Enumerations\QuestionTypes;
use App\Libraries\Enumerations\ResultStatus;
use App\Models\AnswerBank;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamSubmission;
use App\Models\QuestionBank;
use App\Models\TeacherCourse;
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
        $exams = Exam::with('course','teacher','question_file')->where('teacher_id',$teacher_id)->get();
//         dd($exams->toArray());
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

    public function getStudentExamStartPage($exam_id)
    {
        $exam = Exam::with(['course','question_file','teacher'=>function($q){$q->with(['user']);}])
            ->where('id',$exam_id)
            ->first();
//        dd($exam->toArray());
        if (!$exam){
            dd('exam data error! please try again');
        }
        if ($exam->question_file->question_type == QuestionTypes::$WRITTEN){
            $writtenQuestions = json_decode($exam->question_file->question_body);
            $data = [
                'exam' => $exam,
                'writtenQuestions' => $writtenQuestions
            ];
//            dd($writtenQuestions);
            return view('student.exam.written_exam',$data);
        }elseif ($exam->question_file->question_type == QuestionTypes::$MCQ){
            $mcqQuestions = json_decode($exam->question_file->question_body);
            $data = [
                'exam' => $exam,
                'mcqQuestions' => $mcqQuestions
            ];
//            dd($mcqQuestions);
            return view('student.exam.mcq_exam',$data);
        }
        else
        {
            dd('Error! Unknown Question Type Found');
        }

    }
    
    public function postWrittenQuestionAnswers(Request $request)
    {
        $loggedStudentId = Auth::user()->id;

        $teacherCourse = TeacherCourse::where('course_id',$request->course_id)
            ->where('teacher_id',$request->teacher_id)
            ->first();

        $existingExamSubmission = ExamSubmission::where('exam_id',$request->exam_id)
            ->where('student_id',$loggedStudentId)->first();
        if (count($existingExamSubmission)>0){

            Session::flash('Error Message', 'Sorry you already submitted you answer');
            return redirect()->route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]);
        }
        $total_mark = 0.00;
//        dd($request->all());


        if (!$teacherCourse){
            Session::flash('Error Message', 'teacher course data error! this course is not assigned to any teacher now');
            return redirect()->route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]);
        }
        $answerFileString = json_encode($request->except(['question_type','exam_id','course_id','teacher_id','_token']));
        foreach ($request->id as $key => $question) {
            $total_mark += floatval($request->default_mark[$key]);

        }
        $answeredFile = new AnswerBank();
        $answeredFile->question_type = $request->question_type;
        $answeredFile->teacher_course_id = $teacherCourse->id;
        $answeredFile->question_answer_body = $answerFileString;
        $answeredFile->save();

        $examSubmission = new ExamSubmission();
        $examSubmission->exam_id = $request->exam_id;
        $examSubmission->student_id = $loggedStudentId;
        $examSubmission->answer_file_id = $answeredFile->id;
        $examSubmission->total_mark = $total_mark;
        $examSubmission->result_status = ResultStatus::$JUDGING;
        $examSubmission->save();

        Session::flash('Success Message', 'Written Exam successfully submitted. please wait until teacher judgement complete');
        return redirect()->route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]);
    }
    
    public function postWrittenQuestionAnswersWithJudgement(Request $request)
    {
//        dd($request->all());
        $answeredFile = AnswerBank::find($request->answer_file_id);
        $givenTotalMark = 0.00;
        $defaultTotalMark = 0.00;
        foreach ($request->id as $key => $value){
            $givenTotalMark += $request->given_mark[$key];
            $defaultTotalMark += $request->default_mark[$key];
        }

        $answerFileString = json_encode($request->except(['question_type','exam_id','course_id','teacher_id','_token']));


        $answeredFile->question_answer_body = $answerFileString;
        $answeredFile->save();


        $achievedScore = floatval(($givenTotalMark*100)/$defaultTotalMark);
        if ($achievedScore >= floatval($request->passing_score))
            $result_status = ResultStatus::$PASSED;
        else
            $result_status = ResultStatus::$FAILED;



        $examSubmission = ExamSubmission::find($request->exam_submission_id);
        $examSubmission->passed_score = $achievedScore;
        $examSubmission->achieve_mark = $givenTotalMark;
        $examSubmission->result_status = $result_status;
        $examSubmission->save();

        Session::flash('Success Message', 'Written Exam successfully judgement complete');
        return redirect()->route('getStudentSubmissionsPageByExam',['exam_id'=>$request->exam_id]);
    }
    
    public function postMcqQuestionAnswers(Request $request)
    {
//        dd($request->all());
        $loggedStudentId = Auth::user()->id;

        $teacherCourse = TeacherCourse::where('course_id',$request->course_id)
            ->where('teacher_id',$request->teacher_id)
            ->first();

        $existingExamSubmission = ExamSubmission::where('exam_id',$request->exam_id)
            ->where('student_id',$loggedStudentId)->first();
        if (count($existingExamSubmission)>0){

            Session::flash('Error Message', 'Sorry you already submitted you answer');
            return redirect()->route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]);
        }
        $total_mark = 0.00;
        $achieve_mark = 0.00;
        $passed_score = 0.00;


        if (!$teacherCourse){
            Session::flash('Error Message', 'teacher course data error! this course is not assigned to any teacher now');
            return redirect()->route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]);
        }
        $answerFileString = json_encode($request->except(['question_type','exam_id','course_id','teacher_id','_token']));
        $totalQuestion = 0;
        $passed = 0;
        foreach ($request->id as $key => $question) {
            $totalQuestion++;
            $total_mark += floatval($request->default_mark[$key]);
            if (floatval($request->right_answer[$key]) == floatval($request['answer_for_question_'.$key])){
                $achieve_mark += floatval($request->default_mark[$key]);
                $passed++;
            }
        }

        $passed_score = floatval(($passed*100)/$totalQuestion);
        if ($passed_score >= floatval($request->passing_score))
            $result_status = ResultStatus::$PASSED;
        else
            $result_status = ResultStatus::$FAILED;

        $answeredFile = new AnswerBank();
        $answeredFile->question_type = $request->question_type;
        $answeredFile->teacher_course_id = $teacherCourse->id;
        $answeredFile->question_answer_body = $answerFileString;
        $answeredFile->save();

        $examSubmission = new ExamSubmission();
        $examSubmission->exam_id = $request->exam_id;
        $examSubmission->student_id = $loggedStudentId;
        $examSubmission->answer_file_id = $answeredFile->id;
        $examSubmission->total_mark = $total_mark;
        $examSubmission->achieve_mark = $achieve_mark;
        $examSubmission->passed_score = $passed_score;
        $examSubmission->result_status = $result_status;
        $examSubmission->save();

        Session::flash('Success Message', 'Mcq Exam successfully submitted. you can see the result now');
        return redirect()->route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]);
        
    }

}
