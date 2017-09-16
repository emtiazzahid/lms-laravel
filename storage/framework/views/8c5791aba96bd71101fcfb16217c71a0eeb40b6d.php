<?php $__env->startSection('title', 'E-Learning | Course Details'); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>E-learning :: Course Details</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo Breadcrumbs::render('student-course-details',$teacherCourseId); ?>


                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course - <?php echo e($teacherCourse->course->title); ?> Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="product-image">
                                <img src="<?php echo e(url($teacherCourse->course->featured_image)); ?>" alt="..." />
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title"><?php echo e($teacherCourse->course->title); ?></h3>

                            <p> <?php echo e($teacherCourse->course->featured_text); ?> </p>
                            <br />

                            <div class="">
                                <h2>Available Lessons</h2>
                                <ul class="list-inline prod_size">
                                    <?php $__currentLoopData = $teacherCourseLessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs"><?php echo e($lesson->title); ?></button>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <br />

                            <div class="">
                                <div class="product_price">
                                    <h1 class="price">Teacher/Author : <?php echo e($teacherCourse->teacher->user->name); ?></h1>
                                    <span class="price-tax">user since <?php echo \App\Libraries\TimeStampToAgoHelper::time_elapsed_string($teacherCourse->teacher->user->created_at); ?></span>
                                    <br>
                                </div>
                            </div>

                            <div class="">
                                <?php if($courseTaken): ?>
                                <a href="<?php echo e(route('getCourseLessonsForStudent',['teacher_course_id'=>$teacherCourse->id])); ?>" class="btn btn-default btn-lg">Continue Study</a>
                                <a href="<?php echo e(route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id])); ?>" class="btn btn-default btn-lg">Exams</a>
                                <?php else: ?>
                                <a href="<?php echo e(route('student-course-enroll',['teacher_course_id'=>$teacherCourse->id])); ?>" class="btn btn-default btn-lg">Enroll Now</a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>