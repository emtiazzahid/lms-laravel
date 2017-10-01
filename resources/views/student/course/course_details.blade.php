@extends('admin.layouts.master')
@section('title', 'E-Learning | Course Details')
@section('page_css')
    <link href="{{ url('admin/vendors/star-rating/css/star-rating.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ url('admin/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ url('admin/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
@stop
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>E-learning :: Course Details</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('student-course-details',$teacherCourseId) !!}

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course - {{ $teacherCourse->course->title }} Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="product-image">
                                <img src="{{ url($teacherCourse->course->featured_image) }}" alt="..." />
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title">{{ $teacherCourse->course->title }}</h3>

                            <p> {{ $teacherCourse->course->featured_text }} </p>
                            <br />

                            <div class="">
                                <h2>Available Lessons</h2>
                                <ul class="list-inline prod_size">
                                    @foreach($teacherCourseLessons as $lesson)
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">{{ $lesson->title }}</button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <br />

                            <div class="">
                                <div class="product_price">
                                    <h1 class="price">Teacher/Author : {{ $teacherCourse->teacher->user->name }}</h1>
                                    <input type="hidden" id="teacher_id"  value="{{ $teacherCourse->teacher->user->id }}">
                                    <span class="price-tax">user since {!! \App\Libraries\TimeStampToAgoHelper::time_elapsed_string($teacherCourse->teacher->user->created_at) !!}</span>
                                    <br>
                                    <input id="input-id" type="text" class="rating" data-size="lg" >
                                    {{--<button type="button" class="btn btn-primary btn-xs">--}}
                                    {{--<i class="fa fa-user"> </i> View Profile--}}
                                    {{--</button>--}}
                                </div>
                                <br>
                            </div>


                            <div class="col-md-12">
                                @if($courseTaken)
                                    @if($studentCourseTaken->status == \App\Libraries\Enumerations\CourseStudentStatus::$INCOMPLETE)
                                <a href="{{ route('getCourseLessonsForStudent',['teacher_course_id'=>$teacherCourse->id]) }}" class="btn btn-default btn-lg">Continue Study</a>
                                <a href="{{ route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]) }}" class="btn btn-default btn-lg">Exams</a>
                                    @elseif($studentCourseTaken->status == \App\Libraries\Enumerations\CourseStudentStatus::$COMPLETED)
                                        @if($certificate)
                                            <a target="_blank" class="btn btn-primary btn-flat btn-sm" href="{{ asset($certificate->file_path) }}">Download Certificate</a>
                                        @else
                                            Sorry Certificate File Not Found. Please Contact With Course Author.
                                        @endif
                                    @endif
                                @else
                                <a href="{{ route('student-course-enroll',['teacher_course_id'=>$teacherCourse->id]) }}" class="btn btn-default btn-lg">Enroll Now</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@stop
@section('page_js')
    <script src="{{ url('admin/vendors/star-rating/js/star-rating.min.js') }} "></script>
    <script src="{{ url('admin/vendors/pnotify/dist/pnotify.js') }} "></script>
    <script src="{{ url('admin/vendors/pnotify/dist/pnotify.buttons.js') }} "></script>
    <script>
        // initialize with defaults
        $("#input-id").rating(
                {min:1, max:100, step:1, size:'lg'}
        );
        $('.filled-stars').css("width", "{{ (int) $avgPoint }}%");
        $('#input-id').on('change',function(){
            @if(\Illuminate\Support\Facades\Auth::user()->user_type != \App\Libraries\Enumerations\UserTypes::$STUDENT)
                alert('sorry! rating can be update by an student');
                return false;
            @endif
            var point =  parseInt($('.filled-stars')[0].style.width, 10);
            point += 1;
            if (point > 100){
                point = 100;
            }
            var ratingUpdateUrl = '{{ route('updateTeacherRating') }}';
            var teacherId = $('#teacher_id').val();
            var token = '{{ csrf_token() }}';
            $.ajax({
                url: ratingUpdateUrl,
                type: 'POST',
                data: {_token:token,teacherId:teacherId,point:point},
                success: function (result) {
                    if (result == 'success'){
                        new PNotify({
                            title: 'Rating Updated Success',
                            text: 'This Rating Calculated From Average Rating Submissions From Students !',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }else{
                        new PNotify({
                            title: 'Sorry! Something Wrong. Please Try Again',
                            text: 'We Are Working on it.',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                }
            });
        });
    </script>
@stop