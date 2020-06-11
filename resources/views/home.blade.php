@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        a:link {
            text-decoration: none;
        }

        .project_task {
            color: #191966;
            font-size: 18px;
        }


        .rounded-pill {
            background-color: #ffebe6;
            color: red;
            font-size: 13px;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div>Dashboard
                </div>
            </div>
        </div>
    </div>

    {{--count col--}}
    @if(auth()->user()&& auth()->user()->role_id == 1)
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <a href="{{route('client.index')}}">
                                        <i class="fas fa-user-tie icon-gradient bg-plum-plate" style="font-size: 50px;">
                                        </i>

                                    </a>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('client.index')}}" class="widget-heading text-secondary">
                                    {{ __('messages.total_clients') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('client.index')}}" class="widget-numbers text-secondary">
                                    {{$userCount}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('employee.index')}}" class="widget-content-left">
                                    <i class="fas fa-users icon-gradient bg-mean-fruit" style="font-size: 50px;">
                                    </i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('employee.index')}}" class="widget-heading text-secondary">
                                    {{ __('messages.total_Employees') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('employee.index')}}" class="widget-numbers text-secondary">
                                    {{$employeesCount}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('project')}}" class="widget-content-left">
                                    <i class='metismenu-icon fas fa-layer-group' style="font-size: 50px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('project')}}" class="widget-heading  text-secondary">
                                    {{ __('messages.Total_Projects') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('project')}}" class="widget-numbers text-secondary">
                                    {{$projectsCount}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        2éme row--}}
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('task')}}" class="widget-content-left">
                                    <i class='fas fa-tasks icon-gradient bg-ripe-malin' style='font-size:36px'></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('task')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Total_Tasks') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('task')}}" class="widget-numbers text-secondary">
                                    {{$tasksCount}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('task')}}" class="widget-content-left">
                                    <i class="fas fa-exclamation-triangle icon-gradient bg-sunny-morning"
                                       style="font-size:40px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('task')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Pending_task') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('task')}}" class="widget-numbers text-secondary">
                                    {{$tasksPadaing}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('task')}}" class="widget-content-left">
                                    <i class="fa fa-check-square-o icon-gradient bg-grow-early"
                                       style="font-size:40px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('task')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Completed_task') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('task')}}" class="widget-numbers text-secondary">
                                    {{$tasksCompleted}}
                                </a>
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
                                <a href="{{route('employee.task')}}" class="widget-content-left">
                                    <i class='fas fa-tasks icon-gradient bg-ripe-malin' style='font-size:36px'></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('employee.task')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Total_Tasks') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('employee.task')}}" class="widget-numbers text-secondary">
                                    {{$tasks}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('employee.task')}}" class="widget-content-left">
                                    <i class="fas fa-exclamation-triangle icon-gradient bg-sunny-morning"
                                       style="font-size:40px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('employee.task')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Pending_task') }}
                                </a>
                            </div>
                            &nbsp; &nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('employee.task')}}" class="widget-numbers text-secondary">
                                    {{$taskscount}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('employee.task')}}" class="widget-content-left">
                                    <i class="fa fa-check-square-o icon-gradient bg-grow-early"
                                       style="font-size:40px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('employee.task')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Completed_task') }}
                                </a>
                            </div>
                            &nbsp; &nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('employee.task')}}" class="widget-numbers text-secondary">
                                    {{ $projects}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--2éme ligne--}}
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('employee.project')}}" class="widget-content-left">
                                    <i class='metismenu-icon fas fa-layer-group' style="font-size: 50px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('employee.project')}}" class="widget-heading  text-secondary">
                                    {{ __('messages.Total_Projects') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('employee.project')}}" class="widget-numbers text-secondary">
                                    {{$projects}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--/2éme ligne--}}

        {{-- employee tasks --}}
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">{{ __('messages.tasks') }}</div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('messages.title') }}</th>
                                <th scope="col">{{ __('messages.due date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0 ?>   @foreach($task_home->take(9) as $task)
                                <?php $i++ ?>
                                <tr class="container">
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    {{ $i}}.
                                                    <a href="{{route('employee.task')}}"
                                                       class="widget-heading">{{ $task->title}}</a>
                                                    <a href="{{route('employee.project')}}"
                                                       class="project_task"> {{ $task->project->name}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rounded-pill">
                                            {{$task->end_date }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="table-responsive"></div>
                </div>
            </div>
        </div>
        {{--/employee tasks--}}
    @endif
    {{--/count coll of employee     --}}

    {{-- count coll of client--}}
    @if(auth()->guard('client')->user())
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('client.project')}}" class="widget-content-left">
                                    <i class='metismenu-icon fas fa-layer-group' style="font-size: 50px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('client.project')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Total_Projects') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('client.project')}}" class="widget-numbers text-secondary">
                                    {{$projects_client_count}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('client.project')}}" class="widget-content-left">
                                    <i class="fa fa-check-square-o icon-gradient bg-grow-early"
                                       style="font-size:40px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('client.project')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Completed_project') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('client.project')}}" class="widget-numbers text-secondary">
                                    {{$projects_completed_client_count }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <a href="{{route('client.project')}}" class="widget-content-left">
                                    <i class="fas fa-exclamation-triangle icon-gradient bg-sunny-morning"
                                       style="font-size:40px;"></i>
                                </a>
                            </div>
                            <div class="widget-content-left">
                                <a href="{{route('client.project')}}" class="widget-heading text-secondary">
                                    {{ __('messages.Pending_project') }}
                                </a>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="widget-content-right">
                                <a href="{{route('client.project')}}" class="widget-numbers text-secondary">
                                    {{ $projects_Pending_client_count }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--project date --}}
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">{{ __('messages.projects') }}</div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('messages.title') }}</th>
                                <th scope="col">{{ __('messages.due date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0 ?>   @foreach($projects_client->take(9) as $project)
                                <?php $i++ ?>
                                <tr class="container">
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    {{ $i}}.
                                                    <a href="{{route('client.project')}}"
                                                       class="widget-heading">{{ $project->name}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rounded-pill">
                                            {{$project->deadline }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--/project date--}}

        {{-- place for diagramme --}}
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Satistique of project status
                    </div>
                    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                </div>
            </div>
        </div>
        {{--/place for diagramme --}}

    @endif
    {{--/count coll of client--}}


    {{--graph donuts--}}
    @if(auth()->user() && auth()->user()->role_id == 1)
        {{-- place for diagramme --}}
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Satistique of project status
                    </div>
                    <div id="donut" style="width: 1000px; height: 400px;"></div>

                </div>
            </div>
        </div>
        {{--/place for diagramme --}}
    @endif
    @if(auth()->user()&& auth()->user()->role_id == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                            Satistique of task status
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-eg-77">
                                <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                    <div class="widget-chat-wrapper-outer">
                                        <div
                                            class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">

                                            <div id="piechart_3d" style="width: 700px; height: 400px;"></div>

                                        </div>
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
                            <th scope="col">{{ __('messages.tasks') }}</th>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-eg-55">
                            <div class="widget-chart p-3">
                                <div style="height: 700px">
                                    <table class="align-middle mb-0 table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{ __('messages.title') }}</th>
                                            <th scope="col" class="pull-right">{{ __('messages.due date') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0 ?>  @foreach($homeTask->take(9)  as $task)
                                            <?php $i++ ?>
                                            <tr class="container">
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left flex2">
                                                                {{ $i}}.
                                                                <a href="{{route('task')}}"
                                                                   class="widget-heading">{{ $task->title}}</a>
                                                                <a href="{{route('project')}}"
                                                                   class="project_task"> {{ $task->project->name}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="rounded-pill">
                                                        {{$task->end_date }}
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--                                        <footer class="card-footer-tab card-footer" style="float: right">--}}
                                    {{--                                            {{ $homeTask->links() }}--}}
                                    {{--                                        </footer>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            client feedback--}}
            {{-- <div class="col-md-12 col-lg-6">
                 <div class="mb-3 card">
                     <div class="card-header-tab card-header">
                         <div class="card-header-title">
                             <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                             <th scope="col">{{ __('messages.feedback') }}  {{ __('messages.clients') }} </th>
                         </div>
                     </div>
                     <div class="tab-content">
                         <div class="tab-pane fade active show" id="tab-eg-55">
                             <div class="widget-chart p-3">
                                 <div style="height: 700px">
                                     @foreach($feeds as $feed)
                                         <div class="display-comment">
                                             --}}{{--  <div style="display:inline-block">
                                                   <img src="{{asset($comment->employee->image)}}" data-toggle="tooltip"
                                                        data-original-title="{{ $comment->employee->name}}"
                                                        class="rounded-circle"
                                                        height="42px" width="42px" alt="employee"/>
                                               </div>--}}{{--
                                             &nbsp;&nbsp; <strong class="text-justify">{{$feed->client->name}}</strong>
                                             <small class="text-muted ml-3"
                                                    style="float: right">{{ $feed->created_at->toDateString()}}</small>
                                             <br>
                                             <div  class="container" style="border: 1px solid darkgray;border-radius: 12px; padding: 5px;">
                                                 <p class="text-justify">{{$feed->body }}</p>
                                                 --}}{{--                                            <p>{{ $feedback->star }}</p>--}}{{--
                                             </div>
                                         </div>
                                         <br>
                                         <div tabindex="-1" class="dropdown-divider"></div>
                                     @endforeach

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>--}}
            {{-- /client feedback--}}

        </div>
    @endif
    {{--/graph--}}




@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages': ['corechart']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            $.ajax({
                url: '/donut_chart',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var analytics = (response.data);
                    var data = google.visualization.arrayToDataTable(analytics);
                    var options = {
                        title: 'Percentage of status Project',
                        pieHole: 0.4,
                        chartArea: {left: 250},
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('donut'));
                    chart.draw(data, options);
                }
            });
        }
    </script>

    {{--client chart--}}
    <script>
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            $.ajax({
                url: '{{route('clientChart')}}',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var analytics = (response.data);
                    var data = google.visualization.arrayToDataTable(analytics);
                    var options = {
                        chart: {
                            title: 'Company Performance',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        }
                    };
                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            });
        }
    </script>

    <script>
        google.charts.load('current', {'packages': ['corechart']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            $.ajax({
                url: '/laravel_google_chart',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var analytics = (response.data);
                    var data = google.visualization.arrayToDataTable(analytics);
                    var options = {
                        title: 'Percentage of status task',
                        is3D: true,
                        chartArea: {left: 340},
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            });
        }
    </script>
@endsection
