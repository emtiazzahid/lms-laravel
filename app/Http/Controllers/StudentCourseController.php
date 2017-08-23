<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function getAllCoursesForStudent()
    {
        $data = [

        ];
        return view('student.courses',$data);
    }
}
