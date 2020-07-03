<div class="app-sidebar__inner">
    <ul class="vertical-nav-menu">


        @if(auth()->user()&& auth()->user()->role_id == 1)
            <li>
                <a href="{{route('home')}}" class="mm-active">
                    <i class="metismenu-icon fa fa-tachometer"></i>
                    <strong> {{ trans('messages.Dashboard') }}</strong>
                </a>
            </li>
            <li class="app-sidebar__heading">Clients</li>
            <li>
                <a href="{{route('client.index')}}">
                    <i class="metismenu-icon fas fa-user-tie"></i>
                    <strong>   {{ trans('messages.clients') }} </strong>
                </a>
            </li>


            <li class="app-sidebar__heading">HR</li>


            <li


            >
                <a href="">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    <strong> HR</strong>
                    <strong> <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></strong>
                </a>
                <ul


                >

                    <li>
                        <a href="{{route('employee.index')}}">
                            <i class="metismenu-icon">
                            </i> <strong>{{ trans('messages.employees') }}</strong>
                        </a>
                    </li>


                    <li>
                        <a href="{{route('department')}}">
                            <i class="metismenu-icon"></i>
                            <strong>   {{ trans('messages.departments') }} </strong>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="app-sidebar__heading">Travaille</li>
            <li>
                <a href="{{route('project')}}">
                    <i class='metismenu-icon fas fa-layer-group'></i>
                    <strong>   {{ trans('messages.projects') }}</strong>
                </a>
            </li>
            <li>
                <a href="{{route('task')}}">
                    <i class="metismenu-icon fas fa-tasks"></i>
                    <strong> {{ trans('messages.tasks') }}</strong>
                </a>
            </li>
        @endif


        @if(auth()->guard('employee')->user())
            <li>
                <a href="{{route('employee.dashborad')}}" class="mm-active">
                    <i class="metismenu-icon fa fa-tachometer"></i>
                    <strong> {{ trans('messages.Dashboard') }}</strong>
                </a>
            </li>
            @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                <li class="app-sidebar__heading">HR</li>


                <li


                >
                    <a href="">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        HR
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul


                    >

                        <li>
                            <a href="{{route('chef.employee.index')}}">
                                <i class="metismenu-icon">
                                </i> <strong>{{ trans('messages.employees') }}</strong>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif

            <li class="app-sidebar__heading"><strong> {{ trans('messages.work') }}</strong></li>
            <li>
                <a href="{{route('employee.project')}}">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    <strong> {{ trans('messages.projects') }}</strong>
                </a>
            </li>
            <li>
                <a href="{{route('employee.task')}}">
                    <i class="metismenu-icon fas fa-tasks"></i>
                    <strong>    {{ trans('messages.tasks') }}</strong>
                </a>
            </li>
            <li>
                <a href="{{route('calendar.task')}}">
                    <i class='metismenu-icon fas fa-calendar-week'></i>
                    <strong>   {{ trans('messages.task_calendar') }}</strong>
                </a>
            </li>
            <li class="app-sidebar__heading">Contact</li>
            <li>
                <a href="{{route('dashboard.discussions')}}">
                    <strong> <i class="metismenu-icon fa fa-envelope-o"></i>
                        {{ trans('messages.messages') }}</strong>
                </a>
            </li>


        @endif
        @if(auth()->guard('client')->user())
            <li>
                <a href="{{route('client.dashborad')}}" class="mm-active">
                    <i class="metismenu-icon fa fa-tachometer"></i>
                    {{--                    <i class="metismenu-icon fa-tachometer-alt"></i>--}}
                    {{ trans('messages.Dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{route('client.project')}}">
                    <i class='metismenu-icon fas fa-layer-group'></i>

                    {{ trans('messages.projects') }}
                </a>
            </li>
            <li>
                <a href="{{route('client.feedback')}}">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    {{ trans('messages.feedback') }}
                </a>
            </li>

        @endif
        @if(auth()->user()&& auth()->user()->role_id == 1)
            <li>
                <a href="{{route('calendar')}}">
                    <i class='metismenu-icon fas fa-calendar-week'></i>
                    <strong>   {{ trans('messages.task_calendar') }}</strong>
                </a>
            </li>
            <li class="app-sidebar__heading"><strong> {{ trans('messages.events') }} </strong></li>
            <li>
                <a href="{{route('event')}}">
                    <i class="metismenu-icon fa fa-calendar" aria-hidden="true"></i>
                    {{--                <i class="fa  fa-calendar pr-1 pl-1">--}}
                    {{--                <i class="metismenu-icon pe-7s-eyedropper">--}}
                    <strong>   {{ trans('messages.events') }}</strong>
                </a>
            </li>
        @endif
        @if(auth()->user()&& auth()->user()->role_id == 1)
            {{--  <li class="app-sidebar__heading">Charts</li>
              <li>
                  <a href="{{route('pieChart')}}">
                      <i class="metismenu-icon  fas fa-chart-pie"></i> Pie Chart
                  </a>
              </li>
              <li>
                  <a href="{{route('donut_chart')}}">
                      <i class="metismenu-icon  fas fa-chart-pie"></i> Donut Chart
                  </a>
              </li>--}}

            {{--        <li class="app-sidebar__heading">Column Chart</li>--}}
            {{--   <li>
                   <a href="{{route('column_chart')}}" target="_blank">
                       <i class="metismenu-icon pe-7s-graph2">
                       </i>
                       Column Chart
                   </a>
               </li>--}}
        @endif
    </ul>
</div>
