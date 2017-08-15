@extends('admin.layouts.master')

@section('title', 'Written Question List')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('lesson_questions',$lesson_id,$teacher_lesson->number) !!}
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
                            <h2>Lesson - {{ $teacher_lesson->title }} Written Question List</h2>
                            <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                                <i class="fa fa-plus"></i> Add Written Question
                            </button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @if(count($questions)<1)
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Written Question Found.
                                </div>
                            @else
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data2">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lesson Part</th>
                                        <th>Question</th>
                                        <th>Mark</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($questions as $question)
                                        <tr>
                                            <td><strong>{{ ++$index }}</strong></td>
                                            <td>{{ $question->part_number }}</td>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $question->default_mark }}</td>
                                            <td class="text-center">
                                                <button type="button"
                                                        data-id="{{ $question->id }}"
                                                        data-part_number="{{ $question->part_number }}"
                                                        data-question="{{ $question->question }}"
                                                        data-description="{{ $question->description }}"
                                                        data-default_mark="{{ $question->default_mark }}"
                                                        data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>

                                                <a href="{{route('lesson-question-delete', ['id'=>$question->id])}}" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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
                    <form action="{{ route('lesson-question-update') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                                    <input type="hidden" name="modal_id" id="modal_id">
                                    <tr>
                                        <td colspan="2"><label>Select Lesson Part</label></td>
                                        <td colspan="2">
                                            <select name="part_number" id="" class="form-control" id="modal_port_number">
                                                @foreach($part_numbers as $number)
                                                    <option value="{{ $number }}">{{ $number }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Question</label></td>
                                        <td colspan="2">
                                            <input type="text" name="question" class="form-control"  id="modal_question" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Default Mark</label></td>
                                        <td colspan="2">
                                            <input type="text" name="default_mark" class="form-control"  id="modal_default_mark" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Description</label></td>
                                        <td colspan="2">
                                            <textarea name="description" class="form-control"  id="modal_description"></textarea>
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

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Info</h4>
                    </div>
                    <form action="{{ route('lesson-question-add') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Select Lesson Part</label></td>
                                        <td colspan="2">
                                            <select name="part_number" id="" class="form-control">
                                            @foreach($part_numbers as $number)
                                                <option value="{{ $number }}">{{ $number }}</option>
                                            @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Question</label></td>
                                        <td colspan="2">
                                            <input type="text" name="question" class="form-control"  >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Default Mark</label></td>
                                        <td colspan="2">
                                            <input type="text" name="default_mark" class="form-control"  >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Description</label></td>
                                        <td colspan="2">
                                            <textarea name="description" class="form-control" ></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>
    {{--add modal end--}}
@stop
<!-- /page content -->

@section('page_js')
    <script>
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_port_number').val($(e.relatedTarget).data('port_number'));
            $('#modal_question').val($(e.relatedTarget).data('question'));
            $('#modal_default_mark').val($(e.relatedTarget).data('default_mark'));
            $('#modal_description').text($(e.relatedTarget).data('description'));
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