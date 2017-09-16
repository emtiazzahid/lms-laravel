<?php $__env->startSection('title', 'E-Learning | My Courses'); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <?php echo Breadcrumbs::render('student_own_courses'); ?>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Currently In Progress </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            <?php $__currentLoopData = $incompleteCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="<?php echo e(url($iCourse->teacher_course->course->featured_image)); ?>" alt="image" />
                                            <div class="mask">
                                                <p><?php echo e($iCourse->teacher_course->course->short_code); ?></p>
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('student-course-details',['teacher_course_id' => $iCourse->teacher_course->id])); ?>">
                                            <div class="caption">
                                                <p><?php echo e($iCourse->teacher_course->course->title); ?></p>
                                            </div></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo $incompleteCourses->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Completed Courses</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <?php $__currentLoopData = $completedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="<?php echo e(url($cCourse->teacher_course->course->featured_image)); ?>" alt="image" />
                                            <div class="mask">
                                                <p><?php echo e($cCourse->teacher_course->course->short_code); ?></p>
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('student-course-details',['teacher_course_id' => $cCourse->teacher_course->id])); ?>">
                                        <div class="caption">
                                            <p><?php echo e($cCourse->teacher_course->course->title); ?></p>
                                        </div></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo $completedCourses->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>