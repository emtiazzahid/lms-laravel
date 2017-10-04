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
                <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                <div class="count"><?php echo e(isset($totalTeachers) ? $totalTeachers : 0); ?></div>
                <h3>Teachers</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                <div class="count"><?php echo e(isset($totalStudents) ? $totalStudents : 0); ?></div>
                <h3>Students</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                <div class="count"><?php echo e(isset($totalCourses) ? $totalCourses : 0); ?></div>
                <h3>Courses</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                <div class="count"><?php echo e(isset($totalCertified) ? $totalCertified : 0); ?></div>
                <h3>Certified Students</h3>
            </div>
        </div>

    </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3><?php echo e(date('F Y')); ?> Teacher/Student Activities</h3>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div id="chart_plot_01" class="demo-placeholder"></div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                        <div class="x_title">
                            <h2>Top 4 Teacher Rank</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-6">
                            <?php $__currentLoopData = $topTeachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <p><?php echo e($teacher->name); ?></p>
                                <div class="">
                                    <div class="progress progress_sm" style="width: 100%;">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo e($teacher->point); ?>"></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <br />
</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_js'); ?>
    <script>

        var arr_data1 = [
            <?php echo e($studentGraphData); ?>

        ];

        var arr_data2 = [
            <?php echo e($teacherGraphData); ?>

        ];

        var chart_plot_01_settings = {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
            },
            colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
            xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
                //tickLength: 10,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
            },
            yaxis: {
                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
            },
            tooltip: false
        }
        if ($("#chart_plot_01").length){
            console.log('Plot1');

            $.plot( $("#chart_plot_01"), [ arr_data1, arr_data2 ],  chart_plot_01_settings );
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>