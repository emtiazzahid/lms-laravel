@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('content')
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('judgeStudentExamSubmission',$examSubmission->exam->id, $examSubmission->id) !!}
                @if(isset($errors))
                    @if ( count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
                @if(\Session::has('msg'))

                @endif

                <div class="x_panel">

                    <div class="x_title">
                        <div class="row">
                            <h2>Written Exam</h2>
                            <h2 class="pull-right"><strong>Course:</strong> {{ $examSubmission->exam->course->title }} | <strong>Teacher:</strong> {{ $examSubmission->exam->teacher->user->name }}
                                | <strong>Student:</strong> {{ $examSubmission->student->user->name }} </h2>
                        </div>
                       <div class="row pull-right">
                            <h2>Duration: {{ $examSubmission->exam->duration }} | Passing Score: {{ $examSubmission->exam->passing_score }} %</h2>
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
                            <form method="post" action="{{ route('postWrittenQuestionAnswersWithJudgement') }}">
                                <input type="hidden" name="exam_id" value="{{ $examSubmission->exam->id }}">
                                <input type="hidden" name="question_type" value="{{ $examSubmission->exam->question_file->question_type }}">
                                <input type="hidden" name="course_id" value="{{ $examSubmission->exam->course_id }}">
                                <input type="hidden" name="teacher_id" value="{{ $examSubmission->exam->teacher_id }}">
                                <input type="hidden" name="passing_score" value="{{ $examSubmission->exam->passing_score }}">
                                <input type="hidden" name="answer_file_id" value="{{ $examSubmission->answer_file_id }}">
                                <input type="hidden" name="exam_submission_id" value="{{ $examSubmission->id }}">
                                {{ csrf_field() }}
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
                                                    <input type="hidden" name="id[]" value="{{ $answerFile->id[$key] }}">
                                                    <input type="hidden" name="lesson_id[]" value="{{ $answerFile->lesson_id[$key] }}">
                                                    <input type="hidden" name="part_number[]" value="{{ $answerFile->part_number[$key] }}">
                                                    <input type="hidden" name="question[]" value="{{ $answerFile->question[$key] }}">
                                                    <input type="hidden" name="description[]" value="{{ $answerFile->description[$key] }}">
                                                    <input type="hidden" name="default_mark[]" value="{{ $answerFile->default_mark[$key] }}">

                                                    <strong>Question:</strong> {{ $answerFile->question[$key] }}<br>
                                                    <strong>Answer:</strong> <textarea readonly class="form-control" name="answer[]">{{ $answerFile->answer[$key] }}</textarea>
                                                </td>
                                                <td>{{ $answerFile->default_mark[$key] }}</td>
                                                <td><input type="number" max="{{ $answerFile->default_mark[$key] }}" min="0" name="given_mark[]" class="form-control"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-block btn-info btn-lg">Confirm and Submit Answers Judgement</button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    </div>

@stop