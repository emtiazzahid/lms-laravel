<?php $__env->startSection('title', 'E-Learning'); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
<div class="right_col" role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2>Question File Details</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
                    <table class="table table-striped table-bordered dataTable no-footer" id="data">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Question</th>
                            <?php if($questionType == \App\Libraries\Enumerations\QuestionTypes::$MCQ): ?>
                            <th>Options</th>
                            <?php endif; ?>
                            <th>Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $index = 0  ?>
                        <?php $__currentLoopData = $questionBody; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e(++$index); ?></strong></td>
                                <td><?php echo e($question->question); ?></td>
                                <?php if($questionType == \App\Libraries\Enumerations\QuestionTypes::$MCQ): ?>
                                <td>
                                    I. <?php echo e($question->option_1); ?><br>
                                    II. <?php echo e($question->option_2); ?><br>
                                    III. <?php echo e($question->option_3); ?><br>
                                    IV. <?php echo e($question->option_4); ?>

                                </td>
                                <?php endif; ?>
                                <td><?php echo e($question->default_mark); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
        </div>

    </div>
</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>

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