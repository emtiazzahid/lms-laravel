<?php $__env->startSection('title', 'Lessons List'); ?>

<!-- page content -->
<?php $__env->startSection('content'); ?>

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo Breadcrumbs::render('lessons'); ?>

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
                        <form class="form-horizontal form-label-left" method="get" action="<?php echo e(route('course-lessons-list')); ?>">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Course</label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        
                                        <select name="course_id" id="course_id" class="select2_single form-control" tabindex="-1" >
                                            <option></option>
                                            <?php if($courses): ?>
                                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-md">Show Lessons</button>
                            </div>
                        </form>
                    </div>

                </div>
                <?php if(isset($lessons)): ?>
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Lessons List</h2>
                        <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i> Add New Lesson
                        </button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($courses)<1): ?>
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
                                <th>Lesson No </th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e(++$index); ?></strong></td>
                                    <td>
                                        <a href="<?php echo e(route('getLessonDetails',['id' => $lesson->id])); ?>">
                                        Lesson - <?php echo e($lesson->number); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($lesson->title); ?></td>
                                    <td class="text-center">
                                        <button type="button"
                                                data-id="<?php echo e($lesson->id); ?>"
                                                data-number="<?php echo e($lesson->number); ?>"
                                                data-title="<?php echo e($lesson->title); ?>"
                                                data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>

                                      <a href="<?php echo e(route('lesson-delete', ['course_id' => $course_id,'id'=>$lesson->id])); ?>" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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
    <!--Update Modal -->
        <div class="modal fade" id="updateModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Info</h4>
                    </div>
                    <form action="<?php echo e(route('lesson-update')); ?>" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                                <table class="table">
                                    <input type="hidden" name="modal_id" id="modal_id">
                                    <input type="hidden" name="course_id" value="<?php if(isset($course_id)) { echo $course_id; } ?>">
                                    <tr>
                                        <td colspan="2"><label>number</label></td>
                                        <td colspan="2">
                                            <input type="text" name="number" class="form-control" id="modal_number" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Title</label></td>
                                        <td colspan="2">
                                            <input type="text" name="title" class="form-control" id="modal_title" >
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
    

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Info</h4>
                    </div>
                    <form action="<?php echo e(route('lesson-add')); ?>" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                                <input type="hidden" name="course_id" value="<?php if(isset($course_id)) { echo $course_id; } ?>">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>number</label></td>
                                        <td colspan="2">
                                            <input type="text" name="number" class="form-control"  >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Title</label></td>
                                        <td colspan="2">
                                            <input type="text" name="title" class="form-control" >
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
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_number').val($(e.relatedTarget).data('number'));
            $('#modal_title').val($(e.relatedTarget).data('title'));
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