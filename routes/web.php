<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

// Registration for a user
Route::post('/user/save', [UserController::class, 'postUserInfo'])->name('postUserInfo');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboardPage'])->name('dashboard');
    Route::get('/teachers', [TeacherController::class, 'getTeachersPage'])->name('teacher_list');
    Route::post('/profile-update', [AccountController::class, 'UserProfileUpdate'])->name('user-profile-update');
    Route::post('/user_image_upload', [AccountController::class, 'postUserImageUpload'])->name('user_image_upload');
    Route::post('/password-change', [ResetPasswordController::class, 'postPasswordChange'])->name('password-change');
    // Routes for Account Settings
    Route::get('settings/account', [AccountController::class, 'getIndex'])->name('account-settings');
    // Signature Image Section Start
    Route::post('/profile/signature/change', [AccountController::class, 'signatureImageChange'])->name('signature_change');
});