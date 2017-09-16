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
// Dashboard > Courses > My (Teacher)
Breadcrumbs::register('teacher_own_courses', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('My', route('my-courses-list'));
});
// Dashboard > Courses > Lessons
Breadcrumbs::register('lessons', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('Lessons', route('course-lessons-list'));
});
// Dashboard > Courses > Listing Settings
Breadcrumbs::register('listing_settings', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('Listing Settings', route('courses-listing-settings'));
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


// Dashboard > Teachers
Breadcrumbs::register('teachers', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Teachers', route('teachers-list'));
});
// Dashboard > Teachers > Courses
Breadcrumbs::register('teacher_courses', function($breadcrumbs , $teacherId)
{
    $breadcrumbs->parent('teachers');
    $breadcrumbs->push('Courses', route('teachers-courses',$teacherId));
});

// Dashboard > Students
Breadcrumbs::register('students', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Students', route('students-list'));
});
// Dashboard > Students > Courses
Breadcrumbs::register('student_courses', function($breadcrumbs , $studentId)
{
    $breadcrumbs->parent('students');
    $breadcrumbs->push('Courses', route('student-courses',$studentId));
});

// Dashboard > Departments
Breadcrumbs::register('departments', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Departments', route('departments-list'));
});

// Dashboard > Account
Breadcrumbs::register('account_settings', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Account', route('account-settings'));
});

// Dashboard > Questions List
Breadcrumbs::register('question_list', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Questions List', route('question-list'));
});
// Dashboard > Question Files 
Breadcrumbs::register('question_files', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Questions Files', route('getAllQuestionFiles'));
});
// Dashboard > Question Files > Create New
Breadcrumbs::register('question_files_create', function($breadcrumbs)
{
    $breadcrumbs->parent('question_files');
    $breadcrumbs->push('Create New', route('question-make'));
});

// Dashboard > Exams
Breadcrumbs::register('getExamListPage', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Exams', route('getExamListPage'));
});

// Dashboard > Exams > Create
Breadcrumbs::register('getExamCreatePage', function($breadcrumbs)
{
    $breadcrumbs->parent('getExamListPage');
    $breadcrumbs->push('Create', route('getExamCreatePage'));
});

// Dashboard > Exams > Student Attempts
Breadcrumbs::register('getStudentExamSubmissionsByCourse', function($breadcrumbs)
{
    $breadcrumbs->parent('getExamListPage');
    $breadcrumbs->push('Student Attempts', route('getStudentExamSubmissionsByCourse'));
});
// Dashboard > Exams > Student Attempts > Submissions
Breadcrumbs::register('getStudentSubmissionsPageByExam', function($breadcrumbs,$examId)
{
    $breadcrumbs->parent('getStudentExamSubmissionsByCourse');
    $breadcrumbs->push('Submissions', route('getStudentSubmissionsPageByExam',$examId));
});
// Dashboard > Exams > Student Attempts > Submissions > Details
Breadcrumbs::register('viewStudentExamSubmissionFile', function($breadcrumbs,$examId , $examSubmissionId)
{
    $breadcrumbs->parent('getStudentSubmissionsPageByExam',$examId);
    $breadcrumbs->push('Details', route('viewStudentExamSubmissionFile',$examSubmissionId));
});
// Dashboard > Exams > Student Attempts > Submissions > Judge
Breadcrumbs::register('judgeStudentExamSubmission', function($breadcrumbs,$examId , $examSubmissionId)
{
    $breadcrumbs->parent('getStudentSubmissionsPageByExam',$examId);
    $breadcrumbs->push('Judge', route('judgeStudentExamSubmission',$examSubmissionId));
});

// Dashboard > Courses (for students)
Breadcrumbs::register('coursesForStudents', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Courses', route('student-courses-list'));
});
// Dashboard > Courses > My (Teacher)
Breadcrumbs::register('student_own_courses', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('My', route('logged-student-courses-list'));
});









