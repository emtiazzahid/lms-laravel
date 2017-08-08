
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>{{ trans('file.General Menu')}}</h3>
                <ul class="nav side-menu">
                    <li class="{{Route::currentRouteName()=='dashboard' ? 'active' : ''}}"><a href="{{ Route('dashboard') }}"><i class="fa fa-home"></i> {{ trans('file.Dashboard')}}</a></li>
                 <li>
                      <a><i class="fa fa-hospital-o"></i> {{ trans('file.Hospital')}} <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li class="{{Route::currentRouteName()=='department-list' ? 'active' : ''}}"><a href="{{Route('department-list')}}"><i class="fa fa-building-o"></i> {{ trans('file.Department')}} </a></li>
                      <li class="{{Route::currentRouteName()=='speciality-list' ? 'active' : ''}}"><a href="{{Route('speciality-list')}}"><i class="fa fa-building-o"></i> {{ trans('file.Speciality')}} </a></li>
                      </ul>
                 </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

@include('admin.layouts.top_nav')