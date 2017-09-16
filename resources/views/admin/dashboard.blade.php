@extends('admin.layouts.master')
@section('title', 'E-Learning | HOME')
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
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
    <div class="row top_tiles">

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="count">{{ $totalTeachers or 0 }}</div>
                <h3>Teachers</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="count">{{ $totalStudents or 0 }}</div>
                <h3>Students</h3>
            </div>
        </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count">{{ $totalCourses or 0 }}</div>
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

</div>
<!-- /page content -->

@stop
@section('page_js')

@stop