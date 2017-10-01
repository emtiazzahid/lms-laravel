@extends('admin.layouts.master')

@section('title', 'Students List')

        <!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
{{--                {!! Breadcrumbs::render('departments') !!}--}}
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
                        <h2>Students List</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(!$students || count($students)<1)
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
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Results</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td><strong>{{ ++$index }}</strong></td>
                                        <td>{{ $student['student_id'] }}</td>
                                        <td>{{ $student['student']['user']['name'] }}</td>
                                        <td>{{ $student['teacher_course']['course']['title'] }}</td>
                                        <td>
                                        @if($student['status'] == \App\Libraries\Enumerations\CourseStudentStatus::$COMPLETED)
                                            Completed
                                        @else
                                            Incomplete
                                        @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                    data-course_id="{{ $student['teacher_course']['course_id'] }}"
                                                    data-teacher_id="{{ $student['teacher_course']['teacher_id'] }}"
                                                    data-student_id="{{ $student['student']['user_id'] }}"
                                                    data class="btn btn-info btn-sm" data-toggle="modal" data-target="#resultModal">
                                                <i class="fa fa-circle-o" aria-hidden="true"></i> View Results
                                            </button>
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
    <!--Data Modal -->
    <div class="modal fade" id="resultModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Results</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <table class="table" id="resultsTable">

                            </table>
                        </div>
                        {{--<button type="submit" class="btn btn-default pull-right">Update</button>--}}
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>
    {{--Data Modal End--}}

@stop

@section('page_js')
    <script>
        $('#resultModal').on('hidden.bs.modal', function(e)
        {
            $(this).removeData();
            $('#resultsTable').empty();
        }) ;
        $('#resultModal').on('show.bs.modal', function (e) {
            $(".loader").fadeIn();
            $('#resultsTable').empty();
            var course_id = $(e.relatedTarget).data('course_id');
            var teacher_id = $(e.relatedTarget).data('teacher_id');
            var student_id = $(e.relatedTarget).data('student_id');
            var token = '{{ csrf_token() }}';
            var url = '{{ route('getExamsWithSubmissions') }}';
            $.ajax({
                url: url,
                type: 'GET',
                data: {_token : token , course_id:course_id,teacher_id:teacher_id,student_id:student_id},
                success: function(data){
                    if (data != 'false'){

                        $.each(data, function(key, index){
                            var exam_title = index.exam_title;
                            var result_status = '<span class="label label-default">Not Attended Yet</span>';
                            if(index['submissions'][0]) {
                                result_status = index['submissions'][0].result_status;
                            }
                            if (result_status == {{ \App\Libraries\Enumerations\ResultStatus::$FAILED }}){result_status = '<span class="label label-danger">Failed</span>';}
                            else if (result_status == {{ \App\Libraries\Enumerations\ResultStatus::$JUDGING }}){result_status = '<span class="label label-info">Judgement Pending</span>';}
                            else if (result_status == {{ \App\Libraries\Enumerations\ResultStatus::$PASSED }}){result_status = '<span class="label label-success">Passed</span>';}
                            var resultRow = '<tr><td>' +
                                    exam_title +
                                    '</td><td>' +
                                    result_status +
                                    '</td></tr>';
                            $('#resultsTable').append(resultRow);
                        });
                        $(".loader").fadeOut();
                    }else
                    {
                        $(".loader").fadeOut();
                        alert('sorry! something wrong happened. please try again later')
                    }
                }
            });
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