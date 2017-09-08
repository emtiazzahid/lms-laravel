<?php $__env->startSection('title', 'E-Learning'); ?>
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
                  <div class="row">
                     <h2>Mcq Exam</h2>
                     <h2 class="pull-right"><strong>Course:</strong> <?php echo e($exam->course->title); ?> | <strong>Teacher:</strong> <?php echo e($exam->teacher->user->name); ?></h2>
                  </div>
                  <div class="row pull-right">
                     <h2>Duration: <?php echo e($exam->duration); ?> | Passing Score: <?php echo e($exam->passing_score); ?> %</h2>
                  </div>

                  <div class="clearfix"></div>
               </div>

               <div class="x_content">
                  <?php if(count($mcqQuestions)<1): ?>
                     <div class="alert alert-dismissible fade in alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Sorry !</strong>Something Wrong! No Mcq Question Data Found.
                     </div>
                  <?php else: ?>
                     <form method="post" action="<?php echo e(route('postMcqQuestionAnswers')); ?>">
                        <input type="hidden" name="exam_id" value="<?php echo e($exam->id); ?>">
                        <input type="hidden" name="question_type" value="<?php echo e($exam->question_file->question_type); ?>">
                        <input type="hidden" name="course_id" value="<?php echo e($exam->course_id); ?>">
                        <input type="hidden" name="teacher_id" value="<?php echo e($exam->teacher_id); ?>">
                        <input type="hidden" name="passing_score" value="<?php echo e($exam->passing_score); ?>">
                        <?php echo e(csrf_field()); ?>

                        <table class="table table-bordered">
                           <thead>
                           <th>Sl.</th>
                           <th>Mcq and Answer</th>
                           <th>Mark</th>
                           </thead>
                           <tbody>
                           <?php  $sl = 0  ?>
                           <?php $__currentLoopData = $mcqQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                 <td><?php echo e(++$sl); ?></td>
                                 <td>
                                    <input type="hidden" name="id[]" value="<?php echo e($question->id); ?>">
                                    <input type="hidden" name="lesson_id[]" value="<?php echo e($question->lesson_id); ?>">
                                    <input type="hidden" name="part_number[]" value="<?php echo e($question->part_number); ?>">
                                    <input type="hidden" name="question[]" value="<?php echo e($question->question); ?>">
                                    <input type="hidden" name="option_1[]" value="<?php echo e($question->option_1); ?>">
                                    <input type="hidden" name="option_2[]" value="<?php echo e($question->option_2); ?>">
                                    <input type="hidden" name="option_3[]" value="<?php echo e($question->option_3); ?>">
                                    <input type="hidden" name="option_4[]" value="<?php echo e($question->option_4); ?>">
                                    <input type="hidden" name="right_answer[]" value="<?php echo e($question->right_answer); ?>">
                                    <input type="hidden" name="description[]" value="<?php echo e($question->description); ?>">
                                    <input type="hidden" name="default_mark[]" value="<?php echo e($question->default_mark); ?>">
                                    Question : <?php echo e($question->question); ?><br>
                                    Option A : <?php echo e($question->option_1); ?><br>
                                    Option B : <?php echo e($question->option_2); ?><br>
                                    Option C : <?php echo e($question->option_3); ?><br>
                                    Option D : <?php echo e($question->option_4); ?><br>
                                    Answer:
                                    <input type="radio" name="answer_for_question_<?php echo e($key); ?>" value="" checked> No Answer
                                    <input type="radio" name="answer_for_question_<?php echo e($key); ?>" value="1"> A
                                    <input type="radio" name="answer_for_question_<?php echo e($key); ?>" value="2"> B
                                    <input type="radio" name="answer_for_question_<?php echo e($key); ?>" value="3"> C
                                    <input type="radio" name="answer_for_question_<?php echo e($key); ?>" value="4"> D
                                 </td>
                                 <td><?php echo e($question->default_mark); ?></td>
                              </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </tbody>
                        </table>
                        <button class="btn btn-block btn-info btn-lg">Confirm and Submit Answers</button>
                     </form>
                  <?php endif; ?>
               </div>

            </div>

         </div>
      </div>

   </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>