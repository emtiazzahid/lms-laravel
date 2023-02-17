<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login/Logout
Route::get('/', function () {return redirect()->route('login');});
Route::get('/login', ['uses'=>'UserController@getLoginPage','as'=>'login']);
Route::get('/logout', ['uses'=>'UserController@userLogout','as'=>'logout']);
Route::post('/postLogin',['uses'=>'UserController@postLogin','as'=>'postLogin']);

//Registration for an user
Route::post('/user/save', ['uses'=>'UserController@postUserInfo','as'=>'postUserInfo']);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard',['uses'=>'DashboardController@getDashboardPage', 'as'=>'dashboard']);
    Route::get('/teachers',['uses'=>'TeacherController@getTeachersPage', 'as'=>'teacher_list']);
    Route::post('/profile-update',['uses'=>'AccountController@UserProfileUpdate', 'as'=>'user-profile-update']);
    Route::post('/user_image_upload',['uses'=>'AccountController@postUserImageUpload', 'as'=>'user_image_upload']);
    Route::post('/password-change',['uses'=>'ResetPasswordController@postPasswordChange','as'=>'password-change']);
    //    Routes for Account Settings
    Route::get('settings/account',['uses'=>'AccountController@getIndex', 'as'=>'account-settings']);

    //    Signature Image Section Start
    Route::post('/profile/signature/change',['uses'=>'AccountController@signatureImageChange', 'as'=>'signature_change']);
});

