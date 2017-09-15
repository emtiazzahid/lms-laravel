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

                    <div class="x_title">
                        <div class="row">
                            <h2>Written Exam</h2>
                            <h2 class="pull-right"><strong>Course:</strong> <?php echo e($examSubmission->exam->course->title); ?> | <strong>Teacher:</strong> <?php echo e($examSubmission->exam->teacher->user->name); ?>

                                | <strong>Student:</strong> <?php echo e($examSubmission->student->user->name); ?> </h2>
                        </div>
                       <div class="row pull-right">
                            <h2>Duration: <?php echo e($examSubmission->exam->duration); ?> | Passing Score: <?php echo e($examSubmission->exam->passing_score); ?> %</h2>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($answerFile->question)<1): ?>
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong>Something Wrong! No Written Question Data Found.
                            </div>
                        <?php else: ?>
                            <form method="post" action="<?php echo e(route('postWrittenQuestionAnswersWithJudgement')); ?>">
                                <input type="hidden" name="exam_id" value="<?php echo e($examSubmission->exam->id); ?>">
                                <input type="hidden" name="question_type" value="<?php echo e($examSubmission->exam->question_file->question_type); ?>">
                                <input type="hidden" name="course_id" value="<?php echo e($examSubmission->exam->course_id); ?>">
                                <input type="hidden" name="teacher_id" value="<?php echo e($examSubmission->exam->teacher_id); ?>">
                                <input type="hidden" name="passing_score" value="<?php echo e($examSubmission->exam->passing_score); ?>">
                                <input type="hidden" name="answer_file_id" value="<?php echo e($examSubmission->answer_file_id); ?>">
                                <input type="hidden" name="exam_submission_id" value="<?php echo e($examSubmission->id); ?>">
                                <?php echo e(csrf_field()); ?>

                                <table class="table table-bordered">
                                    <thead>
                                        <th>Sl.</th>
                                        <th>Question and Answer</th>
                                        <th>Mark</th>
                                        <th>Given Mark</th>
                                    </thead>
                                    <tbody>
                                        <?php  $sl = 0  ?>
                                        <?php $__currentLoopData = $answerFile->question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(++$sl); ?></td>
                                                <td>
                                                    <input type="hidden" name="id[]" value="<?php echo e($answerFile->id[$key]); ?>">
                                                    <input type="hidden" name="lesson_id[]" value="<?php echo e($answerFile->lesson_id[$key]); ?>">
                                                    <input type="hidden" name="part_number[]" value="<?php echo e($answerFile->part_number[$key]); ?>">
                                                    <input type="hidden" name="question[]" value="<?php echo e($answerFile->question[$key]); ?>">
                                                    <input type="hidden" name="description[]" value="<?php echo e($answerFile->description[$key]); ?>">
                                                    <input type="hidden" name="default_mark[]" value="<?php echo e($answerFile->default_mark[$key]); ?>">

                                                    <strong>Question:</strong> <?php echo e($answerFile->question[$key]); ?><br>
                                                    <strong>Answer:</strong> <textarea readonly class="form-control" name="answer[]"><?php echo e($answerFile->answer[$key]); ?></textarea>
                                                </td>
                                                <td><?php echo e($answerFile->default_mark[$key]); ?></td>
                                                <td><input type="number" max="<?php echo e($answerFile->default_mark[$key]); ?>" min="0" name="given_mark[]" class="form-control"></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <button class="btn btn-block btn-info btn-lg">Confirm and Submit Answers Judgement</button>
                            </form>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>