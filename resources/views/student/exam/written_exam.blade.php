@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('page_css')
    <style>
    #examFile
    {
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }
    </style>
@stop
@section('content')
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
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
                    <div class="text-center" id="remaining_type"></div>
                    <div class="x_title">

                        <div class="row">
                            <h2>Written Exam</h2>
                            <h2 class="pull-right"><strong>Course:</strong> {{ $exam->course->title }} | <strong>Teacher:</strong> {{ $exam->teacher->user->name }}</h2>
                        </div>
                       <div class="row pull-right">
                            <h2>Duration: {{ $exam->duration }} | Passing Score: {{ $exam->passing_score }} %</h2>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($writtenQuestions)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong>Something Wrong! No Written Question Data Found.
                            </div>
                        @else
                            <form method="post" action="{{ route('postWrittenQuestionAnswers') }}" id="examFile">
                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                <input type="hidden" name="question_type" value="{{ $exam->question_file->question_type }}">
                                <input type="hidden" name="course_id" value="{{ $exam->course_id }}">
                                <input type="hidden" name="teacher_id" value="{{ $exam->teacher_id }}">
                                <input type="hidden" name="passing_score" value="{{ $exam->passing_score }}">
                                {{ csrf_field() }}
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Sl.</th>
                                        <th>Question and Answer</th>
                                        <th>Mark</th>
                                    </thead>
                                    <tbody>
                                        @php $sl = 0 @endphp
                                        @foreach($writtenQuestions as $question)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>
                                                    <input type="hidden" name="id[]" value="{{ $question->id }}">
                                                    <input type="hidden" name="lesson_id[]" value="{{ $question->lesson_id }}">
                                                    <input type="hidden" name="part_number[]" value="{{ $question->part_number }}">
                                                    <input type="hidden" name="question[]" value="{{ $question->question }}">
                                                    <input type="hidden" name="description[]" value="{{ $question->description }}">
                                                    <input type="hidden" name="default_mark[]" value="{{ $question->default_mark }}">
                                                    Question : {{ $question->question }}<br>
                                                    Answer: <textarea class="form-control answerField" name="answer[]"></textarea>
                                                </td>
                                                <td>{{ $question->default_mark }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-block btn-info btn-lg">Confirm and Submit Answers</button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    </div>

@stop
@section('page_js')
    <script src="{{ url('js/jquery.countdown.js') }}"></script>
    <script>
        (function($){
            $.fn.disableSelection = function() {
                return this
                        .attr('unselectable', 'on')
                        .css('user-select', 'none')
                        .on('selectstart', false);
            };
        })(jQuery);

        $('.answerField').bind("cut copy paste",function(e) {
            e.preventDefault();
        });

        var time = '{{ $exam->duration }}';
        var timeParts = time.split(":");
        var totalMilliseconds = (+timeParts[0] * (60000 * 60)) + (+timeParts[1] * 60000) + (+timeParts[2] * 1000);

        var fiveSeconds = new Date().getTime() +totalMilliseconds;
        $('#remaining_type').countdown(fiveSeconds, function(event) {
            var $this = $(this).html(event.strftime(''
                            + '<h3>%H hr '
                            + '%M min '
                            + '%S sec </h3>'))
                    .on('finish.countdown', function (event) {
                        $('#examFile').submit();
                    });
        });
    </script>
@stop