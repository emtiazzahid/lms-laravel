<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::group(['middleware' => ['AdminAuth']], function () {
    // Routes for Student CRUD
    Route::get('/students', [StudentController::class, 'getIndex'])->name('students-list');
    Route::post('/students/add', [StudentController::class, 'add'])->name('students-add');
    Route::post('/students/update', [StudentController::class, 'update'])->name('students-update');
    Route::get('/students/remove/{id}', [StudentController::class, 'delete'])->name('students-delete');

    Route::get('/student/courses/{id}', [StudentController::class, 'getStudentCourseListPage'])->name('student-courses');
});
