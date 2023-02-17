<?php

namespace App\Http\Controllers;


use App\Libraries\Enumerations\CourseStudentStatus;
use App\Libraries\Enumerations\UserTypes;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\StudentCourse;
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

        DB::transaction(function ($request) {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password =  bcrypt($request['password']);
            $user->user_type = UserTypes::$STUDENT;
            $user->save();

            $meta = new \App\Models\Student();
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
        $incompleteCourses = StudentCourse::with(['teacher_course'=>function($q){$q->with(['course','teacher'=>function($q){$q->with(['user']);}]);}])
            ->where('student_id',$loggedStudentId)
            ->where('status',CourseStudentStatus::$INCOMPLETE)
            ->paginate(10,['*'], 'incompleteCourses');

        $completedCourses = StudentCourse::with(['teacher_course'=>function($q){$q->with(['course','teacher'=>function($q){$q->with(['user']);}]);}])
            ->where('student_id',$loggedStudentId)
            ->where('status',CourseStudentStatus::$COMPLETED)
            ->paginate(10,['*'], 'completedCourses');
        $data  = [
            'incompleteCourses' => $incompleteCourses,
            'completedCourses' => $completedCourses,
        ];

        return view('student.course.my_courses',$data);
    }

    public function getStudentCourseListPage($studentId)
    {
        $incompleteCourses = StudentCourse::with(['teacher_course'=>function($q){$q->with(['course','teacher'=>function($q){$q->with(['user']);}]);}])
            ->where('student_id',$studentId)
            ->where('status',CourseStudentStatus::$INCOMPLETE)
            ->paginate(10,['*'], 'incompleteCourses');

        $completedCourses = StudentCourse::with(['teacher_course'=>function($q){$q->with(['course','teacher'=>function($q){$q->with(['user']);}]);}])
            ->where('student_id',$studentId)
            ->where('status',CourseStudentStatus::$COMPLETED)
            ->paginate(10,['*'], 'completedCourses');
        $data  = [
            'studentId' => $studentId,
            'incompleteCourses' => $incompleteCourses,
            'completedCourses' => $completedCourses,
        ];

        return view('admin.students.student_courses',$data);
    }
}
