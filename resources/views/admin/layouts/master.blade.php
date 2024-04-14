<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
    <!-- Bootstrap -->
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
        <!-- iCheck -->
    <link href="{{ asset('admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
        <!-- JQVMap -->
    <link href="{{ asset('admin/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

        <!-- Datatables -->
    <link href="{{ asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/breadcrumb.css') }}" rel="stylesheet">

    <!-- custom css -->
    <link href="{{ asset('css/perasale_hms.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .loader {
            opacity: 0.7;
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url({{ asset('img/double_ring.svg') }}) 50% 50% no-repeat rgba(185, 243, 255, 0.19);
        }
    </style>

    @yield('page_css')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="nav-md">
<div class="loader"></div>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ url('dashboard') }}" class="site_title"><i class="fa fa-book"></i> <span>{{ setting('app_name', 'E-Learning') }}</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{ asset(Auth::user()->picture) }}" alt="user image" class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br/>
<?php
$user_type =  \Illuminate\Support\Facades\Auth::user()->user_type;
$teacher = \App\Libraries\Enumerations\UserTypes::$TEACHER;
$student = \App\Libraries\Enumerations\UserTypes::$STUDENT;
$admin = \App\Libraries\Enumerations\UserTypes::$ADMIN;

?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General Menu</h3>
                <ul class="nav side-menu">
                    <li class="{{Route::currentRouteName()=='dashboard' ? 'active' : ''}}"><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    @if($user_type == $admin)
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Teacher <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="{{Route::currentRouteName()=='teachers-list' ? 'active' : ''}}"><a href="{{Route('teachers-list')}}"><i class="fa fa-building-o"></i> Teachers </a></li>
                      </ul>
                 </li>
                    @endif
                    @if($user_type == $admin || $user_type == $teacher)
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Student <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @if($user_type == $admin)
                      <li class="{{Route::currentRouteName()=='students-list' ? 'active' : ''}}"><a href="{{Route('students-list')}}"><i class="fa fa-building-o"></i> Students </a></li>
                        @endif
                        @if($user_type == $teacher)
                      <li class="{{Route::currentRouteName()=='getTeacherStudentsListPage' ? 'active' : ''}}"><a href="{{Route('getTeacherStudentsListPage')}}"><i class="fa fa-building-o"></i> My Students </a></li>
                        @endif

                      </ul>
                 </li>
                    @endif
                    @if($user_type == $admin || $user_type == $teacher)
                 <li>
                      <a><i class="fa fa-building-o" aria-hidden="true"></i> Department <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="{{Route::currentRouteName()=='departments-list' ? 'active' : ''}}"><a href="{{Route('departments-list')}}"><i class="fa fa-list-alt" aria-hidden="true"></i> Departments </a></li>
                      </ul>
                 </li>
                    @endif
                 <li>
                      <a><i class="fa fa-columns"></i> Course <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      @if($user_type == $teacher || $user_type == $admin)
                      <li class="{{Route::currentRouteName()=='courses-list' ? 'active' : ''}}"><a href="{{Route('courses-list')}}"><i class="fa fa-list-alt"></i> Courses </a></li>
                      @endif
                      @if($user_type == $admin)
                          <li class="{{Route::currentRouteName()=='courses-listing-settings' ? 'active' : ''}}"><a href="{{ route('courses-listing-settings') }}"><i class="fa fa-building-o"></i> Courses List Setting </a></li>
                      @endif
                      @if($user_type == $teacher)
                      <li class="{{Route::currentRouteName()=='my-courses-list' ? 'active' : ''}}"><a href="{{Route('my-courses-list')}}"><i class="fa fa-list-alt"></i> My Courses </a></li>
                      @endif
                     @if($user_type == $student)
                      <li class="{{Route::currentRouteName()=='student-courses-list' ? 'active' : ''}}"><a href="{{Route('student-courses-list')}}"><i class="fa fa-list-alt"></i> Courses </a></li>
                      <li class="{{Route::currentRouteName()=='logged-student-courses-list' ? 'active' : ''}}"><a href="{{ route('logged-student-courses-list') }}"><i class="fa fa-list-alt"></i> My Courses </a></li>
                     @endif
                      </ul>
                 </li>
                    @if($user_type == $teacher)
                <li>
                    <a><i class="fa fa-file-text-o"></i> Course Lessons <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="{{Route::currentRouteName()=='course-lessons-list' ? 'active' : ''}}"><a href="{{Route('course-lessons-list')}}"><i class="fa fa-list-alt"></i> Lessons List </a></li>
                    </ul>
                </li>
                    @endif
                    @if($user_type == $teacher)
                <li>
                    <a><i class="fa fa-question"></i> Questions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li class="{{Route::currentRouteName()=='question-list' ? 'active' : ''}}"><a href="{{Route('question-list')}}"><i class="fa fa-question"></i> Questions List </a></li>
                        <li class="{{Route::currentRouteName()=='question-make' ? 'active' : ''}}"><a href="{{Route('question-make')}}"><i class="fa fa-plus"></i> Make Question File </a></li>
                        <li class="{{Route::currentRouteName()=='getAllQuestionFiles' ? 'active' : ''}}"><a href="{{Route('getAllQuestionFiles')}}"><i class="fa fa-list-alt"></i> Question File List</a></li>
                    </ul>
                </li>
                    @endif
                    @if($user_type == $teacher)
                <li>
                    <a><i class="fa fa-sticky-note"></i> Exam <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if($user_type == $teacher)
                        <li class="{{Route::currentRouteName()=='getExamListPage' ? 'active' : ''}}"><a href="{{ route('getExamListPage') }}"><i class="fa fa-building-o"></i> Exam List </a></li>
                        <li class="{{Route::currentRouteName()=='getExamCreatePage' ? 'active' : ''}}"><a href="{{ route('getExamCreatePage') }}"><i class="fa fa-building-o"></i> Exam Create </a></li>
                        <li class="{{Route::currentRouteName()=='getStudentExamSubmissionsByCourse' ? 'active' : ''}}"><a href="{{ route('getStudentExamSubmissionsByCourse') }}"><i class="fa fa-building-o"></i> Student Exams </a></li>
                        @endif
                    </ul>
                </li>
                    @endif

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            {{-- <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
                  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
              </div>
              <!-- /menu footer buttons --> --}}
            </div>
          </div>
  
          <livewire:layout.navigation />

         @yield('content')
        <!-- footer content -->
        <footer>
            <div class="pull-right">
              E-Learning
            </div>
            <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
        </div>
      </div>
  
      
