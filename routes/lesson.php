<?php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['TeacherAuth']], function () {
        //    Routes for Lessons
        Route::get('/teacher/courses/lessons/{id}/details', ['uses' => 'LessonController@getLessonDetails', 'as' => 'getLessonDetails']);
        Route::get('/teacher/courses/lessons/{id}/details/edit', ['uses' => 'LessonController@getLessonDetailsForEdit', 'as' => 'getLessonDetailsForEdit']);
        
        Route::post('/lesson/video/update', ['uses' => 'LessonController@postLessonsVideoInfoUpdate', 'as' => 'lesson-video-update']);
        Route::get('/lesson/video/{id}/delete', ['uses' => 'LessonController@lessonVideoDelete', 'as' => 'lesson-video-delete']);
        Route::post('/lesson/video/add', ['uses' => 'LessonController@postLessonsVideoInfoSave', 'as' => 'lesson-video-add']);
        
        Route::post('/lesson/file/update', ['uses' => 'LessonController@postLessonsFileInfoUpdate', 'as' => 'lesson-file-update']);
        Route::get('/lesson/file/{id}/delete', ['uses' => 'LessonController@lessonFileDelete', 'as' => 'lesson-file-delete']);
        Route::post('/lesson/file/add', ['uses' => 'LessonController@postLessonsFileInfoSave', 'as' => 'lesson-file-add']);
    
        
    });

});
