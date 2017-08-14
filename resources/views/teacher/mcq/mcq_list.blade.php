@extends('admin.layouts.master')

@section('title', 'Mcq List')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('lesson_mcqs',$lesson_id,$teacher_lesson->number) !!}
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
                            <h2>Lesson - {{ $teacher_lesson->title }} Mcq List</h2>
                            <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                                <i class="fa fa-plus"></i> Add Mcq
                            </button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @if(count($mcqs)<1)
                                <div class="alert alert-dismissible fade in alert-info" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Sorry !</strong> No Mcq Found.
                                </div>
                            @else
                                <?php $index = 0; ?>
                                <table class="table table-striped table-bordered dataTable no-footer" id="data2">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Lesson Part</th>
                                        <th>Mcq</th>
                                        <th>Mark</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mcqs as $mcq)
                                        <tr>
                                            <td><strong>{{ ++$index }}</strong></td>
                                            <td>{{ $mcq->part_number }}</td>
                                            <td>{{ $mcq->question }}</td>
                                            <td>{{ $mcq->default_mark }}</td>
                                            <td class="text-center">
                                                <button type="button"
                                                        data-id="{{ $mcq->id }}"
                                                        data-part_number="{{ $mcq->part_number }}"
                                                        data-question="{{ $mcq->question }}"
                                                        data-option_1="{{ $mcq->option_1 }}"
                                                        data-option_2="{{ $mcq->option_2 }}"
                                                        data-option_3="{{ $mcq->option_3 }}"
                                                        data-option_4="{{ $mcq->option_4 }}"
                                                        data-right_answer="{{ $mcq->right_answer }}"
                                                        data-description="{{ $mcq->description }}"
                                                        data-default_mark="{{ $mcq->default_mark }}"
                                                        data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>

                                                <a href="{{route('lesson-mcq-delete', ['id'=>$mcq->id])}}" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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
                    <form action="{{ route('lesson-mcq-update') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                                    <input type="hidden" name="modal_id" id="modal_id">
                                    <tr>
                                        <td colspan="2"><label>Select Lesson Part</label></td>
                                        <td colspan="2">
                                            <select name="part_number" id="" class="form-control" required>
                                                @foreach($part_numbers as $number)
                                                    <option value="{{ $number }}">{{ $number }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Mcq</label></td>
                                        <td colspan="2">
                                            <input type="text" name="question" class="form-control" id="modal_question"  required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 1</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_1" class="form-control" id="modal_option_1" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 2</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_2" class="form-control" id="modal_option_2"  required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 3</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_3" class="form-control"  id="modal_option_3">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 4</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_4" class="form-control"  id="modal_option_4">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Right Answer</label></td>
                                        <td colspan="2">
                                            <input type="radio" name="right_answer" value="1" >1
                                            <input type="radio" name="right_answer" value="2" >2
                                            <input type="radio" name="right_answer" value="3" >3
                                            <input type="radio" name="right_answer" value="4" >4
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><label>Default Mark</label></td>
                                        <td colspan="2">
                                            <input type="text" name="default_mark" class="form-control" id="modal_default_mark" required >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Description</label></td>
                                        <td colspan="2">
                                            <textarea name="description" class="form-control" id="modal_description"></textarea>
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
                    <form action="{{ route('lesson-mcq-add') }}" method="post">
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Select Lesson Part</label></td>
                                        <td colspan="2">
                                            <select name="part_number" id="" class="form-control" required>
                                            @foreach($part_numbers as $number)
                                                <option value="{{ $number }}">{{ $number }}</option>
                                            @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Mcq</label></td>
                                        <td colspan="2">
                                            <input type="text" name="question" class="form-control"  required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 1</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_1" class="form-control"  required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 2</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_2" class="form-control"  required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 3</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_3" class="form-control"  >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Option 4</label></td>
                                        <td colspan="2">
                                            <input type="text" name="option_4" class="form-control"  >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Right Answer</label></td>
                                        <td colspan="2">
                                            <input type="radio" name="right_answer" value="1" >1
                                            <input type="radio" name="right_answer" value="2" >2
                                            <input type="radio" name="right_answer" value="3" >3
                                            <input type="radio" name="right_answer" value="4" >4
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><label>Default Mark</label></td>
                                        <td colspan="2">
                                            <input type="text" name="default_mark" class="form-control" required >
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
            $('#modal_option_1').val($(e.relatedTarget).data('option_1'));
            $('#modal_option_2').val($(e.relatedTarget).data('option_2'));
            $('#modal_option_3').val($(e.relatedTarget).data('option_3'));
            $('#modal_option_4').val($(e.relatedTarget).data('option_4'));
            $('#modal_right_answer').val($(e.relatedTarget).data('right_answer'));
            $('#modal_default_mark').val($(e.relatedTarget).data('default_mark'));
            $('#modal_description').text($(e.relatedTarget).data('description'));
            var value = $(e.relatedTarget).data('right_answer');
            $("input[name=right_answer][value=" + value + "]").attr('checked', 'checked');
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