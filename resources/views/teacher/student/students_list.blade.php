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
                                    <th>Action</th>
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
                                        @elseif($student['status'] == \App\Libraries\Enumerations\CourseStudentStatus::$INCOMPLETE)
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
                                        <td>

                                            <button type="button"
                                                    data-teacher_course_id="{{ $student['teacher_course_id'] }}"
                                                    data-course_id="{{ $student['teacher_course']['course_id'] }}"
                                                    data-teacher_id="{{ $student['teacher_course']['teacher_id'] }}"
                                                    data-student_id="{{ $student['student']['user_id'] }}"
                                                    data-student_name="{{ $student['student']['user']['name'] }}"
                                                    data-course_name="{{ $student['teacher_course']['course']['title'] }}"
                                                    data-teacher_name="{{ $teacherInfo->user->name }}"
                                                    data-teacher_signature="{{ $teacherInfo->signature ? asset($teacherInfo->signature->file_path) : '' }}"
                                                    data-f_teacher_signature="{{ $teacherInfo->signature ? $teacherInfo->signature->file_path : '' }}"
                                                    data-toggle="modal" data-target="#certificateModal" class="btn btn-flat btn-sm btn-info">
                                                @if($student['status'] == \App\Libraries\Enumerations\CourseStudentStatus::$COMPLETED)
                                                    Resend Certificate
                                                @else
                                                    Send Certificate
                                                @endif
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

    <!--Certificate Modal -->
    <div class="modal fade" id="certificateModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Certificate Preview</h4>
                </div>
                <form action="{{ route('certifyStudent') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="teacher_course_id" id="f_teacher_course_id">
                    <input type="hidden" name="student_id" id="f_student_id">
                    <input type="hidden" name="teacher_id" id="f_teacher_id">
                    <input type="hidden" name="course_id" id="f_course_id">
                    <input type="hidden" name="teacher_name" id="f_teacher_name">
                    <input type="hidden" name="student_name" id="f_student_name">
                    <input type="hidden" name="course_name" id="f_course_name">
                    <input type="hidden" name="signature_image" id="f_signature_image">
                    <div class="modal-body">
                        <div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
                            <div style="width:750px; height:550px; padding:20px;  border: 5px solid #787878">
                                <div style="text-align:center;">
                                    <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
                                    <br><br>
                                    <span style="font-size:25px"><i>This is to certify that</i></span>
                                    <br><br>
                                    <span style="font-size:30px"><b id="studentName"></b></span><br/><br/>
                                    <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
                                    <span style="font-size:30px" id="courseName"></span> <br/><br/>
                                    <span style="font-size:25px"><i>dated</i></span><br>
                                    <span style="font-size:30px" id="certificateDate"></span><br/><br/>
                                </div>
                                <div style="text-align: right; padding-right: 20px;">
                                    <img src="" alt="Signature" id="teacherSignature" style="text-align: right;height: 50px;width: 100px;">
                                    <p style="font-size:30px;
                                      text-decoration: overline;
                                    " id="teacherName"></p>
                                </div>
                            </div>
                        </div>
                   </div>
                    <button type="submit" class="btn btn-info pull-right">Confirm and Send</button>
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

        $('#certificateModal').on('show.bs.modal', function (e) {
            $('#studentName').text($(e.relatedTarget).data('student_name'));
            $('#courseName').text($(e.relatedTarget).data('course_name'));
            $('#teacherName').text($(e.relatedTarget).data('teacher_name'));

            $('#certificateDate').text(getCertificateDate());

            $('#f_teacher_course_id').val($(e.relatedTarget).data('teacher_course_id'));
            $('#f_course_id').val($(e.relatedTarget).data('course_id'));
            $('#f_teacher_id').val($(e.relatedTarget).data('teacher_id'));
            $('#f_student_id').val($(e.relatedTarget).data('student_id'));

            $('#f_student_name').val($(e.relatedTarget).data('student_name'));
            $('#f_teacher_name').val($(e.relatedTarget).data('teacher_name'));
            $('#f_course_name').val($(e.relatedTarget).data('course_name'));
            $('#f_signature_image').val($(e.relatedTarget).data('f_teacher_signature'));

            $("#teacherSignature").attr("src",$(e.relatedTarget).data('teacher_signature'));
        });

        function getCertificateDate() {
            var m_names = new Array("Jan", "Feb", "Mar",
                    "Apr", "May", "Jun", "Jul", "Aug", "Sep",
                    "Oct", "Nov", "Dec");

            var d = new Date();
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            return  curr_date + "-" + m_names[curr_month]
                    + "-" + curr_year;
        }
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