<?php $__env->startSection('title', 'E-Learning'); ?>
<?php $__env->startSection('content'); ?>
   <div class="right_col" role="main">

      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo Breadcrumbs::render('viewStudentExamSubmissionFile',$examSubmission->exam->id, $examSubmissionId); ?>

            <div class="x_panel">

               <div class="x_title text-center">
                  <div class="row">
                     <h2>Mcq Exam</h2>
                     <h2 class="pull-right"><strong>Course:</strong> <?php echo e($examSubmission->exam->course->title); ?> | <strong>Teacher:</strong> <?php echo e($examSubmission->exam->teacher->user->name); ?>

                        | <strong>Student:</strong> <?php echo e($examSubmission->student->user->name); ?> </h2>
                  </div>
                  <div class="row pull-right">
                     <h2><strong>Duration:</strong> <?php echo e($examSubmission->exam->duration); ?> | <strong>Passing Score:</strong> <?php echo e($examSubmission->exam->passing_score); ?> % | </h2>
                     <h2>
                        <strong>Total Mark :</strong><?php echo e($examSubmission->total_mark); ?> |
                        <strong>Achieve Mark :</strong><?php echo e($examSubmission->achieve_mark); ?> |
                        <strong>Result Status :</strong><?php if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$PASSED): ?>
                           <span class="label label-success" style="color:white">Passed</span>
                        <?php elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$FAILED): ?>
                           <span class="label label-danger" style="color:white">Failed</span>
                        <?php endif; ?>
                     </h2>
                  </div>


                  <div class="clearfix"></div>
               </div>

               <div class="x_content">
                  <?php if(count($answerFile->id)<1): ?>
                     <div class="alert alert-dismissible fade in alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Sorry !</strong>Something Wrong! No Mcq Question Data Found.
                     </div>
                  <?php else: ?>
                     
                        
                        
                        
                        
                        
                        
                        <table class="table table-bordered">
                           <thead>
                           <th>Sl.</th>
                           <th>Mcq and Answer</th>
                           <th>Mark</th>
                           <th>Achieved Mark</th>
                           </thead>
                           <tbody>
                           <?php  $sl = 0  ?>
                           <?php $__currentLoopData = $answerFile->id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                 <td><?php echo e(++$sl); ?></td>
                                 <td>
                                    Question : <?php echo e($answerFile->question[$key]); ?><br>
                                    Option A : <?php echo e($answerFile->option_1[$key]); ?><br>
                                    Option B : <?php echo e($answerFile->option_2[$key]); ?><br>
                                    Option C : <?php echo e($answerFile->option_3[$key]); ?><br>
                                    Option D : <?php echo e($answerFile->option_4[$key]); ?><br>
                                    <strong>Right Answer:</strong>
                                    <?php echo e($answerFile->right_answer[$key]); ?><br>
                                    <strong>Given Answer:</strong>
                                    <?php  $answer_for_question = 'answer_for_question_'.$key  ?>
                                    <?php echo e(isset($answerFile->$answer_for_question) ? $answerFile->$answer_for_question : 'no answer'); ?>

                                 </td>
                                 <td><?php echo e($answerFile->default_mark[$key]); ?></td>
                                 <td>
                                    <?php if( (int) $answerFile->right_answer[$key] == (int) $answerFile->$answer_for_question): ?>
                                       <?php echo e($answerFile->default_mark[$key]); ?>

                                    <?php else: ?>
                                       0
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>