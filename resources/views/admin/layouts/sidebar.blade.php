<?php
$user_type =  \Illuminate\Support\Facades\Auth::user()->user_type;
$teacher = \App\Libraries\Enumerations\UserTypes::$TEACHER;
$student = \App\Libraries\Enumerations\UserTypes::$STUDENT;
$admin = \App\Libraries\Enumerations\UserTypes::$ADMIN;

?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General Menu</h3>
                <ul class="nav side-menu">
                    <li class="{{Route::currentRouteName()=='dashboard' ? 'active' : ''}}"><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    @if($user_type == $admin)
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Teacher <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="{{Route::currentRouteName()=='teachers-list' ? 'active' : ''}}"><a href="{{Route('teachers-list')}}"><i class="fa fa-building-o"></i> Teachers </a></li>
                      </ul>
                 </li>
                    @endif
                    @if($user_type == $admin || $user_type == $teacher)
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Student <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @if($user_type == $admin)
                      <li class="{{Route::currentRouteName()=='students-list' ? 'active' : ''}}"><a href="{{Route('students-list')}}"><i class="fa fa-building-o"></i> Students </a></li>
                        @endif
                        @if($user_type == $teacher)
                      <li class="{{Route::currentRouteName()=='getTeacherStudentsListPage' ? 'active' : ''}}"><a href="{{Route('getTeacherStudentsListPage')}}"><i class="fa fa-building-o"></i> My Students </a></li>
                        @endif

                      </ul>
                 </li>
                    @endif
                    @if($user_type == $admin || $user_type == $teacher)
                 <li>
                      <a><i class="fa fa-building-o" aria-hidden="true"></i> Department <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="{{Route::currentRouteName()=='departments-list' ? 'active' : ''}}"><a href="{{Route('departments-list')}}"><i class="fa fa-list-alt" aria-hidden="true"></i> Departments </a></li>
                      </ul>
                 </li>
                    @endif
                 <li>
                      <a><i class="fa fa-columns"></i> Course <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      @if($user_type == $teacher || $user_type == $admin)
                      <li class="{{Route::currentRouteName()=='courses-list' ? 'active' : ''}}"><a href="{{Route('courses-list')}}"><i class="fa fa-list-alt"></i> Courses </a></li>
                      @endif
                      @if($user_type == $admin)
                          <li class="{{Route::currentRouteName()=='courses-listing-settings' ? 'active' : ''}}"><a href="{{ route('courses-listing-settings') }}"><i class="fa fa-building-o"></i> Courses List Setting </a></li>
                      @endif
                      @if($user_type == $teacher)
                      <li class="{{Route::currentRouteName()=='my-courses-list' ? 'active' : ''}}"><a href="{{Route('my-courses-list')}}"><i class="fa fa-list-alt"></i> My Courses </a></li>
                      @endif
                     @if($user_type == $student)
                      <li class="{{Route::currentRouteName()=='student-courses-list' ? 'active' : ''}}"><a href="{{Route('student-courses-list')}}"><i class="fa fa-list-alt"></i> Courses </a></li>
                      <li class="{{Route::currentRouteName()=='logged-student-courses-list' ? 'active' : ''}}"><a href="{{ route('logged-student-courses-list') }}"><i class="fa fa-list-alt"></i> My Courses </a></li>
                     @endif
                      </ul>
                 </li>
                    @if($user_type == $teacher)
                <li>
                    <a><i class="fa fa-file-text-o"></i> Course Lessons <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="{{Route::currentRouteName()=='course-lessons-list' ? 'active' : ''}}"><a href="{{Route('course-lessons-list')}}"><i class="fa fa-list-alt"></i> Lessons List </a></li>
                    </ul>
                </li>
                    @endif
                    @if($user_type == $teacher)
                <li>
                    <a><i class="fa fa-question"></i> Questions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="{{Route::currentRouteName()=='question-list' ? 'active' : ''}}"><a href="{{Route('question-list')}}"><i class="fa fa-question"></i> Questions List </a></li>
                        <li class="{{Route::currentRouteName()=='question-make' ? 'active' : ''}}"><a href="{{Route('question-make')}}"><i class="fa fa-plus"></i> Make Question File </a></li>
                        <li class="{{Route::currentRouteName()=='getAllQuestionFiles' ? 'active' : ''}}"><a href="{{Route('getAllQuestionFiles')}}"><i class="fa fa-list-alt"></i> Question File List</a></li>
                    </ul>
                </li>
                    @endif
                    @if($user_type == $teacher)
                <li>
                    <a><i class="fa fa-sticky-note"></i> Exam <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if($user_type == $teacher)
                        <li class="{{Route::currentRouteName()=='getExamListPage' ? 'active' : ''}}"><a href="{{ route('getExamListPage') }}"><i class="fa fa-building-o"></i> Exam List </a></li>
                        <li class="{{Route::currentRouteName()=='getExamCreatePage' ? 'active' : ''}}"><a href="{{ route('getExamCreatePage') }}"><i class="fa fa-building-o"></i> Exam Create </a></li>
                        <li class="{{Route::currentRouteName()=='getStudentExamSubmissionsByCourse' ? 'active' : ''}}"><a href="{{ route('getStudentExamSubmissionsByCourse') }}"><i class="fa fa-building-o"></i> Student Exams </a></li>
                        @endif
                    </ul>
                </li>
                    @endif

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

@include('admin.layouts.top_nav')