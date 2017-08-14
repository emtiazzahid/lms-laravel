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
// Dashboard > Courses > Lessons > Lesson Number > Edit
Breadcrumbs::register('lesson_details_edit', function($breadcrumbs, $lessonNumber,$lessonId)
{
    $breadcrumbs->parent('lesson_details',$lessonNumber);
    $breadcrumbs->push('Edit', route('getLessonDetailsForEdit',$lessonId));
});
// Dashboard > Courses > Lessons > Lesson Number > Questions
Breadcrumbs::register('lesson_questions', function($breadcrumbs, $lessonNumber,$lessonId)
{
    $breadcrumbs->parent('lesson_details',$lessonNumber);
    $breadcrumbs->push('Questions', route('getLessonDetailsForEdit',$lessonId));
});
// Dashboard > Courses > Lessons > Lesson Number > Mcq 
Breadcrumbs::register('lesson_mcqs', function($breadcrumbs, $lessonNumber,$lessonId)
{
    $breadcrumbs->parent('lesson_details',$lessonNumber);
    $breadcrumbs->push('Mcq', route('getLessonDetailsForEdit',$lessonId));
});


