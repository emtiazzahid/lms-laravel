
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General Menu</h3>
                <ul class="nav side-menu">
                    <li class="{{Route::currentRouteName()=='dashboard' ? 'active' : ''}}"><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                 <li>
                      <a><i class="fa fa-hospital-o"></i> Teacher <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="{{Route::currentRouteName()=='teacher_list' ? 'active' : ''}}"><a href="{{Route('teacher_list')}}"><i class="fa fa-building-o"></i> Teachers </a></li>
                      </ul>
                 </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

@include('admin.layouts.top_nav')