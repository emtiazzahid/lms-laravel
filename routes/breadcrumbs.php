<?php

// Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});
// Dashboard > Courses
Breadcrumbs::register('courses', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Courses', route('courses-list'));
});
// Dashboard > Courses > Lessons
Breadcrumbs::register('lessons', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('Lessons', route('course-lessons-list'));
});
// Dashboard > Courses > Lessons > Lesson Name
Breadcrumbs::register('lesson_details', function($breadcrumbs, $lessonId)
{
    $breadcrumbs->parent('lessons');
    $breadcrumbs->push('Lesson - '.$lessonId, route('getLessonDetails',$lessonId));
});

