<?php $__env->startSection('title', 'E-Learning | HOME'); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
<div class="right_col" role="main">
    <?php if(isset($errors)): ?>
        <?php if( count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(\Session::has('msg')): ?>

    <?php endif; ?>
    <div class="row top_tiles">

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="count"><?php echo e(isset($totalTeachers) ? $totalTeachers : 0); ?></div>
                <h3>Teachers</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="count"><?php echo e(isset($totalStudents) ? $totalStudents : 0); ?></div>
                <h3>Students</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count"><?php echo e(isset($totalCourses) ? $totalCourses : 0); ?></div>
                <h3>Courses</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">0</div>
                <h3>Certified Students</h3>
            </div>
        </div>

    </div>

</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>