<?php

namespace App\Http\Controllers;


use App\Libraries\Enumerations\CourseStudentStatus;
use App\Libraries\Enumerations\UserTypes;
use Illuminate\Http\Request;
use App\Model\Student;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Model\StudentCourse;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //    List of Students
    public function getIndex(){
        $students = DB::table('users')
            ->join('students', 'users.id', 'students.user_id')
            ->get();
        return view('admin.students.students_list',['students'=>$students]);
    }

    // Add new Student
    public function add(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required|min:3|max:100',
            'email'     => 'required|email|unique:users|max:100',
        ]);

        DB::transaction(function ($request) use ($request) {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password =  bcrypt($request['password']);
            $user->user_type = UserTypes::$STUDENT;
            $user->save();

            $meta = new \App\Model\Student();
            $meta->user_id = $user->id;
            $meta->save();

            Session::flash('Success Message', 'Student has been created successfully.');
        });

        return redirect()->route('students-list');
    }


//    post Add or Edit Student
    public function update(Request $request){
        $this->validate($request,[
            'name'      => 'required|min:3|max:100',
            'email'     => 'required|unique:users,email,'.$request->modal_id,
        ]);

        $user = User::find($request->modal_id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        Session::flash('Success Message', 'Student has been updated successfully.');
        return redirect()->route('students-list');

    }

//    Delete Student
    public function delete($id){
        $user = User::find($id);
        $user->delete();

        Student::where('user_id',$id)->delete();

        Session::flash('Success Message', 'Student deleted successfully.');
        return redirect()->route('students-list');
    }

    public function getLoggedStudentCourses()
    {
        $loggedStudentId = Auth::user()->id;
        $incompleteCourses = StudentCourse::with('course')
            ->where('student_id',$loggedStudentId)
            ->where('status',CourseStudentStatus::$INCOMPLETE)
            ->paginate(10,['*'], 'studentCourses');
        
        $completedCourses = StudentCourse::with('course')
            ->where('student_id',$loggedStudentId)
            ->where('status',CourseStudentStatus::$COMPLETED)
            ->paginate(10,['*'], 'studentCourses');
        $data  = [
            'incompleteCourses' => $incompleteCourses,
            'completedCourses' => $completedCourses,
        ];
//        dd($trendingCourses);

        return view('student.course.my_courses',$data);
    }
}
