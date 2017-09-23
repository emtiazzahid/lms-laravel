<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Model\Course;
use App\Model\Student;
use App\Model\Teacher;
use App\Repository\DashboardGraphDataRepo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardPage()
    {
        $totalCourses = Course::where('status',CourseStatus::$APPROVED)->get()->count();
        $totalTeachers = Teacher::get()->count();
        $totalStudents = Student::get()->count();
        
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
        ];
        return view('admin.dashboard',$data);
    }
}
