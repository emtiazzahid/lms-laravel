<?php $__env->startSection('title', 'E-Learning'); ?>

<?php $__env->startSection('content'); ?>
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
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

                <div class="x_panel">
                    <div class="text-center" id="remaining_type"></div>
                    <div class="x_title">

                        <div class="row">
                            <h2>Written Exam</h2>
                            <h2 class="pull-right"><strong>Course:</strong> <?php echo e($exam->course->title); ?> | <strong>Teacher:</strong> <?php echo e($exam->teacher->user->name); ?></h2>
                        </div>
                       <div class="row pull-right">
                            <h2>Duration: <?php echo e($exam->duration); ?> | Passing Score: <?php echo e($exam->passing_score); ?> %</h2>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($writtenQuestions)<1): ?>
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong>Something Wrong! No Written Question Data Found.
                            </div>
                        <?php else: ?>
                            <form method="post" action="<?php echo e(route('postWrittenQuestionAnswers')); ?>" id="examFile">
                                <input type="hidden" name="exam_id" value="<?php echo e($exam->id); ?>">
                                <input type="hidden" name="question_type" value="<?php echo e($exam->question_file->question_type); ?>">
                                <input type="hidden" name="course_id" value="<?php echo e($exam->course_id); ?>">
                                <input type="hidden" name="teacher_id" value="<?php echo e($exam->teacher_id); ?>">
                                <input type="hidden" name="passing_score" value="<?php echo e($exam->passing_score); ?>">
                                <?php echo e(csrf_field()); ?>

                                <table class="table table-bordered">
                                    <thead>
                                        <th>Sl.</th>
                                        <th>Question and Answer</th>
                                        <th>Mark</th>
                                    </thead>
                                    <tbody>
                                        <?php  $sl = 0  ?>
                                        <?php $__currentLoopData = $writtenQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(++$sl); ?></td>
                                                <td>
                                                    <input type="hidden" name="id[]" value="<?php echo e($question->id); ?>">
                                                    <input type="hidden" name="lesson_id[]" value="<?php echo e($question->lesson_id); ?>">
                                                    <input type="hidden" name="part_number[]" value="<?php echo e($question->part_number); ?>">
                                                    <input type="hidden" name="question[]" value="<?php echo e($question->question); ?>">
                                                    <input type="hidden" name="description[]" value="<?php echo e($question->description); ?>">
                                                    <input type="hidden" name="default_mark[]" value="<?php echo e($question->default_mark); ?>">
                                                    Question : <?php echo e($question->question); ?><br>
                                                    Answer: <textarea class="form-control" name="answer[]"></textarea>
                                                </td>
                                                <td><?php echo e($question->default_mark); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <button class="btn btn-block btn-info btn-lg">Confirm and Submit Answers</button>
                            </form>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_js'); ?>
    <script src="<?php echo e(url('js/jquery.countdown.js')); ?>"></script>
    <script>
        var time = '00:00:05';
        var timeParts = time.split(":");
        var totalMilliseconds = (+timeParts[0] * (60000 * 60)) + (+timeParts[1] * 60000) + (+timeParts[2] * 1000);

        var fiveSeconds = new Date().getTime() +totalMilliseconds;
        $('#remaining_type').countdown(fiveSeconds, function(event) {
            var $this = $(this).html(event.strftime(''
                            + '<h3>%H hr '
                            + '%M min '
                            + '%S sec </h3>'))
                    .on('finish.countdown', function (event) {
                        $('#examFile').submit();
                    });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>