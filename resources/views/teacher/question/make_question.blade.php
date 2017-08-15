@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('page_css')
        <!-- Select2 -->
<link href="{{ url('admin/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@stop
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
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
                    <div class="col-md-8 col-md-offset-2">
                        <form method="post" action="{{ route('post-question-make') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Course :</label>
                                <select name="course" id="course_id" class="select2_single form-control">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Lessons</label>
                                    <select class="select2_multiple form-control" multiple="multiple" name="lesson[]" id="lesson_id">
                                        <option>Choose option</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Parts</label>
                                    <select class="select2_multiple form-control" multiple="multiple" name="part[]" id="part">
                                        <option>Choose option</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Show</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- /page content -->

@stop
@section('page_js')
        <!-- Select2 -->
<script src="{{ url('admin/vendors/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "Select a option",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            placeholder: "Select options",
            allowClear: true
        });
    });
</script>
<!-- /Select2 -->
{{--getting lessons--}}
<script>
    $(function () {
        $("#course_id").on('change', function () {
            $('#lesson_id').empty();
            $('#part').empty();
            var course_id = $('#course_id').val();
            var url = '{{ route('getLessonsByCourseId') }}';
            var token = '{{ Session::token() }}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {_token: token, course_id: course_id},
                success: function (data) {
//                    $('#lesson_id').append('<option value="">-- Select One --</option>');
                    if (data != null && data != '') {
                        var i;
                        for (i = 1; i <= data.length; i++) {
                            $('#lesson_id').append('<option value="' + data[i - 1]['id'] + '">' + data[i - 1]['title'] + '</option>')
                        }
                        setCheckBoxListener();
                    }
                },
            });
        });
    });
    function  setCheckBoxListener() {
        $("#lesson_id").change(function () {
            var checkedValues = $('#lesson_id input:select:selected').map(function() {
                return this.value;
            }).get();
            $('#part').empty();
            if(checkedValues.length > 0){
                var url = '{{ route('getPartsByLessonIds') }}';
                var token = '{{ Session::token() }}';
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {_token: token, lessons: checkedValues},
                    success: function (data) {

                        if (data != null && data != '') {
                            var i;
                            for (i = 1; i <= data.length; i++) {
                                $('#part').append('<option value="' + data[i - 1] + '">' + data[i - 1] + '</option>')
//                                $('#part').append('<div class="col-md-2 checkbox"> <label><input type="checkbox" name="topics[]" value="' + data[i - 1]['id'] + '">' + data[i - 1]['name'] + '</label></div>')
                            }
                        }

                    },
                });
                console.log(checkedValues);
            }
        });
    }

</script>
{{--getting parts--}}
<script>
    $(function () {
        $("#lesson_id").on('change', function () {
            $('#part').empty();
            var lesson_id = $('#lesson_id').val();
            var url = '{{ route('getPartsByLessonId') }}';
            var token = '{{ Session::token() }}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {_token: token, lesson_id: lesson_id},
                success: function (data) {
//                    $('#part').append('<option value="">-- Select One --</option>');
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