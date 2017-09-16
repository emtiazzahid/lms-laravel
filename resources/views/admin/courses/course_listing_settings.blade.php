@extends('admin.layouts.master')

@section('title', 'Courses Listing Settings')

<!-- page content -->
@section('content')

    <div class="right_col" role="main">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                {!! Breadcrumbs::render('listing_settings') !!}
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
                    <!-- {!! Breadcrumbs::render('courses') !!} -->
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Trending Courses List</h2>
                        <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i>Add Trending Course
                        </button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(count($trendingCourses)<1)
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Data Found.
                            </div>
                        @else
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Added at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trendingCourses as $trendingCourse)
                                <tr>
                                    <td><strong>{{ ++$index }}</strong></td>
                                    <td>{{ $trendingCourse->course_title }}</td>
                                    <td>{{ $trendingCourse->created_at }}</td>
                                    <td class="text-center">
                                      <a href="{{route('trending-courses-delete', ['id'=>$trendingCourse->id])}}" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Info</h4>
                    </div>
                    <form action="{{ route('trending-courses-add') }}" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Course</label></td>
                                        <td colspan="2">
                                            <select name="course" required class="form-control">
                                                @foreach($teacherCourses as $teacherCourse)
                                                    <option value="{{ $teacherCourse->id }}">{{ $teacherCourse->course->title }} - {{ $teacherCourse->teacher->user->name }}</option>
                                                @endforeach
                                            </select>
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