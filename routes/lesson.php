<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/teacher/courses/lessons/{id}/details/questions', ['uses' => 'LessonController@getLessonQuestions', 'as' => 'lesson-questions']);
    Route::post('/teacher/courses/lessons/details/question/add', ['uses' => 'LessonController@addNewQuestion', 'as' => 'lesson-question-add']);
    Route::post('/teacher/courses/lessons/details/questions/update', ['uses' => 'LessonController@updateQuestion', 'as' => 'lesson-question-update']);
    Route::get('/teacher/courses/lessons/{id}/details/questions/delete', ['uses' => 'LessonController@deleteQuestion', 'as' => 'lesson-question-delete']);
    
    Route::get('/teacher/courses/lessons/{id}/details/mcqs', ['uses' => 'LessonController@getLessonMcqs', 'as' => 'lesson-mcqs']);
    Route::post('/teacher/courses/lessons/details/mcq/add', ['uses' => 'LessonController@addNewMcq', 'as' => 'lesson-mcq-add']);
    Route::post('/teacher/courses/lessons/details/mcq/update', ['uses' => 'LessonController@updateMcq', 'as' => 'lesson-mcq-update']);
    Route::get('/teacher/courses/lessons/{id}/details/mcq/delete', ['uses' => 'LessonController@deleteMcq', 'as' => 'lesson-mcq-delete']);
});
