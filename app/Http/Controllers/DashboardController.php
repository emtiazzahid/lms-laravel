<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\StudentCourse;
use App\Libraries\Enumerations\CourseStudentStatus;
use App\Repository\DashboardGraphDataRepo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardPage()
    {
        $totalCourses = Course::where('status',CourseStatus::$APPROVED)->get()->count();

        $totalTeachers = Teacher::get()->count();
        $totalStudents = Student::get()->count();
        $totalCertified = StudentCourse::where('status',CourseStudentStatus::$COMPLETED)->get()->count();
        
        $graphData = new DashboardGraphDataRepo();
        $studentGraphData = $graphData->getStudentActivityDataArray();
        $teacherGraphData = $graphData->getTeacherActivityDataArray();
        $topTeachers = $graphData->getTopFourTeacherList();

        $data = [
            'totalCourses' => $totalCourses,
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
            'studentGraphData' => $studentGraphData,
            'teacherGraphData' => $teacherGraphData,
            'topTeachers' => $topTeachers,
            'totalCertified' => $totalCertified,
        ];
        return view('admin.dashboard',$data);
    }
}
