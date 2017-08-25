<?php

namespace App\Http\Controllers;

use App\Model\Course;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function getAllCourse()
    {
        $allCourse = Course::all();
        $data  = [
            'AllCourses' => $allCourse,
        ];
        return view('student.course.courses',$data);
    }
}
