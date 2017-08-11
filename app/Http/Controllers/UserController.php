<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Libraries\Enumerations\UserTypes;

class UserController extends Controller
{
    public function getLoginPage()
    {
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        $remember = (Input::has('remember')) ? true : false;
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $allInput = $request->all();
        $validator = Validator::make($allInput, $rules);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']],$remember)) {
            
            return redirect()->route('dashboard');
        } else {
            $validator->errors()->add('error', 'Wrong Email or Password Given!');
                return redirect()->route('login')
                    ->withErrors($validator);        
            }
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function postUserInfo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);


        $teacher = new User();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = bcrypt($request->password);
        $teacher->user_type = UserTypes::$TEACHER;
        $teacher->save();

        $meta = new \App\Model\Teacher();
        $meta->user_id = $teacher->id;
        $meta->save();

        Auth::login($teacher);
        Session::flash('Success Message', 'Account Registered Successfully.');
        return redirect()->route('dashboard');
    }
}
