<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function postPasswordChange(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Hash::check($request->password_old,$user->password)) {
            DB::table('users')->where('id', $user_id)->update(['password'=>bcrypt($request->password)]);
            Session::flash('Success Message', 'Password Successfully Changed. Login to Continue');
            return redirect()->back();
        }
        Session::flash('Error Message', 'Old Password is Incorrect! Please Try Again');
        return redirect()->back();
    }
}
