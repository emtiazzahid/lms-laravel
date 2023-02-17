<?php

use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['AdminOrTeacher']], function () {
        //    Routes for Department Crud
        Route::get('/departments', ['uses' => 'DepartmentController@getIndex', 'as' => 'departments-list']);
        Route::post('/departments/add', ['uses' => 'DepartmentController@add', 'as' => 'departments-add']);
        Route::post('/departments/update', ['uses' => 'DepartmentController@update', 'as' => 'departments-update']);
        Route::get('/departments/remove/{id}', ['uses' => 'DepartmentController@delete', 'as' => 'departments-delete']);
    });

//});
