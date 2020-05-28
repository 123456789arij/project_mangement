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
                        <button id="change-chart">Change to Classic</button>
                        <br><br>
                        <div id="chart_div" style="width: 800px; height: 500px;"></div>
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
                url: '/columnChart',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var analytics = (response.data);
                    var data = google.visualization.arrayToDataTable(analytics);
                    var button = document.getElementById('change-chart');
                    var chartDiv = document.getElementById('chart_div');

                    var materialOptions = {
                        width: 900,
                        chart: {
                            title: 'Nearby galaxies',
                            subtitle: 'distance on the left, brightness on the right'
                        },
                        series: {
                            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
                            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
                        },
                        axes: {
                            y: {
                                distance: {label: 'parsecs'}, // Left y-axis.
                                brightness: {side: 'right', label: 'apparent magnitude'} // Right y-axis.
                            }
                        }
                    };

                    var classicOptions = {
                        width: 900,
                        series: {
                            0: {targetAxisIndex: 0},
                            1: {targetAxisIndex: 1}
                        },
                        title: 'Nearby galaxies - distance on the left, brightness on the right',
                        vAxes: {
                            // Adds titles to each axis.
                            0: {title: 'parsecs'},
                            1: {title: 'apparent magnitude'}
                        }
                    };

                    function drawMaterialChart() {
                        var materialChart = new google.charts.Bar(chartDiv);
                        materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
                        button.innerText = 'Change to Classic';
                        button.onclick = drawClassicChart;
                    }

                    function drawClassicChart() {
                        var classicChart = new google.visualization.ColumnChart(chartDiv);
                        classicChart.draw(data, classicOptions);
                        button.innerText = 'Change to Material';
                        button.onclick = drawMaterialChart;
                    }

                    drawMaterialChart();

                }
            });
        }
    </script>
@endsection
