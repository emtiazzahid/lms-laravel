<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Models\TeacherCourseLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TeacherCourseLessonController extends Controller
{
    //    List of Lessons
    public function getIndex(Request $request){

        $user_id = Auth::user()->id;
        $courses = DB::table('courses')
            ->join('teacher_courses','teacher_courses.course_id','courses.id')
            ->where('teacher_courses.teacher_id',$user_id)
            ->where('status',CourseStatus::$APPROVED)
            ->select('courses.*')
            ->get();
        if (isset($request->course_id)){
            $lessons = DB::table('teacher_course_lessons')
                ->where('course_id',$request->course_id)
                ->where('teacher_id',$user_id)
                ->get();
            $data = [
                'courses'=>$courses,
                'lessons'=>$lessons,
                'course_id'=>$request->course_id
            ];
        }else {
            $data = [
                'courses' => $courses,
            ];
        }

        return view('admin.lessons.lessons_list',$data);
    }

    // Add new Lessons
    public function add(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $this->validate($request,[
            'number'      => 'required',
            'title'      => 'required|max:100',
        ]);

        $model = new TeacherCourseLesson();
        $model->course_id = $request['course_id'];
        $model->teacher_id = $teacher_id;
        $model->number = $request['number'];
        $model->title = $request['title'];
        $model->save();

        Session::flash('Success Message', 'Lesson Added for this Course successfully.');

        return redirect()->route('course-lessons-list',['course_id' => $request['course_id']]);
    }

//    post Add or Edit Lessons
    public function update(Request $request){
        $this->validate($request,[
            'number'      => 'required',
            'title'      => 'required|max:100'
        ]);

        $model = TeacherCourseLesson::find($request->modal_id);
        $model->number = $request['number'];
        $model->title = $request['title'];
        $model->save();
        Session::flash('Success Message', 'Lesson has been updated successfully.');
        return redirect()->route('course-lessons-list',['course_id' => $request['course_id']]);

    }

//    Delete Lessons
    public function delete($course_id,$id){
        $model = TeacherCourseLesson::find($id);
        $model->delete();

        Session::flash('Success Message', 'Lesson Removed from this course successfully.');
        return redirect()->route('course-lessons-list',['course_id' => $course_id]);
    }
    
}
