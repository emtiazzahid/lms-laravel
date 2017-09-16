@extends('admin.layouts.master')

@section('title','Exam Submissions ')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
{{--                {!! Breadcrumbs::render('lessons') !!}--}}
                {!! Breadcrumbs::render('getStudentExamSubmissionsByCourse') !!}
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
                        <h2>Select Course</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form class="form-horizontal form-label-left" method="get" action="{{ route('getStudentExamSubmissionsByCourse') }}">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Course</label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select name="course_id" id="course_id" class="select2_single form-control" tabindex="-1" >
                                            <option></option>
                                            @if($teacherCourses)
                                                @foreach($teacherCourses as $teacherCourse)
                                                    <option value="{{ $teacherCourse->course->id }}">{{ $teacherCourse->course->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-md">Show Exam Attempts</button>
                            </div>
                        </form>
                    </div>

                </div>
                @if(isset($exams))
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Exam Attempts List</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($exams)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Data Found.
                            </div>
                        @else
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Exam Title </th>
                                <th>Course</th>
                                <th>Question File</th>
                                <th>Passing Score</th>
                                <th>Submissions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td><strong>{{ ++$index }}</strong></td>
                                    <td>{{ $exam->exam_title }}</td>
                                    <td>{{ $exam->course->title }}</td>
                                    <td>{{ $exam->question_file->question_title }}</td>
                                    <td>{{ $exam->passing_score }}</td>
                                    <td>
                                        <a href="{{ route('getStudentSubmissionsPageByExam',['exam_id'=>$exam->id]) }}" class="btn btn-info btn-sm" @if(count($exam->submissions)<1) disabled @endif>Show Submissions <span class="badge">{{ count($exam->submissions) }}</span></a>
                                    </td>

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
@stop