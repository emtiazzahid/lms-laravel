<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherCourseController;
use App\Http\Controllers\TeacherCourseLessonController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentController;

Route::group(['middleware' => ['AdminOrTeacher']], function () {
    // Routes for Course CRUD
    Route::get('/courses', [CourseController::class, 'getIndex'])->name('courses-list');
    Route::post('/courses/add', [CourseController::class, 'add'])->name('courses-add');
    Route::post('/courses/update', [CourseController::class, 'update'])->name('courses-update');
    Route::get('/courses/remove/{id}', [CourseController::class, 'delete'])->name('courses-delete');
});

Route::group(['middleware' => ['AdminAuth']], function () {
    // Routes for Course Listing Settings
    Route::get('/courses/listing', [CourseController::class, 'getCourseListingPage'])->name('courses-listing-settings');
    Route::post('/courses/trending/add', [CourseController::class, 'postTrendingCourse'])->name('trending-courses-add');
    Route::get('/courses/trending/remove/{id}', [CourseController::class, 'trendingCourseDelete'])->name('trending-courses-delete');
});

Route::group(['middleware' => ['TeacherAuth']], function () {
    // Routes for Teacher Course CRUD
    Route::get('/teacher/courses', [TeacherCourseController::class, 'getIndex'])->name('my-courses-list');
    Route::post('/teacher/courses/add', [TeacherCourseController::class, 'add'])->name('my-courses-add');
    Route::post('/teacher/courses/update', [TeacherCourseController::class, 'update'])->name('my-courses-update');
    Route::get('/teacher/courses/remove/{id}', [TeacherCourseController::class, 'delete'])->name('my-courses-delete');

    // Routes for Course Lessons CRUD
    Route::get('/teacher/course/lessons/{course_id?}', [TeacherCourseLessonController::class, 'getIndex'])->name('course-lessons-list');
    Route::post('/teacher/courses/lessons/add', [TeacherCourseLessonController::class, 'add'])->name('lesson-add');
    Route::post('/teacher/courses/lessons/update', [TeacherCourseLessonController::class, 'update'])->name('lesson-update');
    Route::get('/teacher/courses/lessons/remove/{course_id}/{id}', [TeacherCourseLessonController::class, 'delete'])->name('lesson-delete');
});

Route::group(['middleware' => ['StudentAuth']], function () {
    // Routes for Student Course
    Route::get('/student/course/list', [StudentCourseController::class, 'getAllCoursesForStudent'])->name('student-courses-list');
    Route::get('/student/courses/own/list', [StudentController::class, 'getLoggedStudentCourses'])->name('logged-student-courses-list');
    Route::get('/student/courses/own/details/{teacher_course_id}', [StudentCourseController::class, 'getCourseDetailsPage'])->name('student-course-details');
    Route::get('/student/courses/own/details/{teacher_course_id}/enroll', [StudentCourseController::class, 'attachStudentCourse'])->name('student-course-enroll');

    // Routes for Student Course Lessons
    Route::get('/student/courses/{teacher_course_id}/lessons', [StudentCourseController::class, 'getCourseLessonsForStudent'])->name('getCourseLessonsForStudent');
    Route::get('/student/courses/lessons/{id}', [StudentCourseController::class, 'getStudentCourseLessonDetails'])->name('getStudentCourseLessonDetails');

    // Routes for Student Course Exams
    Route::get('/student/courses/{teacher_course_id}/exams', [StudentCourseController::class, 'getCourseExamsForStudent'])->name('getCourseExamsForStudent');
    // Route::get('/student/courses/exam/{id}', [StudentCourseController::class, 'getStudentCourseExamDetails'])->name('getStudentCourseExamDetails');
});
