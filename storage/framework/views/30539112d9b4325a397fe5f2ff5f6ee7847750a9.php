<?php $__env->startSection('title', 'Courses Listing Settings'); ?>

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
                    <!-- <?php echo Breadcrumbs::render('courses'); ?> -->
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Trending Courses List</h2>
                        <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i>Add Trending Course
                        </button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($trendingCourses)<1): ?>
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
                                <th>Title</th>
                                <th>Added at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $trendingCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trendingCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e(++$index); ?></strong></td>
                                    <td><?php echo e($trendingCourse->course_title); ?></td>
                                    <td><?php echo e($trendingCourse->created_at); ?></td>
                                    <td class="text-center">
                                      <a href="<?php echo e(route('trending-courses-delete', ['id'=>$trendingCourse->id])); ?>" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Info</h4>
                    </div>
                    <form action="<?php echo e(route('trending-courses-add')); ?>" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Course</label></td>
                                        <td colspan="2">
                                            <select name="course" required class="form-control">
                                                <?php $__currentLoopData = $teacherCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($teacherCourse->id); ?>"><?php echo e($teacherCourse->course->title); ?> - <?php echo e($teacherCourse->teacher->user->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
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