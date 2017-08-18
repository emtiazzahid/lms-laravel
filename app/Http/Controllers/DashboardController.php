<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Model\Course;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardPage()
    {
        $totalCourses = Course::where('status',CourseStatus::$APPROVED)->get()->count();
        $totalTeachers = Teacher::get()->count();
        $totalStudents = Student::get()->count();
        $data = [
            'totalCourses' => $totalCourses,
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
        ];
        return view('admin.dashboard',$data);
    }
}
