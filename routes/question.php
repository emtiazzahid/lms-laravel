<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['TeacherAuth']], function () {
    Route::get('/teacher/course/questions/{course_id?}/{lesson_id?}/{part_number?}', ['uses' => 'QuestionController@getQuestionsPage', 'as' => 'question-list']);
    Route::post('/teacher/course/lessons', ['uses' => 'QuestionController@getLessonsByCourseId', 'as' => 'getLessonsByCourseId']);
    Route::post('/teacher/course/lessons/get_parts_by_lesson', ['uses' => 'QuestionController@getPartsByLessonId', 'as' => 'getPartsByLesson']);

    Route::get('/teacher/course/question/make', ['uses' => 'QuestionController@getQuestionsMakerPage', 'as' => 'question-make']);
    Route::post('/teacher/course/question/make/view', ['uses' => 'QuestionController@postQuestionsMakerPage', 'as' => 'post-question-make']);
    Route::post('/teacher/course/lessons/parts', ['uses' => 'QuestionController@getPartsByLessonIds', 'as' => 'getPartsByLessonIds']);
    
    Route::post('/teacher/course/question/save', ['uses' => 'QuestionBankController@saveQuestionInQuestionBank', 'as' => 'saveQuestionInQuestionBank']);
    Route::get('/teacher/course/question_file/list/{course_id?}', ['uses' => 'QuestionBankController@getAllQuestionFileList', 'as' => 'getAllQuestionFiles']);
    Route::get('/teacher/course/question_file/{id?}/details', ['uses' => 'QuestionBankController@questionFileDetails', 'as' => 'questionFileDetails']);
});