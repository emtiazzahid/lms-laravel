<?php

Route::group(['middleware' => ['auth']], function () {

        //    Routes for Exams
        Route::get('/exam/list', ['uses' => 'ExamController@getExamListPage', 'as' => 'getExamListPage']);
        Route::get('/exam/create', ['uses' => 'ExamController@getExamCreatePage', 'as' => 'getExamCreatePage']);
        Route::post('/exam/create/question_files', ['uses' => 'ExamController@getQuestionFilesByCourse', 'as' => 'getQuestionFilesByCourse']);
        
        Route::post('/exam/create/save', ['uses' => 'ExamController@saveExam', 'as' => 'saveExam']);
        Route::post('/exam/update', ['uses' => 'ExamController@update', 'as' => 'exam-update']);
        Route::get('/exam/remove/{id}', ['uses' => 'ExamController@delete', 'as' => 'exam-delete']);

});