@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('content')
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('viewStudentExamSubmissionFile',$examSubmission->exam->id, $examSubmissionId) !!}

                <div class="x_panel">

                    <div class="x_title">
                        <div class="row">
                            <h2>Written Exam</h2>
                            <h2 class="pull-right"><strong>Course:</strong> {{ $examSubmission->exam->course->title }} | <strong>Teacher:</strong> {{ $examSubmission->exam->teacher->user->name }}
                                | <strong>Student:</strong> {{ $examSubmission->student->user->name }} </h2>
                        </div>
                       <div class="row pull-right">
                            <h2><strong>Duration: </strong>{{ $examSubmission->exam->duration }} | <strong>Passing Score: </strong>{{ $examSubmission->exam->passing_score }} % |</h2>
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
                        @if(count($answerFile->question)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong>Something Wrong! No Written Question Data Found.
                            </div>
                        @else
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Sl.</th>
                                        <th>Question and Answer</th>
                                        <th>Mark</th>
                                        <th>Given Mark</th>
                                    </thead>
                                    <tbody>
                                        @php $sl = 0 @endphp
                                        @foreach($answerFile->question as $key => $question)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>
                                                    <strong>Question:</strong> {{ $answerFile->question[$key] }}<br>
                                                    <strong>Answer:</strong> <p>{{ $answerFile->answer[$key] or 'Answer not found' }}</p>
                                                </td>
                                                <td>{{ $answerFile->default_mark[$key] }}</td>
                                                <td><input type="number" max="{{ $answerFile->default_mark[$key] }}" min="0" name="given_mark[]" class="form-control" readonly value="{{ $answerFile->given_mark[$key] }}"></td>
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