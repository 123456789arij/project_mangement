@extends('layouts.base')
@section('cssBlock')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <i class="metismenu-icon  fas fa-chart-pie"> </i>&nbsp;&nbsp;
                    {{ __('messages.TaskReport') }}
                </div>
                <div class="panel panel-default">
                    <div class="panel-body" align="center">
                        <div id="piechart_3d" style="width: 700px; height: 400px;"></div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('messages.tasks') }}</th>
                            <th scope="col">{{ __('messages.projects') }}</th>
                            <th scope="col">{{ __('messages.assigned to') }}</th>
                            <th scope="col">{{ __('messages.due date') }}</th>
                            <th scope="col">{{ __('messages.status') }}</th>
                            <th colspan="2">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach(  $taskindex  as  $task)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div>
                                                <div>
                                                    <a href="{{route('task.show',$task->id)}}">{{ $task->titre}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#">{{ $task->project->name}}</a></td>
                                <td>
                                    @foreach($task->employees as $employee)
                                        <div style="display:inline-block">
                                            <img src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                 data-original-title="{{$employee->name}}" class="rounded-circle"
                                                 height="30px" width="30px" alt="employee"/>
                                        </div>
                                    @endforeach
                                </td>

                                <td style="color: green;font-size: 15px;">
                                    {{$task->end_date }}
                                </td>

                                <td style="color: tomato;font-size: 15px;">
                                    @if($task->status === 1)
                                        <span class="badge badge-success"> {{ __('messages.Completed') }}</span>
                                    @elseif($task->status === 2)
                                        <span class="badge badge-danger"> {{ __('messages.Incomplete') }}</span>
                                    @else
                                        <span class="badge badge-info"> {{ __('messages.inProgress') }}</span>
                                    @endif
                                </td>


                                <td>

                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{route('task.edit',$task->id)}}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>

                                    <form action="{{route('task.destroy',$task->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                                            <i class="pe-7s-trash btn-icon-wrapper" style="font-size: 20px;"> </i>
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <footer class="card-footer" style="float: right">
                        {{ $taskindex->links() }}
                    </footer>
                </div>
            </div>
    </div>

@endsection
@section('jsBlock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
    <script src="https://www.gstatic.com/charts/loader.js"></script>

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
                        chartArea: {left: 240},
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            });
        }
    </script>
@endsection
