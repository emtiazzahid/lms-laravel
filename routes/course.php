<?php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['AdminOrTeacher']], function () {
        //    Routes for Course Crud
        Route::get('/courses', ['uses' => 'CourseController@getIndex', 'as' => 'courses-list']);
        Route::post('/courses/add', ['uses' => 'CourseController@add', 'as' => 'courses-add']);
        Route::post('/courses/update', ['uses' => 'CourseController@update', 'as' => 'courses-update']);
        Route::get('/courses/remove/{id}', ['uses' => 'CourseController@delete', 'as' => 'courses-delete']);
    });
    Route::group(['middleware' => ['TeacherAuth']], function () {
        //    Routes for Teacher Course Crud
        Route::get('/teacher/courses', ['uses' => 'TeacherCourseController@getIndex', 'as' => 'my-courses-list']);
        Route::post('/teacher/courses/add', ['uses' => 'TeacherCourseController@add', 'as' => 'my-courses-add']);
        Route::post('/teacher/courses/update', ['uses' => 'TeacherCourseController@update', 'as' => 'my-courses-update']);
        Route::get('/teacher/courses/remove/{id}', ['uses' => 'TeacherCourseController@delete', 'as' => 'my-courses-delete']);
    
        //    Routes for Course Lessons Crud
        Route::get('/teacher/courses/lessons/{course_id?}', ['uses' => 'TeacherCourseLessonController@getIndex', 'as' => 'course-lessons-list']);
        Route::post('/teacher/courses/lessons/add', ['uses' => 'TeacherCourseLessonController@add', 'as' => 'lesson-add']);
        Route::post('/teacher/courses/lessons/update', ['uses' => 'TeacherCourseLessonController@update', 'as' => 'lesson-update']);
        Route::get('/teacher/courses/lessons/remove/{course_id}/{id}', ['uses' => 'TeacherCourseLessonController@delete', 'as' => 'lesson-delete']);
    });
    
    Route::group(['middleware' => ['StudentAuth']], function () {
        //    Routes for Student Course
        Route::get('student/courses', ['uses' => 'StudentCourseController@getAllCourse', 'as' => 'student-courses-list']);
        });

});
