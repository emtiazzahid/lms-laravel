<?php $__env->startSection('title', 'Student Course Exam List'); ?>

        <!-- page content -->
<?php $__env->startSection('content'); ?>

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo Breadcrumbs::render('getCourseExamsForStudent',$teacher_course_id); ?>


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
                                            <?php if(count($exam->submissions)<1): ?>
                                                <a class="btn btn-info btn-sm" href="<?php echo e(route('student-exam-start', ['exam_id'=>$exam->id])); ?>" title="Start Exam">Start</a>
                                            <?php else: ?>
                                                <button  title="Show Result" type="button"
                                                        data-total_mark="<?php echo e($exam->submissions[0]->total_mark); ?>"
                                                        data-achieve_mark="<?php echo e($exam->submissions[0]->achieve_mark); ?>"
                                                        data-passing_score="<?php echo e($exam->passing_score); ?>"
                                                        data-passed_score="<?php echo e($exam->submissions[0]->passed_score); ?>"
                                                        data-result_status="<?php echo e($exam->submissions[0]->result_status); ?>"
                                                        data class="btn btn-info btn-sm" data-toggle="modal" data-target="#resultModal">
                                                     Show Result
                                                </button>
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


    <!--Result Modal -->
    <div class="modal fade" id="resultModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Result Info</h4>
                </div>
                    <div class="modal-body">
                        
                            <form action="">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Total Mark</label>
                                    </div>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" id="total_mark" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Achive Mark</label>
                                    </div>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" id="achieve_mark" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Passiong Score</label>
                                    </div>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" id="passing_score" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Passed Score</label>
                                    </div>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" id="passed_score" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Result Status</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="result_status">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        

                    </div>
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
        $('#resultModal').on('show.bs.modal', function (e) {
            $('#total_mark').val($(e.relatedTarget).data('total_mark'));
            $('#achieve_mark').val($(e.relatedTarget).data('achieve_mark'));
            $('#passing_score').val($(e.relatedTarget).data('passing_score'));
            $('#passed_score').val($(e.relatedTarget).data('passed_score'));
            var resultStatusId = $(e.relatedTarget).data('result_status');
            $('#result_status').empty();
            var resultElement;
            if (resultStatusId == <?php echo e(\App\Libraries\Enumerations\ResultStatus::$JUDGING); ?>){
                resultElement = '<h4><span class="label label-info">Judging</span></h4>';
            }else if (resultStatusId == <?php echo e(\App\Libraries\Enumerations\ResultStatus::$FAILED); ?>)
            {
                resultElement = '<h4><span class="label label-danger">Failed</span></h4>';
            }else if(resultStatusId == <?php echo e(\App\Libraries\Enumerations\ResultStatus::$PASSED); ?>){
                resultElement = '<h4><span class="label label-success">Passed</span></h4>';
            }
            $('#result_status').append(resultElement);
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