<!-- jQuery -->
<script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }} "></script>

<!-- Bootstrap -->
<script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.min.js') }} "></script>

<!-- FastClick -->
<script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }} "></script>
<!-- NProgress -->
<script src="{{ asset('admin/vendors/nprogress/nprogress.js') }} "></script>
<!-- Chart.js -->
<script src="{{ asset('admin/vendors/Chart.js/dist/Chart.min.js') }} "></script>
<!-- gauge.js -->
<script src="{{ asset('admin/vendors/gauge.js/dist/gauge.min.js') }} "></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }} "></script>
<!-- iCheck -->
<script src="{{ asset('admin/vendors/iCheck/icheck.min.js') }} "></script>
<!-- Skycons -->
<script src="{{ asset('admin/vendors/skycons/skycons.js') }} "></script>
<!-- Flot -->
<script src="{{ asset('admin/vendors/Flot/jquery.flot.js') }} "></script>
<script src="{{ asset('admin/vendors/Flot/jquery.flot.pie.js') }} "></script>
<script src="{{ asset('admin/vendors/Flot/jquery.flot.time.js') }} "></script>
<script src="{{ asset('admin/vendors/Flot/jquery.flot.stack.js') }} "></script>
<script src="{{ asset('admin/vendors/Flot/jquery.flot.resize.js') }} "></script>
<!-- Flot plugins -->
<script src="{{ asset('admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }} "></script>
<script src="{{ asset('admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }} "></script>
<script src="{{ asset('admin/vendors/flot.curvedlines/curvedLines.js') }} "></script>
<!-- DateJS -->
<script src="{{ asset('admin/vendors/DateJS/build/date.js') }} "></script>
<!-- JQVMap -->
<script src="{{ asset('admin/vendors/jqvmap/dist/jquery.vmap.js') }} "></script>
<script src="{{ asset('admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }} "></script>
<script src="{{ asset('admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }} "></script>
<script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }} "></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('admin/vendors/moment/min/moment.min.js') }} "></script>
{{--<script src="{{ asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }} "></script>--}}
<!-- Datatables -->
<script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }} "></script>
{{--<script src="{{ asset('https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js') }} "></script>--}}
<script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }} "></script>
<script src="{{ asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }} "></script>

<script src="{{ asset('admin/vendors/jszip/dist/jszip.min.js') }} "></script>
<script src="{{ asset('admin/vendors/pdfmake/build/pdfmake.min.js') }} "></script>
<script src="{{ asset('admin/vendors/pdfmake/build/vfs_fonts.js') }} "></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('admin/build/js/custom.min.js') }} "></script>

<script src="{{ asset('js/sweetalert2.js') }}"></script>

<!-- Include this after the sweet alert js file -->
<script>
    $(document).ready(function () {
        var hasSuccessMessage = '{{ \Session::has('Success Message') ? 1 : 0 }}';
        var hasErrorMessage = '{{ \Session::has('Error Message') ? 1 : 0 }}';
            if(hasSuccessMessage == 1){
                swal({
                    title: 'Success!',
                    text: '{{ \Session::get('Success Message') }}',
                    type: 'success',
                    timer: 2000
                }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                )
            }else if(hasErrorMessage == 1){
                swal({
                    title: 'Error!',
                    text: '{{ \Session::get('Error Message') }}',
                    type: 'error',
                    timer: 2000
                }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                )
            }
    });
    $('a.delete').on('click', function(){
      var confirm = false;
      var url = $(this).attr('href');
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function() {
        window.location.replace(url);
      });
      return confirm;
    });

    $(window).load(function() {
        $(".loader").fadeOut("slow");
    })

</script>

  
  
  
    @yield('page_js');
</body>
</html>