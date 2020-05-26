@extends('layouts.base')
@section('cssBlock')
    <style>
        #transparent {
            background-color: white;
        }
    </style>
@endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Analytics Dashboard
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="btn-shadow dropdown-toggle btn btn-info">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-business-time fa-w-20"></i>
                                            </span>
                        Buttons
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>
                                                            Inbox
                                                        </span>
                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon lnr-book"></i>
                                    <span>
                                                            Book
                                                        </span>
                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon lnr-picture"></i>
                                    <span>
                                                            Picture
                                                        </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a disabled href="javascript:void(0);" class="nav-link disabled">
                                    <i class="nav-link-icon lnr-file-empty"></i>
                                    <span>
                                                            File Disabled
                                                        </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--count bare--}}
    @if(auth()->user())
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">{{ __('messages.Total_Tasks') }}</div>
                            <div class="widget-subheading">gggggggggg</div>
                        </div>
                        &nbsp;&nbsp;
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span> {{$tasksCount}}</span></div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Clients</div>
                        <div class="widget-subheading">Total Clients Profit</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>$ 568</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Followers</div>
                        <div class="widget-subheading">People Interested</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>46%</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{--/count bare--}}

    {{--graph--}}
    @if(auth()->user())
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Sales Report
                    </div>
                    <ul class="nav">
                        <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                        <li class="nav-item"><a href="javascript:void(0);"
                                                class="nav-link second-tab-toggle">Current</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabs-eg-77">
                            <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                        <canvas id="canvas"></canvas>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">Top
                                Authors</h6>
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container">
                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                             src="{{asset('assets/images/avatars/9.jpg')}}" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Ella-Rose Henry</div>
                                                        <div class="widget-subheading">Web Developer</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1">$</small>
                                                            <span>129</span>
                                                            <small class="text-danger pl-2">
                                                                <i class="fa fa-angle-down"></i>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                             src="{{asset('assets/images/avatars/5.jpg')}}" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Ruben Tillman</div>
                                                        <div class="widget-subheading">UI Designer</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1">$</small>
                                                            <span>54</span>
                                                            <small class="text-success pl-2">
                                                                <i class="fa fa-angle-up"></i>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                             src="{{asset('assets/images/avatars/4.jpg')}}" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Vinnie Wagstaff</div>
                                                        <div class="widget-subheading">Java Programmer</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1">$</small>
                                                            <span>429</span>
                                                            <small class="text-warning pl-2">
                                                                <i class="fa fa-dot-circle"></i>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                             src="{{asset('assets/images/avatars/3.jpg')}}" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Ella-Rose Henry</div>
                                                        <div class="widget-subheading">Web Developer</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1">$</small>
                                                            <span>129</span>
                                                            <small class="text-danger pl-2">
                                                                <i class="fa fa-angle-down"></i>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle"
                                                             src="{{asset('assets/images/avatars/2.jpg')}}" alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Ruben Tillman</div>
                                                        <div class="widget-subheading">UI Designer</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="font-size-xlg text-muted">
                                                            <small class="opacity-5 pr-1">$</small>
                                                            <span>54</span>
                                                            <small class="text-success pl-2">
                                                                <i class="fa fa-angle-up"></i>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                        Bandwidth Reports
                    </div>
                    <div class="btn-actions-pane-right">
                        <div class="nav">
                            <a href="javascript:void(0);"
                               class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab
                                1</a>
                            <a href="javascript:void(0);"
                               class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab
                                2</a>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">
                        <div class="widget-chart p-3">
                            <div style="height: 350px">
                                <canvas id="line-chart"></canvas>
                            </div>
                            <div class="widget-chart-content text-center mt-5">
                                <div class="widget-description mt-0 text-warning">
                                    <i class="fa fa-arrow-left"></i>
                                    <span class="pl-1">175.5%</span>
                                    <span class="text-muted opacity-8 pl-1">increased server resources</span>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-numbers fsize-3 text-muted">63%</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="text-muted opacity-6">Generated Leads</div>
                                                </div>
                                            </div>
                                            <div class="widget-progress-wrapper mt-1">
                                                <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 63%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-numbers fsize-3 text-muted">32%</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="text-muted opacity-6">Submitted Tickers</div>
                                                </div>
                                            </div>
                                            <div class="widget-progress-wrapper mt-1">
                                                <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 32%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-numbers fsize-3 text-muted">71%</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="text-muted opacity-6">Server Allocation</div>
                                                </div>
                                            </div>
                                            <div class="widget-progress-wrapper mt-1">
                                                <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                         aria-valuenow="71" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 71%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-numbers fsize-3 text-muted">41%</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="text-muted opacity-6">Generated Leads</div>
                                                </div>
                                            </div>
                                            <div class="widget-progress-wrapper mt-1">
                                                <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         aria-valuenow="41" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 41%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{--/graph--}}
    {{--count col--}}
    @if(auth()->user())
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img src="{{asset('home_user.png')}}" class="rounded-circle"
                                         height="40px" width="40px" alt="im"/>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.total_clients') }}</div>
                                <div style="background-color: white">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">{{$userCount}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.total_Employees') }}</div>
                                <div class="widget-subheading">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning">{{$employeesCount}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.Total_Projects') }}</div>
                                <div class="widget-subheading">People Interested</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger">{{$projectsCount}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Income</div>
                                <div class="widget-subheading">Expected totals</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-focus">$147</div>
                            </div>
                        </div>
                        <div class="widget-progress-wrapper">
                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54"
                                     aria-valuemin="0"
                                     aria-valuemax="100" style="width: 54%;"></div>
                            </div>
                            <div class="progress-sub-label">
                                <div class="sub-label-left">Expenses</div>
                                <div class="sub-label-right">100%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{--    /count coll--}}
    {{-- count coll of employee   --}}
    @if(auth()->guard('employee')->user())
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img src="{{asset('home_user.png')}}" class="rounded-circle"
                                         height="40px" width="40px" alt="im"/>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.Total_Tasks') }}</div>
                                <div style="background-color: white">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                               <div class="widget-numbers text-success">{{$tasks}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.Pending_task') }}</div>
                                <div class="widget-subheading">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                              <div class="widget-numbers text-warning">{{$taskscount}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.Completed_task') }}</div>
                                <div class="widget-subheading">People Interested</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">{{ $projects}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Income</div>
                                <div class="widget-subheading">Expected totals</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-focus">$147</div>
                            </div>
                        </div>
                        <div class="widget-progress-wrapper">
                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54"
                                     aria-valuemin="0"
                                     aria-valuemax="100" style="width: 54%;"></div>
                            </div>
                            <div class="progress-sub-label">
                                <div class="sub-label-left">Expenses</div>
                                <div class="sub-label-right">100%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        yes--}}
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img src="{{asset('home_user.png')}}" class="rounded-circle"
                                         height="40px" width="40px" alt="im"/>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">{{ __('messages.Total_Projects') }}</div>
                                <div style="background-color: white">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">{{$projects}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endif
    {{--/count coll of employee     --}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Active Users
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th class="text-center">City</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center text-muted">#345</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                     src="{{asset('assets/images/avatars/4.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">John Doe</div>
                                            <div class="widget-subheading opacity-7">Web Developer</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Madrid</td>
                            <td class="text-center">
                                <div class="badge badge-warning">Pending</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">#347</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                     src="{{asset('assets/images/avatars/3.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Ruben Tillman</div>
                                            <div class="widget-subheading opacity-7">Etiam sit amet orci eget</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Berlin</td>
                            <td class="text-center">
                                <div class="badge badge-success">Completed</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-2" class="btn btn-primary btn-sm">Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">#321</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                     src="{{asset('assets/images/avatars/2.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Elliot Huber</div>
                                            <div class="widget-subheading opacity-7">Lorem ipsum dolor sic</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">London</td>
                            <td class="text-center">
                                <div class="badge badge-danger">In Progress</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-3" class="btn btn-primary btn-sm">Details
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">#55</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                     src="{{asset('assets/images/avatars/1.jpg')}}" alt=""></div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Vinnie Wagstaff</div>
                                            <div class="widget-subheading opacity-7">UI Designer</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Amsterdam</td>
                            <td class="text-center">
                                <div class="badge badge-info">On Hold</div>
                            </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm">Details
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
