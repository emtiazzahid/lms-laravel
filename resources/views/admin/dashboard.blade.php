@extends('admin.layouts.master')
@section('title', 'E-Learning | HOME')
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="row top_tiles">

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="count">0</div>
                <h3>Teachers</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="count">0</div>
                <h3>Students</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count">0</div>
                <h3>Courses</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">0</div>
                <h3>Certified Students</h3>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Events<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{--@foreach($events as $event)--}}
                        <article class="media event">
                            <a class="pull-left date">
{{--                                <p class="month">{{ date("F", strtotime($event->start_time)) }}</p>--}}
{{--                                <p class="day">{{ date( 'd', strtotime( $event->start_time)) }}</p>--}}
                            </a>
                            <div class="media-body">
                                {{--<a class="title" href="#">{{ $event->title }}</a>--}}
{{--                                <p>{{ $event->description }}</p>--}}
                            </div>
                        </article>
                    {{--@endforeach--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@stop
@section('page_js')

@stop