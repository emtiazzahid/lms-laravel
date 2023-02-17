<?php

use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['AdminOrTeacher']], function () {
        //    Routes for Course Crud
        Route::get('/courses', ['uses' => 'CourseController@getIndex', 'as' => 'courses-list']);
        Route::post('/courses/add', ['uses' => 'CourseController@add', 'as' => 'courses-add']);
        Route::post('/courses/update', ['uses' => 'CourseController@update', 'as' => 'courses-update']);
        Route::get('/courses/remove/{id}', ['uses' => 'CourseController@delete', 'as' => 'courses-delete']);
    });
    
    Route::group(['middleware' => ['AdminAuth']], function () {
        //    Routes for Course Listing Settings 
        Route::get('/courses/listing', ['uses' => 'CourseController@getCourseListingPage', 'as' => 'courses-listing-settings']);
        Route::post('/courses/trending/add', ['uses' => 'CourseController@postTrendingCourse', 'as' => 'trending-courses-add']);
        Route::get('/courses/trending/remove{id}', ['uses' => 'CourseController@trendingCourseDelete', 'as' => 'trending-courses-delete']);
    });
    
    Route::group(['middleware' => ['TeacherAuth']], function () {
        //    Routes for Teacher Course Crud
        Route::get('/teacher/courses', ['uses' => 'TeacherCourseController@getIndex', 'as' => 'my-courses-list']);
        Route::post('/teacher/courses/add', ['uses' => 'TeacherCourseController@add', 'as' => 'my-courses-add']);
        Route::post('/teacher/courses/update', ['uses' => 'TeacherCourseController@update', 'as' => 'my-courses-update']);
        Route::get('/teacher/courses/remove/{id}', ['uses' => 'TeacherCourseController@delete', 'as' => 'my-courses-delete']);
    
        //    Routes for Course Lessons Crud
        Route::get('/teacher/course/lessons/{course_id?}', ['uses' => 'TeacherCourseLessonController@getIndex', 'as' => 'course-lessons-list']);
        Route::post('/teacher/courses/lessons/add', ['uses' => 'TeacherCourseLessonController@add', 'as' => 'lesson-add']);
        Route::post('/teacher/courses/lessons/update', ['uses' => 'TeacherCourseLessonController@update', 'as' => 'lesson-update']);
        Route::get('/teacher/courses/lessons/remove/{course_id}/{id}', ['uses' => 'TeacherCourseLessonController@delete', 'as' => 'lesson-delete']);
    });

    Route::group(['middleware' => ['StudentAuth']], function () {
        //    Routes for Student Course
        Route::get('/student/course/list', ['uses' => 'StudentCourseController@getAllCoursesForStudent', 'as' => 'student-courses-list']);
        Route::get('/student/courses/own/list', ['uses' => 'StudentController@getLoggedStudentCourses', 'as' => 'logged-student-courses-list']);
        Route::get('/student/courses/own/details/{teacher_course_id}', ['uses' => 'StudentCourseController@getCourseDetailsPage', 'as' => 'student-course-details']);
        Route::get('/student/courses/own/details/{teacher_course_id}/enroll', ['uses' => 'StudentCourseController@attachStudentCourse', 'as' => 'student-course-enroll']);

        //    Routes for Student Course Lessons
        Route::get('/student/courses/{teacher_course_id}/lessons', ['uses' => 'StudentCourseController@getCourseLessonsForStudent', 'as' => 'getCourseLessonsForStudent']);
        Route::get('/student/courses/lessons/{id}', ['uses' => 'StudentCourseController@getStudentCourseLessonDetails', 'as' => 'getStudentCourseLessonDetails']);

        //    Routes for Student Course Exams
        Route::get('/student/courses/{teacher_course_id}/exams', ['uses' => 'StudentCourseController@getCourseExamsForStudent', 'as' => 'getCourseExamsForStudent']);
//        Route::get('/student/courses/exam/{id}', ['uses' => 'StudentCourseController@getStudentCourseExamDetails', 'as' => 'getStudentCourseExamDetails']);        

    });



//});
