<?php $__env->startSection('title', 'E-Learning | Courses'); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search Course!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    <?php if(count($studentCourses)>0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Currently In Progress <small> Here's what you're currently working through. Get back to work! </small></h2>
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
                            <?php $__currentLoopData = $studentCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="<?php echo e(url($sCourse->teacher_course->course->featured_image)); ?>" alt="image" />
                                            <div class="mask">
                                                <p><?php echo e($sCourse->teacher_course->course->short_code); ?></p>
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('student-course-details',['teacher_course_id' => $sCourse->teacher_course->id])); ?>">
                                        <div class="caption">
                                            <?php echo e($sCourse->teacher_course->course->title); ?>

                                        </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo $studentCourses->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div class="clearfix"></div>

    <?php if(count($trendingCourses)>0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Trending Courses <small> Here's what your peers are binging. </small></h2>
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
                            <?php $__currentLoopData = $trendingCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="<?php echo e(url($tCourse->teacher_course->course->featured_image)); ?>" alt="image" />
                                            <div class="mask">
                                                <p><?php echo e($tCourse->teacher_course->course->short_code); ?></p>
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('student-course-details',['teacher_course_id' => $tCourse->teacher_course->id])); ?>">
                                        <div class="caption">
                                           <p><?php echo e($tCourse->teacher_course->course->title); ?> ( <?php echo e($tCourse->teacher_course->teacher->user->name); ?> )</p>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo $trendingCourses->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div class="clearfix"></div>
    <?php if(count($AllCourses)>0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Courses <small> Here all the courses from our teachers. </small></h2>
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
                            <?php $__currentLoopData = $AllCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-55">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="<?php echo e(url($aCourse->course->featured_image)); ?>" alt="image" />
                                        <div class="mask">
                                            <p><?php echo e($aCourse->course->short_code); ?></p>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(route('student-course-details',['teacher_course_id' => $aCourse->id])); ?>">
                                    <div class="caption">
                                        <p><?php echo e($aCourse->course->title); ?> ( by <?php echo e($aCourse->teacher->user->name); ?> )</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo $AllCourses->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    </div>
</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>