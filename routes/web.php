<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return redirect()->route('login');});

require __DIR__.'/auth.php';


//Registration for an user
Route::post('/user/save', ['uses'=>'UserController@postUserInfo','as'=>'postUserInfo']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboardPage'])->name('dashboard');
    Route::get('/teachers',['uses'=>'TeacherController@getTeachersPage', 'as'=>'teacher_list']);
    Route::post('/profile-update',['uses'=>'AccountController@UserProfileUpdate', 'as'=>'user-profile-update']);
    Route::post('/user_image_upload',['uses'=>'AccountController@postUserImageUpload', 'as'=>'user_image_upload']);
    Route::post('/password-change',['uses'=>'ResetPasswordController@postPasswordChange','as'=>'password-change']);
    //    Routes for Account Settings
    Route::get('settings/account',['uses'=>'AccountController@getIndex', 'as'=>'account-settings']);

    //    Signature Image Section Start
    Route::post('/profile/signature/change',['uses'=>'AccountController@signatureImageChange', 'as'=>'signature_change']);
});