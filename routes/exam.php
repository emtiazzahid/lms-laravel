<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamSubmissionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['TeacherOrStudent']], function () {
    // Routes for Exams
    Route::get('/exam/list', [ExamController::class, 'getExamListPage'])->name('getExamListPage');
    Route::get('/exam/create', [ExamController::class, 'getExamCreatePage'])->name('getExamCreatePage');
    Route::post('/exam/create/question_files', [ExamController::class, 'getQuestionFilesByCourse'])->name('getQuestionFilesByCourse');
    Route::post('/exam/create/save', [ExamController::class, 'saveExam'])->name('saveExam');
    Route::post('/exam/update', [ExamController::class, 'update'])->name('exam-update');
    Route::get('/exam/remove/{id}', [ExamController::class, 'delete'])->name('exam-delete');
});

Route::group(['middleware' => ['StudentAuth']], function () {
    Route::get('student/exam/{exam_id}/start', [ExamController::class, 'getStudentExamStartPage'])->name('student-exam-start');
    Route::post('student/exam/start/written/submit', [ExamController::class, 'postWrittenQuestionAnswers'])->name('postWrittenQuestionAnswers');
    Route::post('student/exam/start/mcq/submit', [ExamController::class, 'postMcqQuestionAnswers'])->name('postMcqQuestionAnswers');
});

Route::group(['middleware' => ['TeacherAuth']], function () {
    Route::get('student/course/exam/submissions/{course_id?}', [ExamSubmissionController::class, 'getStudentExamSubmissionsByCourse'])->name('getStudentExamSubmissionsByCourse');
    Route::get('student/course/exam/submissions/details/{exam_id?}', [ExamSubmissionController::class, 'getStudentSubmissionsPageByExam'])->name('getStudentSubmissionsPageByExam');
    Route::get('student/course/exam/submissions/details/judge/{exam_submission_id}', [ExamSubmissionController::class, 'judgeStudentExamSubmission'])->name('judgeStudentExamSubmission');
    Route::get('student/course/exam/submissions/details/view/{exam_submission_id}', [ExamSubmissionController::class, 'viewStudentExamSubmissionFile'])->name('viewStudentExamSubmissionFile');
    Route::post('student/exam/written/judge/submit', [ExamController::class, 'postWrittenQuestionAnswersWithJudgement'])->name('postWrittenQuestionAnswersWithJudgement');
    Route::get('student/exams_with_submissions', [TeacherController::class, 'getExamsWithSubmissions'])->name('getExamsWithSubmissions');
});
