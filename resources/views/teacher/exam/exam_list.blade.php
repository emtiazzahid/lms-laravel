@extends('admin.layouts.master')

@section('title', 'Exam List')

        <!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('getExamListPage') !!}


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
                        <h2>Exam List</h2>
                        <a href="{{ route('getExamCreatePage') }}" class="pull-right btn btn-info btn-sm">
                            <i class="fa fa-plus"></i> Create new exam
                        </a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($exams)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Exam Data Found.
                            </div>
                        @else
                            <?php $index = 0; ?>
                            <table class="table table-striped table-bordered dataTable no-footer" id="data">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Course</th>
                                    <th>Question File</th>
                                    <th>Pass Score</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($exams as $exam)
                                    <tr>
                                        <td><strong>{{ ++$index }}</strong></td>
                                        <td>{{ $exam->exam_title }}</td>
                                        <td>{{ $exam->course->title }}</td>
                                        <td>{{ $exam->question_file->question_title }}</td>
                                        <td>{{ $exam->passing_score }} %</td>
                                        <td>{{ $exam->duration }}</td>
                                        <td>
                                            @if($exam->status == \App\Libraries\Enumerations\ExamStatus::$RUNNING)
                                                Running
                                            @elseif($exam->status == \App\Libraries\Enumerations\ExamStatus::$PENDING)
                                                Pending
                                            @else
                                                Done
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                    data-id="{{ $exam->id }}"
                                                    data-status="{{ $exam->status }}"
                                                    data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>

                                            <a href="{{route('exam-delete', ['id'=>$exam->id])}}" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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
    <!--Update Modal -->
    <div class="modal fade" id="updateModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Info</h4>
                </div>
                <form action="{{ route('exam-update') }}" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <table class="table">
                                <input type="hidden" name="modal_id" id="modal_id">
                                <tr>
                                    <td colspan="2"><label>Status</label></td>
                                    <td colspan="2">
                                        <select class="form-control" name="status" id="modal_status">
                                            <option value="{{ \App\Libraries\Enumerations\ExamStatus::$PENDING }}">Pending</option>
                                            <option value="{{ \App\Libraries\Enumerations\ExamStatus::$RUNNING }}">Running</option>
                                            <option value="{{ \App\Libraries\Enumerations\ExamStatus::$DONE }}">Done</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <button type="submit" class="btn btn-default pull-right">Update</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>
    {{--Update Modal End--}}
@stop
            <!-- /page content -->

@section('page_js')
    <script>
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_status').val($(e.relatedTarget).data('status'));
        });
    </script>
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