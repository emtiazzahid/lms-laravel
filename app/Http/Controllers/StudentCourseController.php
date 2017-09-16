<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStudentStatus;
use App\Model\Course;
use App\Model\FileLesson;
use App\Model\StudentCourse;
use App\Model\Exam;
use App\Model\TeacherCourse;
use App\Model\TeacherCourseLesson;
use App\Model\TrendingCourse;
use App\Model\VideoLesson;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Student;
use Illuminate\Support\Facades\Session;

class StudentCourseController extends Controller
{
    public function getAllCoursesForStudent()
    {
        $loggedStudentId = Auth::user()->id;

        $allCourse = TeacherCourse::with(['course','teacher'=>function($q){$q->with(['user']);}])
            ->orderBy('teacher_courses.id','desc')
            ->paginate(10,['*'], 'allCourse');
//        dd($allCourse->toArray());
        $trendingCourses = TrendingCourse::with(['teacher_course'=>function($q){$q->with(['course','teacher'=>function($q){$q->with(['user']);}]);}])
                                            ->orderBy('trending_courses.id','desc')
                                            ->paginate(10,['*'], 'trendingCourses');
//        dd($trendingCourses->toArray());
        $studentCourses = StudentCourse::with(['teacher_course'=>function($q){$q->with(['course','teacher'=>function($q){$q->with(['user']);}]);}])
            ->orderBy('course_student.id','desc')
            ->where('student_id',$loggedStudentId)
            ->paginate(10,['*'], 'studentCourses');
//        dd($studentCourses->toArray());
        $data  = [
            'AllCourses' => $allCourse,
            'trendingCourses' => $trendingCourses,
            'studentCourses' => $studentCourses,
        ];
//        dd($data);

        return view('student.course.courses',$data);
    }

    public function getCourseDetailsPage($teacherCourseId)
    {
        $loggedStudentId = Auth::user()->id;
        $courseTaken = false;
        $studentCourseTaken = StudentCourse::where('teacher_course_id',$teacherCourseId)->where('student_id',$loggedStudentId)->first();
        if (count($studentCourseTaken)>0){
            $courseTaken = true;
        }
        // dd($studentCourseTaken->toArray());
        $teacherCourse = TeacherCourse::with(['course','teacher'=>function($q){$q->with(['user']);}])->find($teacherCourseId);
        $teacherCourseLessons = TeacherCourseLesson::where('teacher_id',$teacherCourse->teacher_id)
            ->where('course_id',$teacherCourse->course_id)->get();
//        dd($teacherCourseLessons->toArray());
        $data = [
            'teacherCourse' => $teacherCourse,
            'teacherCourseLessons' => $teacherCourseLessons,
            'courseTaken' => $courseTaken,
            'teacherCourseId' => $teacherCourseId,
        ];
        return view('student.course.course_details',$data);
    }

    public function attachStudentCourse($teacherCourseId)
    {
        $loggedStudentId = Auth::user()->id;
        $courseStudent = new StudentCourse();
        $courseStudent->student_id = $loggedStudentId;
        $courseStudent->teacher_course_id = $teacherCourseId;
        $courseStudent->status = CourseStudentStatus::$INCOMPLETE;
        $courseStudent->save();


        Session::flash('Success Message', 'Course Enroll Successful');

        return redirect()->route('getCourseLessonsForStudent',['teacher_course_id'=>$teacherCourseId]);
    }

    public function getCourseLessonsForStudent($teacher_course_id)
    {
            $teacher_course = TeacherCourse::where('id',$teacher_course_id)->first();
            if (!$teacher_course){
                dd('sorry! this course is not belongs to any teacher right now');
            }
//        $student_id = Auth::user()->id;
            $lessons = TeacherCourseLesson::where('course_id',$teacher_course->course_id)
                ->where('teacher_id',$teacher_course->teacher_id)
                ->get();
            $data = [
                'lessons'=>$lessons,
                'teacher_course_id'=>$teacher_course_id,
            ];

        return view('student.lesson.lessons_list',$data);
    }

    public function getStudentCourseLessonDetails($id)
    {
        $teacher_lesson = TeacherCourseLesson::where('id',$id)->first();

        if (!$teacher_lesson){
            Session::flash('Error Message', 'Lesson Data Not Found.');
            return redirect()->back();
        }
        $teacherCourse = TeacherCourse::where('teacher_id',$teacher_lesson->teacher_id)
            ->where('course_id',$teacher_lesson->course_id)->first();
        $teacher_info = User::where('id',$teacher_lesson->teacher_id)->first();
        $lesson_videos = VideoLesson::where('lesson_id',$id)->where('teacher_id',$teacher_lesson->teacher_id)->get();
        $lesson_files = FileLesson::where('lesson_id',$id)->where('teacher_id',$teacher_lesson->teacher_id)->get();
        $data = [
            'teacher_lesson' => $teacher_lesson,
            'lesson_id' => $id,
            'lesson_videos' => $lesson_videos,
            'lesson_files' => $lesson_files,
            'teacher_info' => $teacher_info,
            'teacherCourseId' => $teacherCourse->id,
        ];

        return view('student.lesson.lesson_details',$data);
    }

    public function getCourseExamsForStudent($teacher_course_id)
    {
           $teacher_course = TeacherCourse::where('id',$teacher_course_id)->first();
            if (!$teacher_course){
                dd('sorry! this course is not belongs to any teacher right now');
            }
            $loggedStudentId = Auth::user()->id;
            $exams = Exam::with(['submissions'=>function($q) use ($loggedStudentId){
                $q->where('student_id','=',$loggedStudentId);
            },'course','question_file','teacher'=>function($q){
                $q->with(['user']);
            }])
                ->where('course_id',$teacher_course->course_id)
                ->where('teacher_id',$teacher_course->teacher_id)
                ->get();
//            dd($exams->toArray());
            $data = [
                'exams'=>$exams,
                'teacher_course_id'=>$teacher_course_id,
            ];

        return view('student.exam.exam_list',$data);
    }
    
}
