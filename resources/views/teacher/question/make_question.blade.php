@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('page_css')
        <!-- Select2 -->
<link href="{{ url('admin/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@stop
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Breadcrumbs::render('question_files_create') !!}

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
                    <h2>Filter Your Questions</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-8 col-md-offset-2">
                        <form method="post" action="{{ route('post-question-make') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Course :</label>
                                <select name="course" id="course_id" class="select2_single form-control">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
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

            @if(isset($questions))
            <div class="x_panel">
                <div class="x_title">
                    <h2>Written Questions</h2>
                    <form action="{{ route('saveQuestionInQuestionBank') }}" method="post" class="form-inline pull-right">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ \App\Libraries\Enumerations\QuestionTypes::$WRITTEN }}" name="question_type">
                        <input type="hidden" value="{{ $course_id }}" name="course_id">
                        <input type="hidden" value="{{ $questionString }}" name="question_string">
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
                        @if(count($questions)<1)
                        No Written Question Found
                        @else
                        <table class="table">
                            <thead>
                                <th>SL.</th>
                                <th>Question</th>
                                <th>Mark</th>
                            </thead>
                            <tbody>
                            @php $i = 1 @endphp
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->default_mark }}</td>
                                </tr>
                            @php $i++ @endphp
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>

            </div>
            @endif
            @if(isset($mcqs))

            <div class="x_panel">
                <div class="x_title">
                    <h2>Mcq Questions</h2>
                    <form action="{{ route('saveQuestionInQuestionBank') }}" method="post" class="form-inline pull-right">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ \App\Libraries\Enumerations\QuestionTypes::$MCQ }}" name="question_type">
                        <input type="hidden" value="{{ $course_id }}" name="course_id">
                        <input type="hidden" value="{{ $mcqString }}" name="question_string">
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
                        @if(count($mcqs)<1)
                            No Mcq Question Found
                        @else
                            <table class="table">
                                <thead>
                                <th>SL.</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Mark</th>
                                </thead>
                                <tbody>
                                @php $i = 1 @endphp
                                @foreach($mcqs as $mcq)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $mcq->question }}</td>
                                        <td>
                                            <strong>I)</strong> {{ $mcq->option_1 }}<br>
                                            <strong>II)</strong> {{ $mcq->option_2 }}<br>
                                            <strong>III)</strong> {{ $mcq->option_3 }}<br>
                                            <strong>IV)</strong> {{ $mcq->option_4 }}
                                        </td>
                                        <td>{{ $mcq->default_mark }}</td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
<!-- /page content -->

@stop
@section('page_js')
        <!-- Select2 -->
<script src="{{ url('admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
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
{{--getting lessons--}}
<script>
    $(function () {
        $("#course_id").on('change', function () {
            $('#lesson_id').empty();
            $('#part').empty();
            var course_id = $('#course_id').val();
            var url = '{{ route('getLessonsByCourseId') }}';
            var token = '{{ Session::token() }}';
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
                var url = '{{ route('getPartsByLessonIds') }}';
                var token = '{{ Session::token() }}';
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
{{--getting parts--}}

@stop