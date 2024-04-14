<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::group(['middleware' => ['AdminAuth']], function () {
    // Routes for Teacher CRUD
    Route::get('/teachers', [TeacherController::class, 'getIndex'])->name('teachers-list');
    Route::post('/teachers/add', [TeacherController::class, 'add'])->name('teachers-add');
    Route::post('/teachers/update', [TeacherController::class, 'update'])->name('teachers-update');
    Route::get('/teachers/remove/{id}', [TeacherController::class, 'delete'])->name('teachers-delete');

    Route::get('/teacher/courses/{id}', [TeacherController::class, 'getTeacherCourseListPage'])->name('teachers-courses');
});

Route::group(['middleware' => 'StudentAuth'], function() {
    Route::post('/teachers/rating/update', [TeacherController::class, 'updateTeacherRating'])->name('updateTeacherRating');
});

Route::group(['middleware' => 'TeacherAuth'], function() {
    Route::get('/teachers/students', [TeacherController::class, 'getTeacherStudentsListPage'])->name('getTeacherStudentsListPage');
    Route::post('/teachers/students/certify', [TeacherController::class, 'certifyStudent'])->name('certifyStudent');
});
