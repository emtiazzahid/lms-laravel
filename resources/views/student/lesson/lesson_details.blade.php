@extends('admin.layouts.master')
@section('title', 'E-Learning')
@section('page_css')
    <style>
        .max-three-line-p{
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@stop
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Breadcrumbs::render('getStudentCourseLessonDetails',$teacherCourseId , $lesson_id) !!}
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
                    <h2>Lesson - {{ $teacher_lesson->number }} Details</h2>
                    @if(Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$TEACHER)
                    <a href="{{ route('getLessonDetailsForEdit',['id'=>$lesson_id]) }}" class="pull-right btn btn-info btn-sm">
                        <i class="fa fa-pencil"></i> Edit Lesson Details - {{ $teacher_lesson->number }}
                    </a>
                    @endif
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Video Sources <small>Youtube</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <ul class="list-unstyled timeline">
                                    @foreach($lesson_videos as $lesson_video)
                                    <li>
                                        <div class="block">
                                            <div class="tags">
                                                <a href="" class="tag">
                                                    <span>{{ $lesson_video->part_number }}</span>
                                                </a>
                                            </div>
                                            <div class="block_content">
                                                <h2 class="title">
                                                    <a>{{ $lesson_video->video_title }}</a>
                                                </h2>
                                                <div class="byline">
                                                    <span>{{ $lesson_video->created_at }}</span> by <a>{{ $teacher_info->name }}</a>
                                                </div>
                                                <p class="excerpt max-three-line-p">{{ $lesson_video->description }}</a>
                                                </p>
                                                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#videoModal" data-theVideo="{{ $lesson_video->video_embed_url }}">Watch</a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Document Sources </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <ul class="list-unstyled timeline">
                                    @foreach($lesson_files as $lesson_file)
                                        <li>
                                            <div class="block">
                                                <div class="tags">
                                                    <a href="" class="tag">
                                                        <span>{{ $lesson_file->part_number }}</span>
                                                    </a>
                                                </div>
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>{{ $lesson_file->file_title }}</a>
                                                    </h2>
                                                    <div class="byline">
                                                        <span>{{ $lesson_file->created_at }}</span> by <a>{{ $teacher_info->name }}</a>
                                                    </div>
                                                    <p class="excerpt max-three-line-p">{{ $lesson_file->description }}</a>
                                                    </p>
                                                    <a href="{{ $lesson_file->file_url }}" class="btn btn-default" target="_blank">Read</a>
                                                    <a href="{{ $lesson_file->file_url }}" class="btn btn-info dtn-flat" download="{{ $lesson_file->file_title }}">Download</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- /page content -->
{{--Youtube Video Watch Modal--}}
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div>
                        <iframe width="100%" height="350" src=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page_js')
    <script>
        autoPlayYouTubeModal();

        //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
        function autoPlayYouTubeModal() {
            var trigger = $("body").find('[data-toggle="modal"]');
            trigger.click(function () {
                var theModal = $(this).data("target"),
                        videoSRC = $(this).attr("data-theVideo"),
                        videoSRCauto = videoSRC + "?autoplay=1";
                $(theModal + ' iframe').attr('src', videoSRCauto);
                $(theModal + ' button.close').click(function () {
                    $(theModal + ' iframe').attr('src', videoSRC);
                });
            });
        }
    </script>
@stop