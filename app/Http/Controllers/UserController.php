<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;

class UserController extends Controller
{
      public function getLoginPage()
    {
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $allInput = $request->all();
        $validator = Validator::make($allInput, $rules);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            
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
}
