<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Libraries\Enumerations\DepartmentStatus;
use App\Libraries\Enumerations\UserTypes;
use Illuminate\Http\Request;
use App\Model\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    //    List of Course
    public function getIndex(){
        $departments = DB::table('departments')->where('status',DepartmentStatus::$APPROVED)->get();
        $course = DB::table('courses')
            ->join('departments','courses.department_id','departments.id')
            ->select(['courses.*','departments.title as department_title'])
            ->get();
        $data = [
            'departments'=>$departments,
            'courses'=>$course
        ];
        return view('admin.courses.course_list',$data);
    }

    // Add new Course
    public function add(Request $request)
    {
        $this->validate($request,[
            'department'      => 'required',
            'title'      => 'required|min:3|max:100|unique:courses',
            'short_code'     => 'unique:courses',
        ]);

        $model = new Course();
        $model->department_id = $request['department'];
        $model->title = $request['title'];
        $model->short_code = $request['short_code'];
        if (Auth::user()->user_type == UserTypes::$TEACHER){
            $model->status = CourseStatus::$PENDING;
        }else
            $model->status = CourseStatus::$APPROVED;
        $model->save();

        Session::flash('Success Message', 'Course has been created successfully.');

        return redirect()->route('courses-list');
    }


//    post Add or Edit Course
    public function update(Request $request){
        $this->validate($request,[
            'department'      => 'required',
            'title'      => 'required|min:3|max:100|unique:courses,title,'.$request->modal_id,
            'short_code'     => 'unique:courses,short_code,'.$request->modal_id,
        ]);

        $model = Course::find($request->modal_id);
        $model->department_id = $request['department'];
        $model->title = $request['title'];
        $model->short_code = $request['short_code'];
        $model->status = $request['status'];
        $model->save();
        Session::flash('Success Message', 'Course has been updated successfully.');
        return redirect()->route('courses-list');

    }

//    Delete Course
    public function delete($id){
        $model = Course::find($id);
        $model->delete();

        Session::flash('Success Message', 'Course deleted successfully.');
        return redirect()->route('courses-list');
    }
}
