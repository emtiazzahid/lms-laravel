@extends('admin.layouts.master')

@section('title', 'Exam Create')

        <!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('getExamCreatePage') !!}

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
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Exam Create</h2>
                                        <a href="{{ route('getExamListPage') }}" class="pull-right btn btn-info btn-sm">
                                            <i class="fa fa-plus"></i> Exam List
                                        </a>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <form id="demo-form2" method="post" action="{{ route('saveExam') }}" data-parsley-validate class="form-horizontal form-label-left">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Exam Title <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="exam_title" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Course<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name="course" id="course_id" class="form-control">
                                                        <option value="0">Select an Course</option>
                                                        @foreach($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Question File<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name="question_file" id="question_file_id" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Syllabus
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea name="syllabus" id=""  rows="4"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Passing Score <span class="required">(%) *</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" name="passing_score" min="1" max="100" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Duration <span class="required">(hh:mm:ss) *</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="duration" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button class="btn btn-primary" type="button">Cancel</button>
                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

            </div>
        </div>

    </div>
    @stop
            <!-- /page content -->

@section('page_js')
    <script>
        $(function () {
            $("#course_id").on('change', function () {
                $('#question_file_id').empty().append('<option value="0">Select an Question</option>');
                var course = $('#course_id').val();
                var url = '{{ route('getQuestionFilesByCourse') }}';
                var token = '{{ Session::token() }}';
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {_token: token, course: course},
                    success: function (data) {
                        if (data != null && data != '') {
                            var i;
                            var questionType;
                            for (i = 1; i <= data.length; i++) {
                                if (data[i - 1]['question_type'] == {{ \App\Libraries\Enumerations\QuestionTypes::$MCQ }}){
                                    questionType = 'Mcq';
                                }else if (data[i - 1]['question_type'] == {{ \App\Libraries\Enumerations\QuestionTypes::$WRITTEN }}){
                                    questionType = 'Written';
                                }else
                                    questionType = 'Unknown Type'
                                $('#question_file_id').append('<option value="' + data[i - 1]['id'] + '">Question File - ' + data[i - 1]['id'] + ' ('+questionType+') </option>')
                            }
                        }
                    }
                });
            });
        });
    </script>
@stop