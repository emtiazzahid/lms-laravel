<?php $__env->startSection('title', 'Question List'); ?>
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
                            <h2>Filter Your Questions</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <form class="form-inline" method="get" action="<?php echo e(route('question-list')); ?>">
                                <div class="form-group">
                                    <label>Course :</label>
                                    <select name="course" id="course_id" class="form-control">
                                        <option value="">--Select One--</option>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lesson :</label>
                                    <select name="lesson" id="lesson_id" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Part :</label>
                                    <select name="part" id="part" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-default">Show</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <?php if(isset($writtenQuestions)): ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Written Question List</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <?php if(count($writtenQuestions)<1): ?>
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Written Question Found.
                                </div>
                            <?php else: ?>
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lesson</th>
                                        <th>Part Number</th>
                                        <th>Question</th>
                                        <th>Mark</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $writtenQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writtenQuestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><strong><?php echo e(++$index); ?></strong></td>
                                            <td><?php echo e($writtenQuestion->lesson_id); ?></td>
                                            <td><?php echo e($writtenQuestion->part_number); ?></td>
                                            <td><?php echo e($writtenQuestion->question); ?></td>
                                            <td><?php echo e($writtenQuestion->default_mark); ?></td>
                                            <td><?php echo e($writtenQuestion->created_at); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>

                    </div>
                    <?php endif; ?>
                    <?php if(isset($mcqQuestions)): ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Mcq Question List</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <?php if(count($mcqQuestions)<1): ?>
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Mcq Question Found.
                                </div>
                            <?php else: ?>
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lesson</th>
                                        <th>Part</th>
                                        <th>Question</th>
                                        <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3</th>
                                        <th>Option 4</th>
                                        <th>Mark</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $mcqQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mcq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><strong><?php echo e(++$index); ?></strong></td>
                                            <td><?php echo e($mcq->lesson_id); ?></td>
                                            <td><?php echo e($mcq->part_number); ?></td>
                                            <td><?php echo e($mcq->question); ?></td>
                                            <td><?php echo e($mcq->option_1); ?></td>
                                            <td><?php echo e($mcq->option_2); ?></td>
                                            <td><?php echo e($mcq->option_3); ?></td>
                                            <td><?php echo e($mcq->option_4); ?></td>
                                            <td><?php echo e($mcq->default_mark); ?></td>
                                            <td><?php echo e($mcq->created_at); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>

                    </div>
                    <?php endif; ?>

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
    
    <script>
        $(function () {
            $("#course_id").on('change', function () {
                $('#lesson_id').empty();
                var course_id = $('#course_id').val();
                    var url = '<?php echo e(route('getLessonsByCourseId')); ?>';
                    var token = '<?php echo e(Session::token()); ?>';
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {_token: token, course_id: course_id},
                        success: function (data) {
                            $('#lesson_id').append('<option value="">-- Select One --</option>');
                            if (data != null && data != '') {
                                var i;
                                for (i = 1; i <= data.length; i++) {
                                    $('#lesson_id').append('<option value="' + data[i - 1]['id'] + '">' + data[i - 1]['title'] + '</option>')
                                }
                            }
                        },
                    });
            });
        });
    </script>
    
    <script>
        $(function () {
            $("#lesson_id").on('change', function () {
                $('#part').empty();
                var lesson_id = $('#lesson_id').val();
                    var url = '<?php echo e(route('getPartsByLesson')); ?>';
                    var token = '<?php echo e(Session::token()); ?>';
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {_token: token, lesson_id: lesson_id},
                        success: function (data) {
                            $('#part').append('<option value="">-- Select One --</option>');
                            if (data != null && data != '') {
                                var i;
                                for (i = 1; i <= data.length; i++) {
                                    $('#part').append('<option value="' + data[i - 1] + '">' + data[i - 1] + '</option>')
                                }
                            }
                        },
                    });
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>