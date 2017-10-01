<?php $__env->startSection('title', 'Exam List'); ?>

        <!-- page content -->
<?php $__env->startSection('content'); ?>

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo Breadcrumbs::render('getExamListPage'); ?>



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
                        <h2>Exam List</h2>
                        <a href="<?php echo e(route('getExamCreatePage')); ?>" class="pull-right btn btn-info btn-sm">
                            <i class="fa fa-plus"></i> Create new exam
                        </a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($exams)<1): ?>
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Exam Data Found.
                            </div>
                        <?php else: ?>
                            <?php $index = 0; ?>
                            <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Course</th>
                                    <th>Question File</th>
                                    <th>Pass Score</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e(++$index); ?></strong></td>
                                        <td><?php echo e($exam->exam_title); ?></td>
                                        <td><?php echo e($exam->course->title); ?></td>
                                        <td><?php echo e($exam->question_file->question_title); ?></td>
                                        <td><?php echo e($exam->passing_score); ?> %</td>
                                        <td><?php echo e($exam->duration); ?></td>
                                        <td>
                                            <?php if($exam->status == \App\Libraries\Enumerations\ExamStatus::$RUNNING): ?>
                                                Running
                                            <?php elseif($exam->status == \App\Libraries\Enumerations\ExamStatus::$PENDING): ?>
                                                Pending
                                            <?php else: ?>
                                                Done
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                    data-id="<?php echo e($exam->id); ?>"
                                                    data-status="<?php echo e($exam->status); ?>"
                                                    data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>

                                            <a href="<?php echo e(route('exam-delete', ['id'=>$exam->id])); ?>" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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
    <!--Update Modal -->
    <div class="modal fade" id="updateModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Info</h4>
                </div>
                <form action="<?php echo e(route('exam-update')); ?>" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <table class="table">
                                <input type="hidden" name="modal_id" id="modal_id">
                                <tr>
                                    <td colspan="2"><label>Status</label></td>
                                    <td colspan="2">
                                        <select class="form-control" name="status" id="modal_status">
                                            <option value="<?php echo e(\App\Libraries\Enumerations\ExamStatus::$PENDING); ?>">Pending</option>
                                            <option value="<?php echo e(\App\Libraries\Enumerations\ExamStatus::$RUNNING); ?>">Running</option>
                                            <option value="<?php echo e(\App\Libraries\Enumerations\ExamStatus::$DONE); ?>">Done</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <button type="submit" class="btn btn-default pull-right">Update</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>
    
<?php $__env->stopSection(); ?>
            <!-- /page content -->

<?php $__env->startSection('page_js'); ?>
    <script>
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_status').val($(e.relatedTarget).data('status'));
        });
    </script>
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