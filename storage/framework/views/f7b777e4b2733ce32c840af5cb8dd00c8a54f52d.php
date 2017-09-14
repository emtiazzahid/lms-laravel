<?php $__env->startSection('title','Exam Submissions List'); ?>

<!-- page content -->
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
                        <h2>Exam Submission List</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($examSubmissions)<1): ?>
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Submissions Found.
                            </div>
                        <?php else: ?>
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student </th>
                                <th>Answer File</th>
                                <th>Total Mark</th>
                                <th>Achieve Mark</th>
                                <th>Passed Score</th>
                                <th>Submitted at</th>
                                <th>Result Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $examSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examSubmission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e(++$index); ?></strong></td>
                                    <td><?php echo e($examSubmission->student->user->name); ?></td>
                                    <td>Answer - <?php echo e($examSubmission->answer_file_id); ?></td>
                                    <td><?php echo e($examSubmission->total_mark); ?></td>
                                    <td><?php echo e($examSubmission->achieve_mark); ?></td>
                                    <td><?php echo e($examSubmission->passed_score); ?></td>
                                    <td><?php echo e(\App\Libraries\TimeStampToAgoHelper::time_elapsed_string($examSubmission->created_at)); ?></td>
                                    <td>
                                        <?php if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$FAILED): ?>
                                            Failed
                                        <?php elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$PASSED): ?>
                                            Passed
                                        <?php elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$JUDGING): ?>
                                            Judging
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$JUDGING): ?>
                                        <a href="<?php echo e(route('judgeStudentExamSubmission',['exam_submission_id'=>$examSubmission->id])); ?>" class="btn btn-info btn-sm">Judge</a>
                                        <?php else: ?>
                                        <a href="<?php echo e(route('viewStudentExamSubmissionFile',['exam_submission_id'=>$examSubmission->id])); ?>" class="btn btn-info btn-sm">Show Submission</a>
                                        <?php endif; ?>
                                    </td>

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
<!-- /page content -->

<?php $__env->startSection('page_js'); ?>
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm"
                    },
                    {
                        extend: "csv",
                        className: "btn-sm"
                    },
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn-sm"
                    },
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
                responsive: true
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>