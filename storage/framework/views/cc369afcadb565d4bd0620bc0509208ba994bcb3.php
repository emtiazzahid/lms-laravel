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
                    <li class="<?php echo e(Route::currentRouteName()=='dashboard' ? 'active' : ''); ?>"><a href="<?php echo e(Route('dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <?php if($user_type == $admin): ?>
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Teacher <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="<?php echo e(Route::currentRouteName()=='teachers-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('teachers-list')); ?>"><i class="fa fa-building-o"></i> Teachers </a></li>
                      </ul>
                 </li>
                    <?php endif; ?>
                    <?php if($user_type == $admin): ?>
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Student <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="<?php echo e(Route::currentRouteName()=='students-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('students-list')); ?>"><i class="fa fa-building-o"></i> Students </a></li>
                      </ul>
                 </li>
                    <?php endif; ?>
                    <?php if($user_type == $admin || $user_type == $teacher): ?>
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Department <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="<?php echo e(Route::currentRouteName()=='departments-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('departments-list')); ?>"><i class="fa fa-building-o"></i> Departments </a></li>
                      </ul>
                 </li>
                    <?php endif; ?>
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Course <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <?php if($user_type == $admin): ?>
                      <li class="<?php echo e(Route::currentRouteName()=='courses-listing-settings' ? 'active' : ''); ?>"><a href="<?php echo e(route('courses-listing-settings')); ?>"><i class="fa fa-building-o"></i> Courses List Setting </a></li>
                      <?php endif; ?>
                      <?php if($user_type == $teacher || $user_type == $admin): ?>
                      <li class="<?php echo e(Route::currentRouteName()=='courses-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('courses-list')); ?>"><i class="fa fa-building-o"></i> Courses </a></li>
                      <?php endif; ?>
                      <?php if($user_type == $teacher): ?>
                      <li class="<?php echo e(Route::currentRouteName()=='my-courses-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('my-courses-list')); ?>"><i class="fa fa-building-o"></i> My Courses </a></li>
                      <?php endif; ?>
                     <?php if($user_type == $student): ?>
                      <li class="<?php echo e(Route::currentRouteName()=='student-courses-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('student-courses-list')); ?>"><i class="fa fa-building-o"></i> Courses </a></li>
                      <li class="<?php echo e(Route::currentRouteName()=='logged-student-courses-list' ? 'active' : ''); ?>"><a href="<?php echo e(route('logged-student-courses-list')); ?>"><i class="fa fa-building-o"></i> My Courses </a></li>
                     <?php endif; ?>
                      </ul>
                 </li>
                    <?php if($user_type == $teacher): ?>
                <li>
                    <a><i class="fa fa-hospital-o"></i> Course Lessons <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="<?php echo e(Route::currentRouteName()=='course-lessons-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('course-lessons-list')); ?>"><i class="fa fa-building-o"></i> Lessons List </a></li>
                    </ul>
                </li>
                    <?php endif; ?>
                    <?php if($user_type == $teacher): ?>
                <li>
                    <a><i class="fa fa-hospital-o"></i> Questions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="<?php echo e(Route::currentRouteName()=='question-list' ? 'active' : ''); ?>"><a href="<?php echo e(Route('question-list')); ?>"><i class="fa fa-building-o"></i> Questions List </a></li>
                        <li class="<?php echo e(Route::currentRouteName()=='question-make' ? 'active' : ''); ?>"><a href="<?php echo e(Route('question-make')); ?>"><i class="fa fa-building-o"></i> Make Question File </a></li>
                        <li class="<?php echo e(Route::currentRouteName()=='getAllQuestionFiles' ? 'active' : ''); ?>"><a href="<?php echo e(Route('getAllQuestionFiles')); ?>"><i class="fa fa-building-o"></i> Question File List</a></li>
                    </ul>
                </li>
                    <?php endif; ?>
                    <?php if($user_type == $teacher || $user_type == $student): ?>
                <li>
                    <a><i class="fa fa-hospital-o"></i> Exam <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <?php if($user_type == $teacher): ?>
                        <li class="<?php echo e(Route::currentRouteName()=='getExamListPage' ? 'active' : ''); ?>"><a href="<?php echo e(route('getExamListPage')); ?>"><i class="fa fa-building-o"></i> Exam List </a></li>
                        <li class="<?php echo e(Route::currentRouteName()=='getExamCreatePage' ? 'active' : ''); ?>"><a href="<?php echo e(route('getExamCreatePage')); ?>"><i class="fa fa-building-o"></i> Exam Create </a></li>
                        <li class="<?php echo e(Route::currentRouteName()=='getStudentExamSubmissionsByCourse' ? 'active' : ''); ?>"><a href="<?php echo e(route('getStudentExamSubmissionsByCourse')); ?>"><i class="fa fa-building-o"></i> Student Exams </a></li>
                        <?php endif; ?>
                        <?php if($user_type == $student): ?>
                        <li class=""><a href="#"><i class="fa fa-building-o"></i> Result Records </a></li>
                        <li class=""><a href="#"><i class="fa fa-building-o"></i> Incomplete Exams </a></li>
                        <li class=""><a href="#"><i class="fa fa-building-o"></i> Exam Records </a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                    <?php endif; ?>

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

<?php echo $__env->make('admin.layouts.top_nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>