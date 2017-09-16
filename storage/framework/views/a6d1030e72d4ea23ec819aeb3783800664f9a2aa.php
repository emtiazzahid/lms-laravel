<?php $__env->startSection('title', 'E-Learning'); ?>
<?php $__env->startSection('content'); ?>
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo Breadcrumbs::render('viewStudentExamSubmissionFile',$examSubmission->exam->id, $examSubmissionId); ?>


                <div class="x_panel">

                    <div class="x_title">
                        <div class="row">
                            <h2>Written Exam</h2>
                            <h2 class="pull-right"><strong>Course:</strong> <?php echo e($examSubmission->exam->course->title); ?> | <strong>Teacher:</strong> <?php echo e($examSubmission->exam->teacher->user->name); ?>

                                | <strong>Student:</strong> <?php echo e($examSubmission->student->user->name); ?> </h2>
                        </div>
                       <div class="row pull-right">
                            <h2><strong>Duration: </strong><?php echo e($examSubmission->exam->duration); ?> | <strong>Passing Score: </strong><?php echo e($examSubmission->exam->passing_score); ?> % |</h2>
                           <h2>
                               <strong>Total Mark :</strong><?php echo e($examSubmission->total_mark); ?> |
                               <strong>Achieve Mark :</strong><?php echo e($examSubmission->achieve_mark); ?> |
                               <strong>Result Status :</strong><?php if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$PASSED): ?>
                                   <span class="label label-success" style="color:white">Passed</span>
                               <?php elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$FAILED): ?>
                                   <span class="label label-danger" style="color:white">Failed</span>
                               <?php endif; ?>
                           </h2>
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
                                                    <strong>Question:</strong> <?php echo e($answerFile->question[$key]); ?><br>
                                                    <strong>Answer:</strong> <p><?php echo e(isset($answerFile->answer[$key]) ? $answerFile->answer[$key] : 'Answer not found'); ?></p>
                                                </td>
                                                <td><?php echo e($answerFile->default_mark[$key]); ?></td>
                                                <td><input type="number" max="<?php echo e($answerFile->default_mark[$key]); ?>" min="0" name="given_mark[]" class="form-control" readonly value="<?php echo e($answerFile->given_mark[$key]); ?>"></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>