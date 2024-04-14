<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionBankController;

Route::group(['middleware' => ['TeacherAuth']], function () {
    Route::get('/teacher/course/questions/{course_id?}/{lesson_id?}/{part_number?}', [QuestionController::class, 'getQuestionsPage'])->name('question-list');
    Route::post('/teacher/course/lessons', [QuestionController::class, 'getLessonsByCourseId'])->name('getLessonsByCourseId');
    Route::post('/teacher/course/lessons/get_parts_by_lesson', [QuestionController::class, 'getPartsByLessonId'])->name('getPartsByLesson');

    Route::get('/teacher/course/question/make', [QuestionController::class, 'getQuestionsMakerPage'])->name('question-make');
    Route::post('/teacher/course/question/make/view', [QuestionController::class, 'postQuestionsMakerPage'])->name('post-question-make');
    Route::post('/teacher/course/lessons/parts', [QuestionController::class, 'getPartsByLessonIds'])->name('getPartsByLessonIds');
    
    Route::post('/teacher/course/question/save', [QuestionBankController::class, 'saveQuestionInQuestionBank'])->name('saveQuestionInQuestionBank');
    Route::get('/teacher/course/question_file/list/{course_id?}', [QuestionBankController::class, 'getAllQuestionFileList'])->name('getAllQuestionFiles');
    Route::get('/teacher/course/question_file/{id?}/details', [QuestionBankController::class, 'questionFileDetails'])->name('questionFileDetails');
});
