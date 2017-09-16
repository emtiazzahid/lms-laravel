@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('content')
   <div class="right_col" role="main">

      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Breadcrumbs::render('viewStudentExamSubmissionFile',$examSubmission->exam->id, $examSubmissionId) !!}
            <div class="x_panel">

               <div class="x_title text-center">
                  <div class="row">
                     <h2>Mcq Exam</h2>
                     <h2 class="pull-right"><strong>Course:</strong> {{ $examSubmission->exam->course->title }} | <strong>Teacher:</strong> {{ $examSubmission->exam->teacher->user->name }}
                        | <strong>Student:</strong> {{ $examSubmission->student->user->name }} </h2>
                  </div>
                  <div class="row pull-right">
                     <h2><strong>Duration:</strong> {{ $examSubmission->exam->duration }} | <strong>Passing Score:</strong> {{ $examSubmission->exam->passing_score }} % | </h2>
                     <h2>
                        <strong>Total Mark :</strong>{{ $examSubmission->total_mark }} |
                        <strong>Achieve Mark :</strong>{{ $examSubmission->achieve_mark }} |
                        <strong>Result Status :</strong>@if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$PASSED)
                           <span class="label label-success" style="color:white">Passed</span>
                        @elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$FAILED)
                           <span class="label label-danger" style="color:white">Failed</span>
                        @endif
                     </h2>
                  </div>


                  <div class="clearfix"></div>
               </div>

               <div class="x_content">
                  @if(count($answerFile->id)<1)
                     <div class="alert alert-dismissible fade in alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Sorry !</strong>Something Wrong! No Mcq Question Data Found.
                     </div>
                  @else
                     {{--<form method="post" action="{{ route('postMcqQuestionAnswers') }}">--}}
                        {{--<input type="hidden" name="exam_id" value="{{ $exam->id }}">--}}
                        {{--<input type="hidden" name="question_type" value="{{ $exam->question_file->question_type }}">--}}
                        {{--<input type="hidden" name="course_id" value="{{ $exam->course_id }}">--}}
                        {{--<input type="hidden" name="teacher_id" value="{{ $exam->teacher_id }}">--}}
                        {{--<input type="hidden" name="passing_score" value="{{ $exam->passing_score }}">--}}
                        {{--{{ csrf_field() }}--}}
                        <table class="table table-bordered">
                           <thead>
                           <th>Sl.</th>
                           <th>Mcq and Answer</th>
                           <th>Mark</th>
                           <th>Achieved Mark</th>
                           </thead>
                           <tbody>
                           @php $sl = 0 @endphp
                           @foreach($answerFile->id as $key =>  $answer)
                              <tr>
                                 <td>{{ ++$sl }}</td>
                                 <td>
                                    Question : {{ $answerFile->question[$key] }}<br>
                                    Option A : {{ $answerFile->option_1[$key] }}<br>
                                    Option B : {{ $answerFile->option_2[$key] }}<br>
                                    Option C : {{ $answerFile->option_3[$key] }}<br>
                                    Option D : {{ $answerFile->option_4[$key] }}<br>
                                    <strong>Right Answer:</strong>
                                    {{ $answerFile->right_answer[$key] }}<br>
                                    <strong>Given Answer:</strong>
                                    @php $answer_for_question = 'answer_for_question_'.$key @endphp
                                    {{  $answerFile->$answer_for_question  or 'no answer'}}
                                 </td>
                                 <td>{{ $answerFile->default_mark[$key] }}</td>
                                 <td>
                                    @if( (int) $answerFile->right_answer[$key] == (int) $answerFile->$answer_for_question)
                                       {{ $answerFile->default_mark[$key] }}
                                    @else
                                       0
                                    @endif
                                 </td>
                              </tr>
                           @endforeach
                           </tbody>
                        </table>
                  @endif
               </div>

            </div>

         </div>
      </div>

   </div>

@stop