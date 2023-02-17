<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Libraries\Enumerations\UserTypes;

class UserController extends Controller
{
    public function getLoginPage(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        $data['urlPath'] = $request->urlPath;
        return view('login', $data);
    }
    
    public function postLogin(Request $request)
    {
        $remember = ($request->has('remember')) ? true : false;
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $allInput = $request->all();
        $validator = Validator::make($allInput, $rules);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']],$remember)) {
            $currentDateData =  UserActivity::whereRaw('Date(created_at) = CURDATE()')->first();
            if (Auth::user()->user_type == UserTypes::$STUDENT)
            {
                if (!$currentDateData) {
                    $userActivity = new UserActivity();
                    $userActivity->total_student_login = 1;
                    $userActivity->save();
                }
                else {
                    $currentDateData->total_student_login = (int) $currentDateData->total_student_login +1;
                    $currentDateData->save();
                }

            }elseif (Auth::user()->user_type == UserTypes::$TEACHER)
            {
                if (!$currentDateData) {
                    $userActivity = new UserActivity();
                    $userActivity->total_teacher_login = 1;
                    $userActivity->save();
                }
                else {
                    $currentDateData->total_teacher_login = (int) $currentDateData->total_teacher_login +1;
                    $currentDateData->save();
                }
            }
            $asset = asset('/');
//            dd($request->urlPath);
            if ($request->urlPath) {
                return redirect($asset.$request->urlPath);
            } else {
                return redirect()->route('dashboard');
            }
            
           
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

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->save();

        if ($request->user_type == UserTypes::$TEACHER) {
            $meta = new \App\Models\Teacher();
            $meta->user_id = $user->id;
            $meta->save();
        }elseif ($request->user_type == UserTypes::$STUDENT){
            $meta = new \App\Models\Student();
            $meta->user_id = $user->id;
            $meta->save();
        }

        Auth::login($user);
        Session::flash('Success Message', 'Account Registered Successfully.');
        return redirect()->route('dashboard');
    }
}
