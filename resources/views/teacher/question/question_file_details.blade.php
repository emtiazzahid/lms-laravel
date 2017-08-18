@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2>Question File Details</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
                    <table class="table table-striped table-bordered dataTable no-footer" id="data">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Question</th>
                            @if($questionType == \App\Libraries\Enumerations\QuestionTypes::$MCQ)
                            <th>Options</th>
                            @endif
                            <th>Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $index = 0 @endphp
                        @foreach($questionBody as $question)
                            <tr>
                                <td><strong>{{ ++$index }}</strong></td>
                                <td>{{ $question->question }}</td>
                                @if($questionType == \App\Libraries\Enumerations\QuestionTypes::$MCQ)
                                <td>
                                    I. {{ $question->option_1 }}<br>
                                    II. {{ $question->option_2 }}<br>
                                    III. {{ $question->option_3 }}<br>
                                    IV. {{ $question->option_4 }}
                                </td>
                                @endif
                                <td>{{ $question->default_mark }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        </div>

    </div>
</div>
<!-- /page content -->

@stop

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