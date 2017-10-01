<?php $__env->startSection('title', 'Students List'); ?>

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
                        <h2>Students List</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(!$students || count($students)<1): ?>
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Data Found.
                            </div>
                        <?php else: ?>
                            <?php $index = 0; ?>
                            <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Results</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e(++$index); ?></strong></td>
                                        <td><?php echo e($student['student_id']); ?></td>
                                        <td><?php echo e($student['student']['user']['name']); ?></td>
                                        <td><?php echo e($student['teacher_course']['course']['title']); ?></td>
                                        <td>
                                        <?php if($student['status'] == \App\Libraries\Enumerations\CourseStudentStatus::$COMPLETED): ?>
                                            Completed
                                        <?php else: ?>
                                            Incomplete
                                        <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                    data-course_id="<?php echo e($student['teacher_course']['course_id']); ?>"
                                                    data-teacher_id="<?php echo e($student['teacher_course']['teacher_id']); ?>"
                                                    data-student_id="<?php echo e($student['student']['user_id']); ?>"
                                                    data class="btn btn-info btn-sm" data-toggle="modal" data-target="#resultModal">
                                                <i class="fa fa-circle-o" aria-hidden="true"></i> View Results
                                            </button>
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
    <!--Data Modal -->
    <div class="modal fade" id="resultModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Results</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <table class="table" id="resultsTable">

                            </table>
                        </div>
                        
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
    <script>
        $('#resultModal').on('hidden.bs.modal', function(e)
        {
            $(this).removeData();
            $('#resultsTable').empty();
        }) ;
        $('#resultModal').on('show.bs.modal', function (e) {
            $(".loader").fadeIn();
            $('#resultsTable').empty();
            var course_id = $(e.relatedTarget).data('course_id');
            var teacher_id = $(e.relatedTarget).data('teacher_id');
            var student_id = $(e.relatedTarget).data('student_id');
            var token = '<?php echo e(csrf_token()); ?>';
            var url = '<?php echo e(route('getExamsWithSubmissions')); ?>';
            $.ajax({
                url: url,
                type: 'GET',
                data: {_token : token , course_id:course_id,teacher_id:teacher_id,student_id:student_id},
                success: function(data){
                    if (data != 'false'){

                        $.each(data, function(key, index){
                            var exam_title = index.exam_title;
                            var result_status = '<span class="label label-default">Not Attended Yet</span>';
                            if(index['submissions'][0]) {
                                result_status = index['submissions'][0].result_status;
                            }
                            if (result_status == <?php echo e(\App\Libraries\Enumerations\ResultStatus::$FAILED); ?>){result_status = '<span class="label label-danger">Failed</span>';}
                            else if (result_status == <?php echo e(\App\Libraries\Enumerations\ResultStatus::$JUDGING); ?>){result_status = '<span class="label label-info">Judgement Pending</span>';}
                            else if (result_status == <?php echo e(\App\Libraries\Enumerations\ResultStatus::$PASSED); ?>){result_status = '<span class="label label-success">Passed</span>';}
                            var resultRow = '<tr><td>' +
                                    exam_title +
                                    '</td><td>' +
                                    result_status +
                                    '</td></tr>';
                            $('#resultsTable').append(resultRow);
                        });
                        $(".loader").fadeOut();
                    }else
                    {
                        $(".loader").fadeOut();
                        alert('sorry! something wrong happened. please try again later')
                    }
                }
            });
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