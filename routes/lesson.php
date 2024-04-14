<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

Route::group(['middleware' => ['TeacherAuth']], function () {
    // Routes for Lessons
    Route::get('/teacher/courses/lessons/{id}/details', [LessonController::class, 'getLessonDetails'])->name('getLessonDetails');
    Route::get('/teacher/courses/lessons/{id}/details/edit', [LessonController::class, 'getLessonDetailsForEdit'])->name('getLessonDetailsForEdit');
    
    Route::post('/lesson/video/update', [LessonController::class, 'postLessonsVideoInfoUpdate'])->name('lesson-video-update');
    Route::get('/lesson/video/{id}/delete', [LessonController::class, 'lessonVideoDelete'])->name('lesson-video-delete');
    Route::post('/lesson/video/add', [LessonController::class, 'postLessonsVideoInfoSave'])->name('lesson-video-add');
    
    Route::post('/lesson/file/update', [LessonController::class, 'postLessonsFileInfoUpdate'])->name('lesson-file-update');
    Route::get('/lesson/file/{id}/delete', [LessonController::class, 'lessonFileDelete'])->name('lesson-file-delete');
    Route::post('/lesson/file/add', [LessonController::class, 'postLessonsFileInfoSave'])->name('lesson-file-add');

    Route::get('/teacher/courses/lessons/{id}/details/questions', [LessonController::class, 'getLessonQuestions'])->name('lesson-questions');
    Route::post('/teacher/courses/lessons/details/question/add', [LessonController::class, 'addNewQuestion'])->name('lesson-question-add');
    Route::post('/teacher/courses/lessons/details/questions/update', [LessonController::class, 'updateQuestion'])->name('lesson-question-update');
    Route::get('/teacher/courses/lessons/{id}/details/questions/delete', [LessonController::class, 'deleteQuestion'])->name('lesson-question-delete');
    
    Route::get('/teacher/courses/lessons/{id}/details/mcqs', [LessonController::class, 'getLessonMcqs'])->name('lesson-mcqs');
    Route::post('/teacher/courses/lessons/details/mcq/add', [LessonController::class, 'addNewMcq'])->name('lesson-mcq-add');
    Route::post('/teacher/courses/lessons/details/mcq/update', [LessonController::class, 'updateMcq'])->name('lesson-mcq-update');
    Route::get('/teacher/courses/lessons/{id}/details/mcq/delete', [LessonController::class, 'deleteMcq'])->name('lesson-mcq-delete');
});
