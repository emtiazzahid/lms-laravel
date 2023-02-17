<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Libraries\Enumerations\DepartmentStatus;
use App\Libraries\Enumerations\UserTypes;
use App\Models\TeacherCourse;
use App\Models\TrendingCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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
        $model->featured_text = $request['featured_text'];
        if (Auth::user()->user_type == UserTypes::$TEACHER){
            $model->status = CourseStatus::$PENDING;
        }else
            $model->status = CourseStatus::$APPROVED;
        $model->save();

        if($request->file())
        {

            $file = $request->file('featured_image');
            $extention  = $file->getClientOriginalExtension();
            $fileName = 'course_'.$model->id.".".$extention;

            $destinationPath = '/admin/images/courses/';
            $path = $destinationPath. $fileName;
            $savingPath = public_path().$destinationPath. $fileName;
            Image::make($file->getRealPath())->resize(200, 200)->save($savingPath);
            DB::table('courses')->where('id', $model->id)->update(['featured_image' => $path]);
        }

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
        $model->featured_text = $request['featured_text'];
        $model->save();

        if($request->file())
        {
            $file = $request->file('new_featured_image');
            $extention  = $file->getClientOriginalExtension();
            $fileName = 'course_'.$request->modal_id.".".$extention;

            $destinationPath = '/admin/images/courses/';
            $path = $destinationPath. $fileName;
            $savingPath = public_path().$destinationPath. $fileName;
            Image::make($file->getRealPath())->resize(200, 200)->save($savingPath);
            DB::table('courses')->where('id', $model->id)->update(['featured_image' => $path]);
        }


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

    public function getCourseListingPage()
    {
        $teacherCourses = TeacherCourse::with(['course','teacher'=>function($q){$q->with(['user']);}])->get();
        $trendingCourses = DB::table('trending_courses')
            ->join('courses','courses.id','trending_courses.teacher_course_id')
            ->select(['trending_courses.*','courses.title as course_title'])
            ->get();

        $data = [
            'teacherCourses'=>$teacherCourses,
            'trendingCourses'=>$trendingCourses,
        ];
        return view('admin.courses.course_listing_settings',$data);
    }
    
    public function postTrendingCourse(Request $request)
    {
        $this->validate($request,[
            'course'      => 'required|unique:trending_courses,teacher_course_id,'.$request->modal_id,
        ]);

        $model = new TrendingCourse();
        $model->teacher_course_id = $request['course'];
        $model->save();

        Session::flash('Success Message', 'Trending Course Added successfully.');
        return redirect()->route('courses-listing-settings');
    }
    
    public function trendingCourseDelete($id)
    {
        $model = TrendingCourse::find($id);
        $model->delete();

        Session::flash('Success Message', 'Trending Course deleted successfully.');
        return redirect()->route('courses-listing-settings');
    }
    
}
