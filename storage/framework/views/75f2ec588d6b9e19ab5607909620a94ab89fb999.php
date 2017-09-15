<?php $__env->startSection('title', 'Lesson Files List'); ?>

        <!-- page content -->
<?php $__env->startSection('content'); ?>

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo Breadcrumbs::render('lesson_details_edit',$lesson_id,$teacher_lesson->number); ?>

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
                <div class="col-md-6">
                    <div class="x_panel">

                        <div class="x_title">
                            <h2>Lesson - <?php echo e($lesson_id); ?> Video File List</h2>
                            <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                                <i class="fa fa-plus"></i> Add Video File
                            </button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <?php if(count($videos)<1): ?>
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
                                        <th>Part Number</th>
                                        <th>Video Title</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><strong><?php echo e(++$index); ?></strong></td>
                                            <td><?php echo e($video->part_number); ?></td>
                                            <td><?php echo e($video->video_title); ?></td>
                                            <td class="text-center">
                                                <button type="button"
                                                        data-video_id="<?php echo e($video->id); ?>"
                                                        data-video_part_number="<?php echo e($video->part_number); ?>"
                                                        data-video_title="<?php echo e($video->video_title); ?>"
                                                        data-video_description="<?php echo e($video->description); ?>"
                                                        data-video_embed_url="<?php echo e($video->video_embed_url); ?>"
                                                        data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>

                                                <a href="<?php echo e(route('lesson-video-delete', ['id'=>$video->id])); ?>" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="x_panel">

                        <div class="x_title">
                            <h2>Lesson - <?php echo e($lesson_id); ?> Document File List</h2>
                            <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addFileModal">
                                <i class="fa fa-plus"></i> Add Document File
                            </button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <?php if(count($videos)<1): ?>
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Data Found.
                                </div>
                            <?php else: ?>
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data2">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Part Number</th>
                                        <th>File Title</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><strong><?php echo e(++$index); ?></strong></td>
                                            <td><?php echo e($file->part_number); ?></td>
                                            <td><?php echo e($file->file_title); ?></td>
                                            <td class="text-center">
                                                <button type="button"
                                                        data-file_id="<?php echo e($file->id); ?>"
                                                        data-file_part_number="<?php echo e($file->part_number); ?>"
                                                        data-file_title="<?php echo e($file->file_title); ?>"
                                                        data-file_description="<?php echo e($file->description); ?>"
                                                        data-file_url="<?php echo e($file->file_url); ?>"
                                                        data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateFileModal">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>

                                                <a href="<?php echo e(route('lesson-file-delete', ['id'=>$file->id])); ?>" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lesson Question/Objectives</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <a href="<?php echo e(route('lesson-questions',['id' => $lesson_id])); ?>" class="btn btn-app">
                            <i class="fa fa-bullhorn"></i> Questions
                        </a>
                        <a href="<?php echo e(route('lesson-mcqs',['id' => $lesson_id])); ?>" class="btn btn-app">
                            <i class="fa fa-users"></i> Objectives
                        </a>
                    </div>
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
                <form action="<?php echo e(route('lesson-video-update')); ?>" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <input type="hidden" value="<?php echo e($lesson_id); ?>" name="lesson_id">
                            <table class="table">
                                <input type="hidden" name="modal_id" id="modal_video_id">
                                <tr>
                                    <td colspan="2"><label>Part Number</label></td>
                                    <td colspan="2">
                                        <input type="text" name="part_number" class="form-control" id="modal_video_part_number" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Video Title</label></td>
                                    <td colspan="2">
                                        <input type="text" name="video_title" class="form-control"  id="modal_video_title">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Video Embed Url</label></td>
                                    <td colspan="2">
                                        <input type="text" name="video_embed_url" class="form-control" id="modal_video_embed_url" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Description</label></td>
                                    <td colspan="2">
                                        <textarea name="description" class="form-control"  id="modal_video_description"></textarea>
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
                <form action="<?php echo e(route('lesson-video-add')); ?>" method="post">
                    <input type="hidden" value="<?php echo e($lesson_id); ?>" name="lesson_id">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <table class="table">
                                <tr>
                                    <td colspan="2"><label>Part Number</label></td>
                                    <td colspan="2">
                                        <input type="text" name="part_number" class="form-control" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Video Title</label></td>
                                    <td colspan="2">
                                        <input type="text" name="video_title" class="form-control" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Video Embed Url</label></td>
                                    <td colspan="2">
                                        <input type="text" name="video_embed_url" class="form-control" >
                                    </td>
                                </tr>
                                  <tr>
                                    <td colspan="2"><label>Description</label></td>
                                    <td colspan="2">
                                        <textarea name="description" class="form-control" ></textarea>
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
    

    <!--Update File Modal -->
    <div class="modal fade" id="updateFileModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Info</h4>
                </div>
                <form action="<?php echo e(route('lesson-file-update')); ?>" method="post">
                    <input type="hidden" value="<?php echo e($lesson_id); ?>" name="lesson_id">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <table class="table">
                                <input type="hidden" name="modal_id" id="modal_file_id">
                                <tr>
                                    <td colspan="2"><label>Part Number</label></td>
                                    <td colspan="2">
                                        <input type="text" name="part_number" class="form-control" id="modal_file_part_number" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Video Title</label></td>
                                    <td colspan="2">
                                        <input type="text" name="file_title" class="form-control"  id="modal_file_title">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>File Url</label></td>
                                    <td colspan="2">
                                        <input type="text" name="file_url" class="form-control" id="modal_file_url" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Description</label></td>
                                    <td colspan="2">
                                        <textarea name="description" class="form-control"  id="modal_file_description"></textarea>
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
    

    <!--Add File Modal -->
    <div class="modal fade" id="addFileModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Info</h4>
                </div>
                <form action="<?php echo e(route('lesson-file-add')); ?>" method="post">
                    <input type="hidden" value="<?php echo e($lesson_id); ?>" name="lesson_id">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <table class="table">
                                <tr>
                                    <td colspan="2"><label>Part Number</label></td>
                                    <td colspan="2">
                                        <input type="text" name="part_number" class="form-control" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>File Title</label></td>
                                    <td colspan="2">
                                        <input type="text" name="file_title" class="form-control" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>File Url</label></td>
                                    <td colspan="2">
                                        <input type="text" name="file_url" class="form-control" >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Description</label></td>
                                    <td colspan="2">
                                        <textarea name="description" class="form-control" ></textarea>
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
            $('#modal_video_id').val($(e.relatedTarget).data('video_id'));
            $('#modal_video_title').val($(e.relatedTarget).data('video_title'));
            $('#modal_video_part_number').val($(e.relatedTarget).data('video_part_number'));
            $('#modal_video_embed_url').val($(e.relatedTarget).data('video_embed_url'));
            $('#modal_video_description').text($(e.relatedTarget).data('video_description'));
        });
    </script>
    <script>
        $('#updateFileModal').on('show.bs.modal', function (e) {
            $('#modal_file_id').val($(e.relatedTarget).data('file_id'));
            $('#modal_file_title').val($(e.relatedTarget).data('file_title'));
            $('#modal_file_part_number').val($(e.relatedTarget).data('file_part_number'));
            $('#modal_file_url').val($(e.relatedTarget).data('file_url'));
            $('#modal_file_description').text($(e.relatedTarget).data('file_description'));
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
            $('#data2').DataTable({
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