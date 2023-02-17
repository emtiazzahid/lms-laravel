<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['AdminAuth']], function () {
    //    Routes for Student Crud
    Route::get('/students', ['uses' => 'StudentController@getIndex', 'as' => 'students-list']);
    Route::post('/students/add', ['uses' => 'StudentController@add', 'as' => 'students-add']);
    Route::post('/students/update', ['uses' => 'StudentController@update', 'as' => 'students-update']);
    Route::get('/students/remove/{id}', ['uses' => 'StudentController@delete', 'as' => 'students-delete']);

    
    Route::get('/student/courses/{id}', ['uses' => 'StudentController@getStudentCourseListPage', 'as' => 'student-courses']);

});
