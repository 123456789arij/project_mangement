<div class="app-header-right">
    <div class="header-btn-lg pr-0">
        <div class="widget-content p-0">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="btn-group pull-left">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                            @if(auth()->guard('employee')->user())
                                <img width="42" class="rounded-circle"
                                     src="{{asset(auth()->guard('employee')->user()->image)}}"
                                     alt="">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            @endif
                            @if(auth()->user()&& auth()->user()->role_id == 1)
                                <img width="42" class="rounded-circle"
                                     src="{{asset(auth()->user()->logo)}}"
                                     alt="">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            @endif
                            @if(auth()->guard('client')->user())
                                <img width="42" class="rounded-circle"
                                     src="{{asset(auth()->guard('client')->user()->image)}}"
                                     alt="">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            @endif
                            @if(auth()->user()&& auth()->user()->role_id == 0)
                                <img width="42" class="rounded-circle"
                                     src="{{asset(auth()->user()->logo)}}"
                                     alt="image">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            @endif
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right"
                             style="width: 200px">
                            @if(auth()->guard('client')->user())
                                <h6 tabindex="-1" class="dropdown-item-text" style="background-color: DarkTurquoise">

                                    {{auth()->guard('client')->user()->name}}
                                </h6>
                                <a href="{{route('client.profile')}}" class="dropdown-item"
                                   style="font-size: 15px"><i
                                        class="fas fa-user-alt"> {{ __('messages.profileSettings') }}</i></a>
                            @endif
                            @if(auth()->user() && auth()->user()->role_id == 1)
                                <h6 tabindex="-1" class="dropdown-item-text" style="background-color: DarkTurquoise">

                                    {{auth()->user()->name}}
                                </h6>
                            @endif
                            @if(auth()->user() && auth()->user()->role_id ==  0)
                                <h6 tabindex="-1" class="dropdown-item-text" style="background-color: DarkTurquoise">
                                    {{auth()->user()->name}}
                                </h6>
                                <a href="{{route('super_admin.profile')}}" class="dropdown-item"
                                   style="font-size: 15px"><i
                                        class="fas fa-user-alt"> {{ __('messages.profileSettings') }}</i></a>
                            @endif
                            @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                <h6 tabindex="-1" class="dropdown-item-text" style="background-color: DarkTurquoise">
                                    {{auth()->guard('employee')->user()->name}}
                                </h6>
                            @endif
                            @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==1)
                                <h6 tabindex="-1" class="dropdown-item-text" style="background-color: DarkTurquoise">
                                    {{auth()->guard('employee')->user()->name}}
                                </h6>
                                <a href="{{route('employee.profile')}}" class="dropdown-item"
                                   style="font-size: 15px"><i
                                        class="fas fa-user-alt"> {{ __('messages.profileSettings') }}</i></a>
                            @endif

                            @if(auth()->user()&& auth()->user()->role_id == 1)
                                <h6 tabindex="-1" class="dropdown-header">

                                    {{--                                        <a href="{{route('user.edit',$user->id)}}">edit</a>--}}

                                    {{--  @if(auth()->guard('employee')->user())
                                          @foreach( $employee_profile as  $emp)
                                                  <a type="button" href="{{route('employee.profile.edit',$emp->id)}}"></a>
                                              @endforeach

                                      @endif--}}
                                </h6>
                            @endif
                            <div tabindex="-1" class="dropdown-divider"></div>
                            <button type="button" tabindex="0" class="dropdown-item" style="float: left">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off" style="font-size:18px;color: #48D1CC">
                                        {{ trans('messages.Logout') }}
                                        {{--   {{ __('Logout') }}--}}</i>
                                </a>

                                <form id="logout-form"
                                      action="{{auth()->guard("employee")->check()? route('employee.logout'):route('logout') }}"
                                      method="POST" style="display: none;font-size: 20px;">
                                    @csrf
                                </form>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="widget-content-left  ml-3 header-user-info pull-left">
                    <div class="widget-heading">
                        @if(auth()->guard('client')->user())
                            {{auth()->guard('client')->user()->name}}
                        @endif
                        @if(auth()->user()&& auth()->user()->role_id == 1)
                            {{auth()->user()->name }}
                        @endif
                        @if(auth()->user()&& auth()->user()->role_id == 0)
                            {{auth()->user()->name }}
                        @endif
                        @if(auth()->guard('employee')->user())
                            {{auth()->guard('employee')->user()->name}}
                        @endif
                    </div>
                    <div class="widget-subheading">
                        @if(auth()->guard('client')->user())
                            {{ __('messages.client') }}
                        @endif
                        @if(auth()->user()&& auth()->user()->role_id ==  1)
                            {{ __('messages.Company') }}
                        @endif
                        @if(auth()->user()&& auth()->user()->role_id ==  0)
                            {{ __('messages.superAdmin') }}
                        @endif
                        @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==1)
                            {{ __('messages.employee') }}
                        @endif
                        @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                            {{ __('messages.projectManager') }}
                        @endif

                    </div>
                </div>
                <div class="widget-content-right header-user-info ml-3">
                    <!-- lang app -->
                    <ul class="navbar-nav ml-auto pull-right visible-xs">
                        <!-- Authentication Links -->
                        @php $locale = session()->get('locale'); @endphp
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" v-pre>
                                @switch($locale)
                                    @case('fr')
                                    <img src="{{asset('fr.png')}}" width="30px" height="20x">
                                    @break
                                    @default
                                    <img src="{{asset('us.png')}}" width="30px" height="20x">
                                @endswitch
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('locale/en') }}">
                                    <img src="{{asset('us.png')}}" width="30px" height="20x">
                                    &nbsp; Anglais


                                </a>
                                <a class="dropdown-item" href="{{ url('locale/fr') }}">
                                    <img src="{{asset('fr.png')}}" width="30px" height="20x">
                                    &nbsp; français

                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- /lang app -->

                    {{--notification--}}
                    {{--   <button type="button" data-toggle="tooltip" title="notification" data-placement="bottom"
                               class="btn-shadow mr-3 btn btn-dark">
                           <i class="fas fa-bell" style="width: 25px"></i>
                       </button>--}}
                    {{--/notification--}}



                    {{--                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">--}}
                    {{--                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>--}}
                    {{--                    </button>--}}

                </div>

                {{--  <div class="widget-content-right header-user-info ml-3">
                      <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                          <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                      </button>
                  </div>--}}


            </div>
        </div>
    </div>
</div>
