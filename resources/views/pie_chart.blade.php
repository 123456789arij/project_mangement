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
