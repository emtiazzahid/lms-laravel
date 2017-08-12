<?php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['AdminOrTeacher']], function () {
        //    Routes for Course Crud
        Route::get('/courses', ['uses' => 'CourseController@getIndex', 'as' => 'courses-list']);
        Route::post('/courses/add', ['uses' => 'CourseController@add', 'as' => 'courses-add']);
        Route::post('/courses/update', ['uses' => 'CourseController@update', 'as' => 'courses-update']);
        Route::get('/courses/remove/{id}', ['uses' => 'CourseController@delete', 'as' => 'courses-delete']);
    });

});
