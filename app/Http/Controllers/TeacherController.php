<?php

namespace App\Http\Controllers;

use App\Libraries\Enumerations\UserTypes;
use Illuminate\Http\Request;
use App\Model\Teacher;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Session;


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

        DB::transaction(function ($request) use ($request) {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password =  bcrypt($request['password']);
            $user->user_type = UserTypes::$TEACHER;
            $user->save();

            $meta = new \App\Model\Teacher();
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
}
