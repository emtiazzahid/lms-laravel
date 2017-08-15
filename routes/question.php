<?php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['TeacherAuth']], function () {
        Route::get('/teacher/course/questions/{course_id?}/{lesson_id?}/{part_number?}', ['uses' => 'QuestionController@getQuestionsPage', 'as' => 'question-list']);
        Route::post('/teacher/course/lessons', ['uses' => 'QuestionController@getLessonsByCourseId', 'as' => 'getLessonsByCourseId']);
        Route::post('/teacher/course/lessons/parts', ['uses' => 'QuestionController@getPartsByLessonId', 'as' => 'getPartsByLessonId']);
    });

});