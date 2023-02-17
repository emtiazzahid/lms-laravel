<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['TeacherOrStudent']], function () {
//    Routes for Exams
Route::get('/exam/list', ['uses' => 'ExamController@getExamListPage', 'as' => 'getExamListPage']);
Route::get('/exam/create', ['uses' => 'ExamController@getExamCreatePage', 'as' => 'getExamCreatePage']);
Route::post('/exam/create/question_files', ['uses' => 'ExamController@getQuestionFilesByCourse', 'as' => 'getQuestionFilesByCourse']);

Route::post('/exam/create/save', ['uses' => 'ExamController@saveExam', 'as' => 'saveExam']);
Route::post('/exam/update', ['uses' => 'ExamController@update', 'as' => 'exam-update']);
Route::get('/exam/remove/{id}', ['uses' => 'ExamController@delete', 'as' => 'exam-delete']);
});

Route::group(['middleware' => ['StudentAuth']], function () {
        Route::get('student/exam/{exam_id}/start', ['uses' => 'ExamController@getStudentExamStartPage', 'as' => 'student-exam-start']);
        Route::post('student/exam/start/written/submit', ['uses' => 'ExamController@postWrittenQuestionAnswers', 'as' => 'postWrittenQuestionAnswers']);
        Route::post('student/exam/start/mcq/submit', ['uses' => 'ExamController@postMcqQuestionAnswers', 'as' => 'postMcqQuestionAnswers']);
});

Route::group(['middleware' => ['TeacherAuth']], function () {
        Route::get('student/course/exam/submissions/{course_id?}', ['uses' => 'ExamSubmissionController@getStudentExamSubmissionsByCourse', 'as' => 'getStudentExamSubmissionsByCourse']);
        Route::get('student/course/exam/submissions/details/{exam_id?}', ['uses' => 'ExamSubmissionController@getStudentSubmissionsPageByExam', 'as' => 'getStudentSubmissionsPageByExam']);
        Route::get('student/course/exam/submissions/details/judge/{exam_submission_id}', ['uses' => 'ExamSubmissionController@judgeStudentExamSubmission', 'as' => 'judgeStudentExamSubmission']);
        Route::get('student/course/exam/submissions/details/view/{exam_submission_id}', ['uses' => 'ExamSubmissionController@viewStudentExamSubmissionFile', 'as' => 'viewStudentExamSubmissionFile']);
        Route::post('student/exam/written/judge/submit', ['uses' => 'ExamController@postWrittenQuestionAnswersWithJudgement', 'as' => 'postWrittenQuestionAnswersWithJudgement']);

        Route::get('student/exams_with_submissions', ['uses' => 'TeacherController@getExamsWithSubmissions', 'as' => 'getExamsWithSubmissions']);
});
        

