@extends('admin.layouts.master')

@section('title', 'Question List')
<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('question_list') !!}
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
                            <div class="col-md-6 col-md-offset-3">
                            <form class="form" method="get" action="{{ route('question-list') }}">
                                <div class="form-group">
                                    <label>Course :</label>
                                    <select name="course" id="course_id" class="form-control">
                                        <option value="">--Select One--</option>
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lesson :</label>
                                    <select name="lesson" id="lesson_id" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Part :</label>
                                    <select name="part" id="part" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-default">Show</button>
                                </div>
                            </form>
                            </div>
                        </div>

                    </div>
                    @if(isset($writtenQuestions))
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Written Question List</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @if(count($writtenQuestions)<1)
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Written Question Found.
                                </div>
                            @else
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lesson</th>
                                        <th>Part Number</th>
                                        <th>Question</th>
                                        <th>Mark</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($writtenQuestions as $writtenQuestion)
                                        <tr>
                                            <td><strong>{{ ++$index }}</strong></td>
                                            <td>{{ $writtenQuestion->lesson_id }}</td>
                                            <td>{{ $writtenQuestion->part_number }}</td>
                                            <td>{{ $writtenQuestion->question }}</td>
                                            <td>{{ $writtenQuestion->default_mark }}</td>
                                            <td>{{ $writtenQuestion->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                    </div>
                    @endif
                    @if(isset($mcqQuestions))
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Mcq Question List</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @if(count($mcqQuestions)<1)
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Mcq Question Found.
                                </div>
                            @else
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lesson</th>
                                        <th>Part</th>
                                        <th>Question</th>
                                        <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3</th>
                                        <th>Option 4</th>
                                        <th>Mark</th>
                                        <th>Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mcqQuestions as $mcq)
                                        <tr>
                                            <td><strong>{{ ++$index }}</strong></td>
                                            <td>{{ $mcq->lesson_id }}</td>
                                            <td>{{ $mcq->part_number }}</td>
                                            <td>{{ $mcq->question }}</td>
                                            <td>{{ $mcq->option_1 }}</td>
                                            <td>{{ $mcq->option_2 }}</td>
                                            <td>{{ $mcq->option_3 }}</td>
                                            <td>{{ $mcq->option_4 }}</td>
                                            <td>{{ $mcq->default_mark }}</td>
                                            <td>{{ $mcq->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                    </div>
                    @endif

            </div>
        </div>

    </div>
@stop
<!-- /page content -->

@section('page_js')

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
    {{--getting lessons--}}
    <script>
        $(function () {
            $("#course_id").on('change', function () {
                $('#lesson_id').empty();
                var course_id = $('#course_id').val();
                    var url = '{{ route('getLessonsByCourseId') }}';
                    var token = '{{ Session::token() }}';
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {_token: token, course_id: course_id},
                        success: function (data) {
                            $('#lesson_id').append('<option value="">-- Select One --</option>');
                            if (data != null && data != '') {
                                var i;
                                for (i = 1; i <= data.length; i++) {
                                    $('#lesson_id').append('<option value="' + data[i - 1]['id'] + '">' + data[i - 1]['title'] + '</option>')
                                }
                            }
                        },
                    });
            });
        });
    </script>
    {{--getting parts--}}
    <script>
        $(function () {
            $("#lesson_id").on('change', function () {
                $('#part').empty();
                var lesson_id = $('#lesson_id').val();
                    var url = '{{ route('getPartsByLesson') }}';
                    var token = '{{ Session::token() }}';
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {_token: token, lesson_id: lesson_id},
                        success: function (data) {
                            $('#part').append('<option value="">-- Select One --</option>');
                            if (data != null && data != '') {
                                var i;
                                for (i = 1; i <= data.length; i++) {
                                    $('#part').append('<option value="' + data[i - 1] + '">' + data[i - 1] + '</option>')
                                }
                            }
                        },
                    });
            });
        });
    </script>

@stop