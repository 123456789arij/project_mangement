<div class="app-header-right">
    <div class="header-btn-lg pr-0">
        <div class="widget-content p-0">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="btn-group">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                            <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/1.jpg')}}"
                                 alt="">
                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                            <h6 tabindex="-1" class="dropdown-header">
                                @if(auth()->guard('client')->user())
                                    Client
                                @endif
                                @if(auth()->user())
                                    Entreprise
                                @endif
                                @if(auth()->guard('employee')->user())
                                    Employee
                                @endif


                            </h6>
                            {{--                            @if(auth()->guard('employee')->user())--}}
                            {{--                                @foreach($employees as $employee)--}}
                            {{--                                    <a href="{{route('employee.profile.edit',$employee->id)}}" type="button" tabindex="0"--}}
                            {{--                                       class="dropdown-item">User Account</a>--}}
                            {{--                                @endforeach--}}
                            {{--                            @endif--}}

                            {{--                            @if(auth()->guard('client')->user())--}}
                            {{--                                @foreach(   $clients as $client)--}}
                            {{--                                <a href="{{route('client.edit',$client->id)}}" type="button" tabindex="0" class="dropdown-item">User Account</a>--}}
                            {{--                                @endforeach--}}
                            {{--                            @endif--}}
                            <div tabindex="-1" class="dropdown-divider"></div>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fa pe-7s-power text-danger"
                                       style="width: 30px;font-size: 28px;"></i>&nbsp;
                                    {{ __('Logout') }}
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
                <div class="widget-content-left  ml-3 header-user-info">
                    <div class="widget-heading">
                        @if(auth()->guard('client')->user())
                            {{auth()->guard('client')->user()->name}}
                        @endif
                        @if(auth()->user())
                            {{auth()->user()->name }}
                        @endif
                            @if(auth()->guard('employee')->user())
                                {{auth()->guard('employee')->user()->name}}
                            @endif
                    </div>
                    <div class="widget-subheading">
                        @if(auth()->guard('client')->user())
                            Client
                        @endif
                            @if(auth()->user())
                               Entreprise
                            @endif
                            @if(auth()->guard('employee')->user())
                                Employee
                            @endif
                    </div>
                </div>
                <div class="widget-content-right header-user-info ml-3">

                    <button type="button" data-toggle="tooltip" title="notification" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                        <i class="fas fa-bell" style="width: 25px"></i>
                    </button>
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
