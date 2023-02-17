<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['AdminAuth']], function () {
    //    Routes for Teacher Crud
    Route::get('/teachers', ['uses' => 'TeacherController@getIndex', 'as' => 'teachers-list']);
    Route::post('/teachers/add', ['uses' => 'TeacherController@add', 'as' => 'teachers-add']);
    Route::post('/teachers/update', ['uses' => 'TeacherController@update', 'as' => 'teachers-update']);
    Route::get('/teachers/remove/{id}', ['uses' => 'TeacherController@delete', 'as' => 'teachers-delete']);


    Route::get('/teacher/courses/{id}', ['uses' => 'TeacherController@getTeacherCourseListPage', 'as' => 'teachers-courses']);
});

Route::group(['middleware' => 'StudentAuth'], function() {
    Route::post('/teachers/rating/update', ['uses' => 'TeacherController@updateTeacherRating', 'as' => 'updateTeacherRating']);
});

Route::group(['middleware' => 'TeacherAuth'], function() {
    Route::get('/teachers/students', ['uses' => 'TeacherController@getTeacherStudentsListPage', 'as' => 'getTeacherStudentsListPage']);
    Route::post('/teachers/students/certify', ['uses' => 'TeacherController@certifyStudent', 'as' => 'certifyStudent']);
});
