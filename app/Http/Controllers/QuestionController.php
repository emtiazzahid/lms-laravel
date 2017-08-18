<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Repository\QuestionRepo;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function getQuestionsPage(Request $request)
    {
        $courseId = null;$lessonId = null;$part = null;
        if (isset($request->course)){$courseId = $request->course;}
        if (isset($request->lesson)){$lessonId = $request->lesson;}
        if (isset($request->course)){$part = $request->part;}
        
        $teacher_id = Auth::user()->id;
        $courses = DB::table('courses')
                ->join('teacher_courses','teacher_courses.course_id','courses.id')
                ->where('teacher_courses.teacher_id',$teacher_id)
                ->where('courses.status',CourseStatus::$APPROVED)
                ->select('courses.*')
                ->get();
        $questionRepo = new QuestionRepo();
        if ($courseId!=null){
            $writtenQuestions = $questionRepo->getWrittenQuestionsByFilter($courseId,$lessonId,$part);
            $mcqQuestions = $questionRepo->getMcqQuestionsByFilter($courseId,$lessonId,$part);
            $data = [
                'courses' => $courses,
                'writtenQuestions' => $writtenQuestions,
                'mcqQuestions' => $mcqQuestions,
            ];
        }else
        {
            $data = [
                'courses' => $courses,
            ];
        }
        return view('teacher.question.question_list',$data);
    }

    public function getLessonsByCourseId(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $lessons = DB::table('teacher_course_lessons')
                    ->where('course_id',$request->course_id)
                    ->where('teacher_id',$teacher_id)
                    ->get();
        return $lessons;
    }
    
    public function getPartsByLessonId(Request $request)
    {
        $lesson_file_part_numbers = DB::table('lesson_files')
            ->where('lesson_files.lesson_id',$request->lesson_id)
            ->select('part_number')
            ->get();
        $lesson_video_part_numbers = DB::table('lesson_videos')
            ->where('lesson_videos.lesson_id',$request->lesson_id)
            ->select('part_number')
            ->get();
        $part_numbers = [];
        if(count($lesson_file_part_numbers)>0){
            foreach ($lesson_file_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }
        if(count($lesson_video_part_numbers)>0){
            foreach ($lesson_video_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }

        return $part_numbers;
    }

    public function getQuestionsMakerPage()
    {
        $teacher_id = Auth::user()->id;
        $courses = DB::table('courses')
            ->join('teacher_courses','teacher_courses.course_id','courses.id')
            ->where('teacher_courses.teacher_id',$teacher_id)
            ->where('courses.status',CourseStatus::$APPROVED)
            ->select('courses.*')
            ->get();
        $data = [
            'courses' => $courses,
        ];
        return view('teacher.question.make_question',$data);
    }

    public function postQuestionsMakerPage(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $courses = DB::table('courses')
            ->join('teacher_courses','teacher_courses.course_id','courses.id')
            ->where('teacher_courses.teacher_id',$teacher_id)
            ->where('courses.status',CourseStatus::$APPROVED)
            ->select('courses.*')
            ->get();
        if (!isset($request->lessons)) {
            Session::flash('error', 'You have not selected any lesson.');
            return view('teacher.question.make_question', ['courses' => $courses]);
        } else {
            $lessons = $request->lessons;
            $parts = $request->parts;
            if($parts == null){
                $lesson_file_part_numbers = DB::table('lesson_files')
                    ->whereIn('lesson_files.lesson_id',$lessons)
                    ->select('part_number')
                    ->get();
                $lesson_video_part_numbers = DB::table('lesson_videos')
                    ->whereIn('lesson_videos.lesson_id',$lessons)
                    ->select('part_number')
                    ->get();
                $parts = [];
                if(count($lesson_file_part_numbers)>0){
                    foreach ($lesson_file_part_numbers as $data){
                        array_push($parts,$data->part_number);
                    }
                }
                if(count($lesson_video_part_numbers)>0){
                    foreach ($lesson_video_part_numbers as $data){
                        array_push($parts,$data->part_number);
                    }
                }
            }
            

            $questions = DB::table('questions')
                ->whereIn('lesson_id',$lessons)
                ->whereIn('part_number',$parts)
                ->orderBy(DB::raw('RAND()'))
                ->get();
            $questionString = json_encode($questions);
            $mcqs = DB::table('mcqs')
                ->whereIn('lesson_id',$lessons)
                ->whereIn('part_number',$parts)
                ->orderBy(DB::raw('RAND()'))
                ->get();
            $mcqString = json_encode($mcqs);
            
            $data = [
                'questions' => $questions,
                'questionString' => $questionString,
                'mcqs' => $mcqs,
                'mcqString' => $mcqString,
                'course_id' => $request->course,
                'courses' => $courses,
            ];
//            dd($data);
            return view('teacher.question.make_question', $data);
        }
    }

    public function getPartsByLessonIds(Request $request)
    {
        $lesson_file_part_numbers = DB::table('lesson_files')
            ->whereIn('lesson_files.lesson_id',$request->lessons)
            ->select('part_number')
            ->get();
        $lesson_video_part_numbers = DB::table('lesson_videos')
            ->whereIn('lesson_videos.lesson_id',$request->lessons)
            ->select('part_number')
            ->get();
        $part_numbers = [];
        if(count($lesson_file_part_numbers)>0){
            foreach ($lesson_file_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }
        if(count($lesson_video_part_numbers)>0){
            foreach ($lesson_video_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }

        return $part_numbers;
    }
}
