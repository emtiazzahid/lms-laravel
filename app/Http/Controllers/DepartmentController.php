<?php

namespace App\Http\Controllers;


use App\Libraries\Enumerations\DepartmentStatus;
use App\Libraries\Enumerations\UserTypes;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    //    List of Department
    public function getIndex(){
        
        $department = DB::table('departments')->get();
        return view('admin.departments.department_list',['departments'=>$department]);
    }

    // Add new Department
    public function add(Request $request)
    {
        $this->validate($request,[
            'title'      => 'required|min:3|max:100|unique:departments',
            'short_code'     => 'unique:departments',
        ]);

        $model = new Department();
        $model->title = $request['title'];
        $model->short_code = $request['short_code'];
        if (Auth::user()->user_type == UserTypes::$TEACHER){
            $model->status = DepartmentStatus::$PENDING;
        }else
            $model->status = DepartmentStatus::$APPROVED;
        $model->save();

        Session::flash('Success Message', 'Department has been created successfully.');

        return redirect()->route('departments-list');
    }


//    post Add or Edit Department
    public function update(Request $request){
        $this->validate($request,[
            'title'      => 'required|min:3|max:100|unique:departments,title,'.$request->modal_id,
            'short_code'     => 'unique:departments,short_code,'.$request->modal_id,
        ]);

        $model = Department::find($request->modal_id);
        $model->title = $request['title'];
        $model->short_code = $request['short_code'];
        $model->status = $request['status'];
        $model->save();
        Session::flash('Success Message', 'Department has been updated successfully.');
        return redirect()->route('departments-list');

    }

//    Delete Department
    public function delete($id){
        $model = Department::find($id);
        $model->delete();

        Session::flash('Success Message', 'Department deleted successfully.');
        return redirect()->route('departments-list');
    }
}
