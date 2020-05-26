@extends('layouts.base')
@section('cssBlock')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card container">
                <h3 align="center" style="margin-top:60px;">Percentage of status Project</h3><br/>
                <div class="panel panel-default">
                    <div class="panel-body" align="center">
                        <div id="piechart_3d" style="width: 1000px; height: 400px;"></div>
                    </div>
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
                url: '/donut_chart',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var analytics = (response.data);
                    var data = google.visualization.arrayToDataTable(analytics);
                    var options = {
                        title: 'Percentage of status Project',
                        pieHole: 0.4,
                        chartArea: {left: 240},
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            });
        }
    </script>
@endsection
