<?php $__env->startSection('title', 'E-Learning'); ?>
<?php $__env->startSection('page_css'); ?>
        <!-- Select2 -->
<link href="<?php echo e(url('admin/vendors/select2/dist/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- page content -->
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
                    <div class="col-md-8 col-md-offset-2">
                        <form method="post" action="<?php echo e(route('post-question-make')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>Course :</label>
                                <select name="course" id="course_id" class="select2_single form-control">
                                    <option value="">Select Course</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Lessons</label>
                                    <select class="select2_multiple form-control" multiple="multiple" name="lessons[]" id="lesson_id">
                                        <option>Choose option</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Parts</label>
                                    <select class="select2_multiple form-control" multiple="multiple" name="parts[]" id="part">
                                        <option>Choose option</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Show</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <?php if(isset($questions)): ?>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Written Questions</h2>
                    <form action="<?php echo e(route('saveQuestionInQuestionBank')); ?>" method="post" class="form-inline pull-right">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e(\App\Libraries\Enumerations\QuestionTypes::$WRITTEN); ?>" name="question_type">
                        <input type="hidden" value="<?php echo e($course_id); ?>" name="course_id">
                        <input type="hidden" value="<?php echo e($questionString); ?>" name="question_string">
                        <div class="form-group">
                            <label for="" >Question File Title</label>
                            <input type="text" name="question_title" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">
                                Save in Question Bank
                        </button>

                    
                    </form>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-8 col-md-offset-2">
                        <?php if(count($questions)<1): ?>
                        No Written Question Found
                        <?php else: ?>
                        <table class="table">
                            <thead>
                                <th>SL.</th>
                                <th>Question</th>
                                <th>Mark</th>
                            </thead>
                            <tbody>
                            <?php  $i = 1  ?>
                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($question->question); ?></td>
                                    <td><?php echo e($question->default_mark); ?></td>
                                </tr>
                            <?php  $i++  ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php endif; ?>
            <?php if(isset($mcqs)): ?>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Mcq Questions</h2>
                    <form action="<?php echo e(route('saveQuestionInQuestionBank')); ?>" method="post" class="form-inline pull-right">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e(\App\Libraries\Enumerations\QuestionTypes::$MCQ); ?>" name="question_type">
                        <input type="hidden" value="<?php echo e($course_id); ?>" name="course_id">
                        <input type="hidden" value="<?php echo e($mcqString); ?>" name="question_string">
                        <div class="form-group">
                            <label for="" >Question File Title</label>
                            <input type="text" name="question_title" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">
                            Save in Question Bank
                        </button>
                    </form>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-8 col-md-offset-2">
                        <?php if(count($mcqs)<1): ?>
                            No Mcq Question Found
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                <th>SL.</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Mark</th>
                                </thead>
                                <tbody>
                                <?php  $i = 1  ?>
                                <?php $__currentLoopData = $mcqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mcq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($mcq->question); ?></td>
                                        <td>
                                            <strong>I)</strong> <?php echo e($mcq->option_1); ?><br>
                                            <strong>II)</strong> <?php echo e($mcq->option_2); ?><br>
                                            <strong>III)</strong> <?php echo e($mcq->option_3); ?><br>
                                            <strong>IV)</strong> <?php echo e($mcq->option_4); ?>

                                        </td>
                                        <td><?php echo e($mcq->default_mark); ?></td>
                                    </tr>
                                    <?php  $i++  ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- /page content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_js'); ?>
        <!-- Select2 -->
<script src="<?php echo e(url('admin/vendors/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "Select a option",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            placeholder: "Select options",
            allowClear: true
        });
    });
</script>
<!-- /Select2 -->

<script>
    $(function () {
        $("#course_id").on('change', function () {
            $('#lesson_id').empty();
            $('#part').empty();
            var course_id = $('#course_id').val();
            var url = '<?php echo e(route('getLessonsByCourseId')); ?>';
            var token = '<?php echo e(Session::token()); ?>';
            $.ajax({
                method: 'POST',
                url: url,
                data: {_token: token, course_id: course_id},
                success: function (data) {
                    if (data != null && data != '') {
                        var i;
                        for (i = 1; i <= data.length; i++) {
                            $('#lesson_id').append('<option value="' + data[i - 1]['id'] + '">' + data[i - 1]['title'] + '</option>')
                        }
                        partsInputFieldDataGenerate();
                    }
                }
            });
        });
    });
    function  partsInputFieldDataGenerate() {
        $("#lesson_id").change(function () {
            var checkedValues = $('#lesson_id option:selected').map(function() {
                return this.value;
            }).get();
            $('#part').empty();
            if(checkedValues.length > 0){
                var url = '<?php echo e(route('getPartsByLessonIds')); ?>';
                var token = '<?php echo e(Session::token()); ?>';
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {_token: token, lessons: checkedValues},
                    success: function (data) {
                         $('#part').empty();
                        if (data != null && data != '') {
                            var i;
                            for (i = 1; i <= data.length; i++) {
                                $('#part').append('<option value="' + data[i - 1] + '">' + data[i - 1] + '</option>')
                             }
                        }

                    }
                });
            }
        });
    }

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>