@extends('admin.layouts.master')
@section('title', 'E-Learning | Student Courses')
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {!! Breadcrumbs::render('student_courses', $studentId) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Currently In Progress </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            @foreach($incompleteCourses as $iCourse)
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="{{ url($iCourse->teacher_course->course->featured_image) }}" alt="image" />
                                            <div class="mask">
                                                <p>{{ $iCourse->teacher_course->course->short_code }}</p>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <p>{{ $iCourse->teacher_course->course->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $incompleteCourses->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Completed Courses</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            @foreach($completedCourses as $cCourse)
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="{{ url($cCourse->teacher_course->course->featured_image) }}" alt="image" />
                                            <div class="mask">
                                                <p>{{ $cCourse->teacher_course->course->short_code }}</p>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <p>{{ $cCourse->teacher_course->course->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $completedCourses->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@stop