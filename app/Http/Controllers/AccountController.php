<?php

namespace App\Http\Controllers;


use App\Model\Admin;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Libraries\Enumerations\UserTypes;
use DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    public function getIndex()
    {
        $user_credentials = Auth::user();

        if (Auth::user()->user_type == UserTypes::$STUDENT){
            $user_detail = Student::where('user_id',Auth::user()->id)->first();
        }
        if (Auth::user()->user_type == UserTypes::$TEACHER){
            $user_detail = Teacher::where('user_id',Auth::user()->id)->first();
        }
        if (Auth::user()->user_type == UserTypes::$ADMIN){
            $user_detail = Admin::where('user_id',Auth::user()->id)->first();
        }

        $data = [
            'user_credentials' => $user_credentials,
            'user_detail' => $user_detail,
        ];
        return view('admin.account_settings', $data);
    }
    
    public function postUserImageUpload(Request $request)
    {
        if (!Input::hasFile('file'))
        {
            return json_encode(['error' => true, 'message' =>'There is no picture found!' ]);
        }
        $user_id = $request->adminId;
        $user = User::findOrFail($user_id);
        if ($user->user_type == UserTypes::$ADMIN) {$category = 'admin';}
        elseif ($user->user_type == UserTypes::$TEACHER) {$category = 'teacher';}
        elseif ($user->user_type == UserTypes::$STUDENT) {$category = 'student';}

        $file = Input::file('file');

        $cropedImage = $request->cropedImageContent;
        $pos = strpos($cropedImage, ',');
        $rest = substr($cropedImage, $pos);
        $data = base64_decode($rest);
        $cropedImage = imagecreatefromstring($data);

        $name = $file->getClientOriginalName();
        $temp = explode('.', $name);
        $extention = array_pop($temp);
        $fileName = 'profile_picture_user_'.$user_id.".".$extention;

        $destinationPath = '/admin/images/profile_pics/'.$category.'/';
        $fileSavingPath1 = public_path().$destinationPath.$fileName;

        file_put_contents($fileSavingPath1 , $data);
        DB::table('users')->where('id', $user_id)->update(['picture' => $destinationPath.$fileName]);
        return json_encode(['success' => true, 'message' =>'Your profile picture successfully changed!' ]);
    }

    public function UserProfileUpdate(Request $request)
    {
        if(Input::file())
        {

            $file = Input::file('new_profile_picture');
            $extention  = $file->getClientOriginalExtension();

            $user_id = Auth::user()->id;
            $user = User::findOrFail($user_id);

            if ($user->user_type == UserTypes::$ADMIN) {$category = 'admin';}
            elseif ($user->user_type == UserTypes::$TEACHER) {$category = 'teacher';}
            elseif ($user->user_type == UserTypes::$STUDENT) {$category = 'student';}

            $fileName = 'profile_picture_user_'.$user_id.".".$extention;

            $destinationPath = '/admin/images/profile_pics/'.$category.'/';
            $path = $destinationPath. $fileName;
            $savingPath = public_path().$destinationPath. $fileName;


            Image::make($file->getRealPath())->resize(200, 200)->save($savingPath);
            DB::table('users')->where('id', $user_id)->update(['picture' => $path]);
        }

        $user_id = Auth::user()->id;
        $user_category = Auth::user()->user_type;
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required'
        ]);
        if (Auth::user()->email != $request->email){
            $emailExists = DB::table('users')->where('id', '<>', $user_id)->where('email', $request->email)->first();
            if ($emailExists==true) {
                Session::flash('Error', 'Email Address Already Exist');
                return redirect()->back();
            }else
                DB::table('users')->where('id', $user_id)->update(['email' => $request->email]);
        }
        
        DB::table('users')->where('id', $user_id)->update(['name' => $request->name]);
        $updateData = [
            'country_code' => $request->countryCode,
            'iso' => $request->iso2,
            'phone' => $request->phone_number
        ];
        if ($user_category == UserTypes::$ADMIN){
            DB::table('admins')->where('user_id', $user_id)->update($updateData);
        }elseif ($user_category == UserTypes::$TEACHER){
            DB::table('teachers')->where('user_id', $user_id)->update($updateData);
        }elseif ($user_category == UserTypes::$STUDENT){
            DB::table('students')->where('user_id', $user_id)->update($updateData);
        }
        Session::flash('Success', 'Account info updated successfully.');
        return redirect()->back();
    }
}
