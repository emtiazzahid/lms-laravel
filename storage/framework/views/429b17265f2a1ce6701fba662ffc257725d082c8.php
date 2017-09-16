<?php $__env->startSection('title','Exam Submissions '); ?>

<!-- page content -->
<?php $__env->startSection('content'); ?>

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <?php echo Breadcrumbs::render('getStudentExamSubmissionsByCourse'); ?>

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
                        <h2>Select Course</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form class="form-horizontal form-label-left" method="get" action="<?php echo e(route('getStudentExamSubmissionsByCourse')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Course</label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select name="course_id" id="course_id" class="select2_single form-control" tabindex="-1" >
                                            <option></option>
                                            <?php if($teacherCourses): ?>
                                                <?php $__currentLoopData = $teacherCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($teacherCourse->course->id); ?>"><?php echo e($teacherCourse->course->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-md">Show Exam Attempts</button>
                            </div>
                        </form>
                    </div>

                </div>
                <?php if(isset($exams)): ?>
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Exam Attempts List</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($exams)<1): ?>
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
                                <th>Exam Title </th>
                                <th>Course</th>
                                <th>Question File</th>
                                <th>Passing Score</th>
                                <th>Submissions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e(++$index); ?></strong></td>
                                    <td><?php echo e($exam->exam_title); ?></td>
                                    <td><?php echo e($exam->course->title); ?></td>
                                    <td><?php echo e($exam->question_file->question_title); ?></td>
                                    <td><?php echo e($exam->passing_score); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('getStudentSubmissionsPageByExam',['exam_id'=>$exam->id])); ?>" class="btn btn-info btn-sm" <?php if(count($exam->submissions)<1): ?> disabled <?php endif; ?>>Show Submissions <span class="badge"><?php echo e(count($exam->submissions)); ?></span></a>
                                    </td>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>