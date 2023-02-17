<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});


// Dashboard > Courses
Breadcrumbs::for('courses', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Courses', route('courses-list'));
});
// Dashboard > Courses > My (Teacher)
Breadcrumbs::for('teacher_own_courses', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('My', route('my-courses-list'));
});
// Dashboard > Courses > Lessons
Breadcrumbs::for('lessons', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('Lessons', route('course-lessons-list'));
});
// Dashboard > Courses > Listing Settings
Breadcrumbs::for('listing_settings', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('Listing Settings', route('courses-listing-settings'));
});
// Dashboard > Courses > Lessons > Lesson Name
Breadcrumbs::for('lesson_details', function($breadcrumbs, $lessonId)
{
    $breadcrumbs->parent('lessons');
    $breadcrumbs->push('Lesson - '.$lessonId, route('getLessonDetails',$lessonId));
});
// Dashboard > Courses > Lessons > Lesson Number > Edit
Breadcrumbs::for('lesson_details_edit', function($breadcrumbs, $lessonNumber,$lessonId)
{
    $breadcrumbs->parent('lesson_details',$lessonNumber);
    $breadcrumbs->push('Edit', route('getLessonDetailsForEdit',$lessonId));
});
// Dashboard > Courses > Lessons > Lesson Number > Questions
Breadcrumbs::for('lesson_questions', function($breadcrumbs, $lessonNumber,$lessonId)
{
    $breadcrumbs->parent('lesson_details',$lessonNumber);
    $breadcrumbs->push('Questions', route('getLessonDetailsForEdit',$lessonId));
});
// Dashboard > Courses > Lessons > Lesson Number > Mcq
Breadcrumbs::for('lesson_mcqs', function($breadcrumbs, $lessonNumber,$lessonId)
{
    $breadcrumbs->parent('lesson_details',$lessonNumber);
    $breadcrumbs->push('Mcq', route('getLessonDetailsForEdit',$lessonId));
});


// Dashboard > Teachers
Breadcrumbs::for('teachers', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Teachers', route('teachers-list'));
});
// Dashboard > Teachers > Courses
Breadcrumbs::for('teacher_courses', function($breadcrumbs , $teacherId)
{
    $breadcrumbs->parent('teachers');
    $breadcrumbs->push('Courses', route('teachers-courses',$teacherId));
});

// Dashboard > Students
Breadcrumbs::for('students', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Students', route('students-list'));
});
// Dashboard > Students > Courses
Breadcrumbs::for('student_courses', function($breadcrumbs , $studentId)
{
    $breadcrumbs->parent('students');
    $breadcrumbs->push('Courses', route('student-courses',$studentId));
});

// Dashboard > Departments
Breadcrumbs::for('departments', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Departments', route('departments-list'));
});

// Dashboard > Account
Breadcrumbs::for('account_settings', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Account', route('account-settings'));
});

// Dashboard > Questions List
Breadcrumbs::for('question_list', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Questions List', route('question-list'));
});
// Dashboard > Question Files 
Breadcrumbs::for('question_files', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Questions Files', route('getAllQuestionFiles'));
});
// Dashboard > Question Files > Create New
Breadcrumbs::for('question_files_create', function($breadcrumbs)
{
    $breadcrumbs->parent('question_files');
    $breadcrumbs->push('Create New', route('question-make'));
});

// Dashboard > Exams
Breadcrumbs::for('getExamListPage', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Exams', route('getExamListPage'));
});

// Dashboard > Exams > Create
Breadcrumbs::for('getExamCreatePage', function($breadcrumbs)
{
    $breadcrumbs->parent('getExamListPage');
    $breadcrumbs->push('Create', route('getExamCreatePage'));
});

// Dashboard > Exams > Student Attempts
Breadcrumbs::for('getStudentExamSubmissionsByCourse', function($breadcrumbs)
{
    $breadcrumbs->parent('getExamListPage');
    $breadcrumbs->push('Student Attempts', route('getStudentExamSubmissionsByCourse'));
});
// Dashboard > Exams > Student Attempts > Submissions
Breadcrumbs::for('getStudentSubmissionsPageByExam', function($breadcrumbs,$examId)
{
    $breadcrumbs->parent('getStudentExamSubmissionsByCourse');
    $breadcrumbs->push('Submissions', route('getStudentSubmissionsPageByExam',$examId));
});
// Dashboard > Exams > Student Attempts > Submissions > Details
Breadcrumbs::for('viewStudentExamSubmissionFile', function($breadcrumbs,$examId , $examSubmissionId)
{
    $breadcrumbs->parent('getStudentSubmissionsPageByExam',$examId);
    $breadcrumbs->push('Details', route('viewStudentExamSubmissionFile',$examSubmissionId));
});
// Dashboard > Exams > Student Attempts > Submissions > Judge
Breadcrumbs::for('judgeStudentExamSubmission', function($breadcrumbs,$examId , $examSubmissionId)
{
    $breadcrumbs->parent('getStudentSubmissionsPageByExam',$examId);
    $breadcrumbs->push('Judge', route('judgeStudentExamSubmission',$examSubmissionId));
});

// Dashboard > Courses (for students)
Breadcrumbs::for('coursesForStudents', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Courses', route('student-courses-list'));
});
// Dashboard > Courses > Details
Breadcrumbs::for('student-course-details', function($breadcrumbs , $teacherCourseId)
{
    $breadcrumbs->parent('coursesForStudents');
    $breadcrumbs->push('Details', route('student-course-details', $teacherCourseId));
});
// Dashboard > Courses > Details > Lessons
Breadcrumbs::for('getCourseLessonsForStudent', function($breadcrumbs , $teacher_course_id)
{
    $breadcrumbs->parent('student-course-details',$teacher_course_id);
    $breadcrumbs->push('Lessons', route('getCourseLessonsForStudent', $teacher_course_id));
});
// Dashboard > Courses > Details > Lessons > Details
Breadcrumbs::for('getStudentCourseLessonDetails', function($breadcrumbs , $teacher_course_id , $lessonId)
{
    $breadcrumbs->parent('getCourseLessonsForStudent',$teacher_course_id);
    $breadcrumbs->push('Details', route('getStudentCourseLessonDetails', $teacher_course_id));
});

// Dashboard > Courses > Exams
Breadcrumbs::for('getCourseExamsForStudent', function($breadcrumbs , $teacherCourseId)
{
    $breadcrumbs->parent('coursesForStudents');
    $breadcrumbs->push('Exams', route('getCourseExamsForStudent', $teacherCourseId));
});

// Dashboard > Courses > My (Student)
Breadcrumbs::for('student_own_courses', function($breadcrumbs)
{
    $breadcrumbs->parent('courses');
    $breadcrumbs->push('My', route('logged-student-courses-list'));
});









