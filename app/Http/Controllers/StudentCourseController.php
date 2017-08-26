<?php

namespace App\Http\Controllers;

use App\Model\Course;
use App\Model\StudentCourse;
use App\Model\TeacherCourse;
use App\Model\TrendingCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Student;

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
        $studentCourses = StudentCourse::with('course')->where('student_id',$loggedStudentId)
            ->paginate(10,['*'], 'studentCourses');
        $data  = [
            'AllCourses' => $allCourse,
            'trendingCourses' => $trendingCourses,
            'studentCourses' => $studentCourses,
        ];
//        dd($trendingCourses);

        return view('student.course.courses',$data);
    }

    public function getCourseDetailsPage($teacherCourseId)
    {
        $teacherCourse = TeacherCourse::with(['course','teacher'=>function($q){$q->with(['user']);}])->find($teacherCourseId);
        
        $data = [
            'teacherCourse' => $teacherCourse,
        ];
        return view('student.course.course_details',$data);
    }
    
    
}
