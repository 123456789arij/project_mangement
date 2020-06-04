<div class="app-sidebar__inner">
    <ul class="vertical-nav-menu">


        @if(auth()->user())
            <li>
                <a href="{{route('home')}}" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    {{ trans('messages.Dashboard') }}
                </a>
            </li>
            <li class="app-sidebar__heading">Clients</li>
            <li>
                <a href="{{route('client.index')}}">
                    <i class="metismenu-icon fas fa-user-tie"></i>
                    {{ trans('messages.clients') }}
                </a>
            </li>
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
                        <a href="{{route('employee.index')}}">
                            <i class="metismenu-icon">
                            </i> {{ trans('messages.employees') }}
                        </a>
                    </li>


                    <li>
                        <a href="{{route('department')}}">
                            <i class="metismenu-icon"></i>
                            {{ trans('messages.departments') }}
                        </a>
                    </li>


                </ul>
            </li>

            <li class="app-sidebar__heading">Travaille</li>
            <li>
                <a href="{{route('project')}}">
                    <i class='metismenu-icon fas fa-layer-group'></i>
                    {{ trans('messages.projects') }}
                </a>
            </li>
            <li>
                <a href="{{route('task')}}">
                    <i class="metismenu-icon fas fa-tasks"></i>
                    {{ trans('messages.tasks') }}
                </a>
            </li>
        @endif


        @if(auth()->guard('employee')->user())
            <li>
                <a href="{{route('employee.dashborad')}}" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    {{ trans('messages.Dashboard') }}
                </a>
            </li>

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
                                </i> {{ trans('messages.employees') }}
                            </a>
                        </li>

                    </ul>
                </li>


                        <li class="app-sidebar__heading">Travaille</li>
            <li>
                <a href="{{route('employee.project')}}">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    {{ trans('messages.projects') }}
                </a>
            </li>
            <li>
                <a href="{{route('employee.task')}}">
                    <i class="metismenu-icon fas fa-tasks"></i>
                    {{ trans('messages.tasks') }}
                </a>
            </li>

        @endif
        @if(auth()->guard('client')->user())
                <li>
                    <a href="{{route('client.dashborad')}}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        {{ trans('messages.Dashboard') }}
                    </a>
                </li>
            <li>
                <a href="{{route('client.project')}}">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    {{ trans('messages.projects') }}
                </a>
            </li>
                <li>
                    <a href="{{route('client.comment')}}">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        {{ trans('messages.comments') }}
                    </a>
                </li>

        @endif

            <li>
                <a href="{{route('calendar')}}">
                    <i class='metismenu-icon fas fa-calendar-week'></i>
                    {{ trans('messages.task_calendar') }}
                </a>
            </li>

        <li>
            <a href="{{route('event')}}">
                <i class="metismenu-icon fa fa-calendar" aria-hidden="true"></i>
                {{--                <i class="fa  fa-calendar pr-1 pl-1">--}}
                {{--                <i class="metismenu-icon pe-7s-eyedropper">--}}
                {{ trans('messages.events') }}
            </a>
        </li>
        @if(auth()->user())
        <li class="app-sidebar__heading">Charts</li>
        <li>
            <a href="{{route('pieChart')}}">
                <i class="metismenu-icon  fas fa-chart-pie"></i> Pie Chart
            </a>
        </li>
        <li>
            <a href="{{route('donut_chart')}}">
                <i class="metismenu-icon  fas fa-chart-pie"></i> Donut Chart
            </a>
        </li>

        <li class="app-sidebar__heading">Column Chart</li>
        <li>
            <a href="{{route('column_chart')}}" target="_blank">
                <i class="metismenu-icon pe-7s-graph2">
                </i>
                Column Chart
            </a>
        </li>
        @endif
    </ul>
</div>
