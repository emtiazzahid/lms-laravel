@extends('admin.layouts.master')

@section('title', 'Question File List')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('question_files') !!}

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
                        <form class="form-horizontal form-label-left" method="get" action="{{ route('getAllQuestionFiles') }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Course</label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        {{--<input type="hidden" id="token" name="_token" value="{{ Session::token() }}">--}}
                                        <select name="course_id" id="course_id" class="select2_single form-control" tabindex="-1" >
                                            <option></option>
                                            @if($courses)
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-md">Show Lessons</button>
                            </div>
                        </form>
                    </div>

                </div>
                @if(isset($questionFiles))
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Question File List</h2>
                        <a href="{{ route('question-make') }}" class="pull-right btn btn-info btn-sm">
                            <i class="fa fa-plus"></i> Generate New Question File
                        </a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($questionFiles)<1)
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
                                <th>ID. </th>
                                <th>Question Title </th>
                                <th>Question Type </th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($questionFiles as $questionFile)
                                    <tr>
                                        <td>{{ $questionFile->id }}</td>
                                        <td>{{ $questionFile->question_title }}</td>
                                        <td>
                                            @if($questionFile->question_type == \App\Libraries\Enumerations\QuestionTypes::$WRITTEN)
                                                Written
                                            @elseif($questionFile->question_type == \App\Libraries\Enumerations\QuestionTypes::$MCQ)
                                                Mcq
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td>{{ $questionFile->created_at }}</td>
                                        <td><a href="{{ route('questionFileDetails',['id' => $questionFile->id]) }}" class="btn btn-info btn-flat">Open Question File</a></td>
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