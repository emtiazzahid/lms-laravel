<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\CourseStatus;
use App\Libraries\Enumerations\CourseStudentStatus;
use App\Libraries\Enumerations\UserTypes;
use App\Models\Exam;
use App\Models\StudentCertificate;
use App\Models\StudentCourse;
use App\Models\TeacherCourse;
use App\Models\TeacherReview;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class TeacherController extends Controller
{
    //    List of Teachers
    public function getIndex(){
        $teachers = DB::table('users')
                    ->join('teachers', 'users.id', 'teachers.user_id')
                    ->get();
        return view('admin.teachers.teachers_list',['teachers'=>$teachers]);
    }

    // Add new Teacher
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
            $user->user_type = UserTypes::$TEACHER;
            $user->save();

            $meta = new \App\Models\Teacher();
            $meta->user_id = $user->id;
            $meta->save();

            Session::flash('Success Message', 'Teacher has been created successfully.');
        });

        return redirect()->route('teachers-list');
    }


//    post Add or Edit Teacher
    public function update(Request $request){
        $this->validate($request,[
            'name'      => 'required|min:3|max:100',
            'email'     => 'required|unique:users,email,'.$request->modal_id,
        ]);

        $user = User::find($request->modal_id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        Session::flash('Success Message', 'Teacher has been updated successfully.');
        return redirect()->route('teachers-list');

    }

//    Delete Teacher
    public function delete($id){
        $user = User::find($id);
        $user->delete();

        Teacher::where('user_id',$id)->delete();

        Session::flash('Success Message', 'Teacher deleted successfully.');
        return redirect()->route('teachers-list');
    }

    public function getTeacherCourseListPage($teacherId)
    {
        $teacher_id = $teacherId;
        $teacher_courses = DB::table('teacher_courses')
            ->join('courses','courses.id','teacher_courses.course_id')
            ->where('teacher_courses.teacher_id',$teacher_id)
            ->select(['teacher_courses.*','courses.title as course_title', 'courses.short_code as course_short_code'])
            ->get();
        $data = [
            'teacher_id'=>$teacher_id,
            'teacher_courses'=>$teacher_courses
        ];
//        dd($data);
        return view('admin.teachers.teacher_course_list',$data);
    }

    public function updateTeacherRating(Request $request)
    {
        $loggedStudentId = Auth::user()->id;
//        $previousPoints = TeacherReview::where('teacher_id',$request->teacherId)->get();
//        $length = count($previousPoints);
//        $totalPoints = 0;
//        foreach ($previousPoints as $point)
//        {
//            $totalPoints += (int) $point->point;
//        }
//        $avgPoint = $totalPoints / $length;
        $studentPreviousRating = TeacherReview::where('teacher_id',$request->teacherId)
            ->where('student_id',$loggedStudentId)->first();
        if (count($studentPreviousRating)>0){
            $studentPreviousRating->point = $request->point;
            $studentPreviousRating->save();
            return 'success';
        }
        $dataForRating = [
            'student_id' => $loggedStudentId,
            'teacher_id' => $request->teacherId,
            'point' => $request->point
        ];
        if (TeacherReview::insert($dataForRating)){
            return 'success';
        }
        return 'error';
    }

    public function getTeacherStudentsListPage(Request $request)
    {
        $loggedTeacherId = Auth::user()->id;

        $teacherInfo = Teacher::with(['user','signature'])->where('user_id',$loggedTeacherId)->first();
//        dd($teacherInfo->toArray());
        $studentsWithTeacher = TeacherCourse::with(['teacherCourseStudent'=>function($r){
            $r->with(['teacher_course'=>function($as){
                $as->with('course');
            },'student'=>function($hg){
                $hg->with('user');
            }]);
        }])
            ->whereHas('teacherCourseStudent',function($q){
            $q->with(['student'=>function($n){
                $n->with('user');
            }]);
        })->where('teacher_id',$loggedTeacherId)->get();
//        dd($studentsWithTeacher->toArray());

        $studentArray = [];
        if (!$studentsWithTeacher)
        {
            return view('teacher.student.students_list',['students' => false]);
        }
        foreach ($studentsWithTeacher as $student)
        {
            if (!$student->teacherCourseStudent)
            {
                return view('teacher.student.students_list',['students' => false]);
            }
            foreach ($student->teacherCourseStudent as $tcStudent)
            {
                $studentArray[] = $tcStudent->toArray();
            }
        }
//        dd($studentArray);
        $data = [
            'students' => $studentArray,
            'teacherInfo' => $teacherInfo,
        ];
        return view('teacher.student.students_list',$data);


    }

    public function getExamsWithSubmissions(Request $request)
    {
        if ($request->course_id != null && $request->teacher_id != null && $request->student_id != null)
        {
            $student_id = $request->student_id;
            $data = Exam::with(['submissions'=>function($q) use ($student_id){
                $q->where('student_id',$student_id);
            }])
                ->where('course_id', $request->course_id)
                ->where('teacher_id', $request->teacher_id)
                ->get()->toArray();
        }else
            $data = 'false';
        return $data;
    }

    public function certifyStudent(Request $request)
    {

        $this->validate($request,[
            'course_id'      => 'required',
            'student_id'      => 'required',
            'teacher_id'     => 'required',
        ]);

        $dataForCertificateBlade = [
            'student_name' => $request->student_name,
            'course_name' => $request->course_name,
            'teacher_name' => $request->teacher_name,
            'signature_image' => $request->signature_image,
            'date' => date('d M Y'),
        ];
        $html = View::make('teacher.student.certificate', $dataForCertificateBlade);
        $pdfUPN = PDF::loadHTML($html)->setPaper('A4', 'landscape');
        $output = $pdfUPN->output();

        if (!file_exists(asset('certificates'))) {
            mkdir(asset('certificates'), 0777, true);
        }
        $fileFullPath = 'certificates/user_'.$request->student_id.'.pdf';
        if (file_exists(asset($fileFullPath))) {
            $fp = fopen($fileFullPath, 'r+');
            file_put_contents($fileFullPath, $output);
            fclose($fp);
        }else
            file_put_contents($fileFullPath, $output);


        $dataForStudentCertificate = [
            'student_id' => $request->student_id,
            'teacher_course_id'=> $request->teacher_course_id,
            'file_path' => $fileFullPath,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        StudentCertificate::insert($dataForStudentCertificate);

        $studentCourse = StudentCourse::where('teacher_course_id', $request->teacher_course_id)
            ->where('student_id', $request->student_id)->first();
        $studentCourse->status = CourseStudentStatus::$COMPLETED;
        $studentCourse->save();


        Session::flash('Success', 'Course Closed and Certificate attached for this student.');
        return redirect()->back();
    }
}
