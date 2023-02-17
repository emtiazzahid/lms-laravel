<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Libraries\Enumerations\UserTypes;
use App\Models\TeacherCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class TeacherCourseController extends Controller
{
    //    List of Teacher Course
    public function getIndex(){
        if (Auth::user()->user_type != UserTypes::$TEACHER){
            Auth::logout();
            return redirect()->route('login');
        }
        $teacher_id = Auth::user()->id;
        $a = DB::table('teacher_courses')->select("teacher_courses.course_id")
            ->where('teacher_id', $teacher_id)
            ->get();
        $existingCourses= [];
        foreach ($a as  $key => $value){
            array_push($existingCourses, $value->course_id);
        }
        $courses = DB::table('courses')
            ->whereNotIn('courses.id',$existingCourses)
            ->where('status',CourseStatus::$APPROVED)
            ->get();
        $teacher_courses = DB::table('teacher_courses')
            ->join('courses','courses.id','teacher_courses.course_id')
            ->where('teacher_courses.teacher_id',$teacher_id)
            ->select(['teacher_courses.*','courses.title as course_title', 'courses.short_code as course_short_code'])
            ->get();
        $data = [
            'courses'=>$courses,
            'teacher_courses'=>$teacher_courses
        ];
//        dd($data);
        return view('admin.courses.my_course_list',$data);
    }

    // Add new Teacher Course
    public function add(Request $request)
    {
        if (Auth::user()->user_type != UserTypes::$TEACHER){
            Auth::logout();
            return redirect()->route('login');
        }
        $teacher_id = Auth::user()->id;

        $this->validate($request,[
            'course'     => 'required',
        ]);

        $existing_data = TeacherCourse::where('course_id',$request->course)->where('teacher_id',$teacher_id)->first();
        if ($existing_data){
            Session::flash('Error Message', 'This Course Already Taken.');
            return redirect()->route('my-courses-list');
        }

        $model = new TeacherCourse();
        $model->course_id = $request['course'];
        $model->teacher_id = $teacher_id;
        $model->save();

        Session::flash('Success Message', 'Course has been assigned to you.');
        return redirect()->route('my-courses-list');
    }

//    Delete Teacher Course
    public function delete($id){
        $model = TeacherCourse::find($id);
        $model->delete();

        Session::flash('Success Message', 'Course removed from your list.');
        return redirect()->route('my-courses-list');
    }

    public function getTeacherCourseListPage($teacherId)
    {

    }
}
