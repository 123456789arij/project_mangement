@extends('layouts.base')
@section('cssBlock')
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div id="gantt_here" style='width:100%; height:100%;'></div>

@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <script>
        // gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
        gantt.config.order_branch = true;/*!*/
        gantt.config.order_branch_free = true;/*!*/
        gantt.init("gantt_here");
        gantt.load("/api/data");
        var dp = new gantt.dataProcessor("/api");/*!*/
        dp.init(gantt);/*!*/
        dp.setTransactionMode("REST");/*!*/
    </script>
@endsection
