@extends('admin.layouts.master')

@section('title','Exam Submissions List')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('getStudentSubmissionsPageByExam', $examId) !!}
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
                        <h2>Exam Submission List</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($examSubmissions)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Submissions Found.
                            </div>
                        @else
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student </th>
                                <th>Answer File</th>
                                <th>Total Mark</th>
                                <th>Achieve Mark</th>
                                <th>Passed Score</th>
                                <th>Submitted at</th>
                                <th>Result Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examSubmissions as $examSubmission)
                                <tr>
                                    <td><strong>{{ ++$index }}</strong></td>
                                    <td>{{ $examSubmission->student->user->name }}</td>
                                    <td>Answer - {{ $examSubmission->answer_file_id }}</td>
                                    <td>{{ $examSubmission->total_mark }}</td>
                                    <td>{{ $examSubmission->achieve_mark }}</td>
                                    <td>{{ $examSubmission->passed_score }}</td>
                                    <td>{{ $examSubmission->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$FAILED)
                                            Failed
                                        @elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$PASSED)
                                            Passed
                                        @elseif($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$JUDGING)
                                            Judging
                                        @endif
                                    </td>

                                    <td>
                                        @if($examSubmission->result_status == \App\Libraries\Enumerations\ResultStatus::$JUDGING)
                                        <a href="{{ route('judgeStudentExamSubmission',['exam_submission_id'=>$examSubmission->id]) }}" class="btn btn-info btn-sm">Judge</a>
                                        @else
                                        <a href="{{ route('viewStudentExamSubmissionFile',['exam_submission_id'=>$examSubmission->id]) }}" class="btn btn-info btn-sm">Show Submission</a>
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