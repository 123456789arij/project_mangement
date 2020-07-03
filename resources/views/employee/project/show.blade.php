@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        #CLIENT_DETAILS{
            background-color: #01c0c8;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            margin: 10px 0;
            font-weight: 300;
            line-height: 1.1;
        }

        .m-t-25 {
            margin-top: 25px !important;
        }

        .panel-inverse {
            border-color: #4c5667;
        }

        .panel {
            margin-bottom: 15px;
            border: 0;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: none;
        }

        .panel-heading {
            padding: 10px 15px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid transparent;
            border-radius: 0;
        }

        .panel .panel-heading {
            font-weight: 600;
            text-transform: uppercase;
        }

        .panel-inverse .panel-heading {
            border-color: #f6f7f9;
            color: inherit;
            background-color: #f6f7f9;
        }

        .collapse.in {
            display: block;
        }

        .col-md-4 {
            padding-left: 7.5px;
            padding-right: 7.5px;
        }

        .panel-body:after {
            clear: both;
            display: table;
            content: " ";
        }

        dl {
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            margin-top: 0;
            margin-bottom: 20px;


        }

        dt {
            font-weight: 700;
            line-height: 1.42857143;
            display: block;
        }

        dd {
            margin-left: 0;
            display: block;
            margin-inline-start: 40px;

        }

        .m-b-10 {
            margin-bottom: 10px !important;
        }

        dd, dt {
            line-height: 1.42857143;
        }

        #status {
            float: right;
            position: relative;
            left: 180px;
        }

        #edit {
            float: right;
            position: relative;
            left: 270px;
        }

        #edit:hover {
            background: transparent;
        }

        a {
            font-size: 19px;
        }

        a:hover {
            text-decoration: none;
        }

        .border-radius {
            border-radius: 6px;
        }

        .b-all {
            border: 1px solid rgba(120, 130, 140, .13) !important;
        }

        #details_project {
            padding-top: 20px;
            padding-bottom: 10px;
        }

        .label-rouded, .label-rounded {
            border-radius: 50%;
            padding: 6px 8px;
            font-weight: 400;
        }

        .label-custom {
            background-color: #01c0c8;
        }

        .pull-right {
            float: right !important;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }
    </style>
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class='metismenu-icon fas fa-layer-group'></i>
                </div>
                <div>
                    <h5 class="page-title">
                     <strong>{{__('messages.project') }} # {{$project->id}} - {{$project->name}}</strong>
                    </h5>
                </div>
                <div id="status">
                    @if($project->status == 0)
                        <span class="badge badge-pill badge-secondary">{{__('messages.not Started') }}</span>
                    @elseif($project->status ==  1)
                        <span class="badge badge-pill badge-warning">{{__('messages.on Hold') }}</span>
                    @elseif($project->status ==  2)
                        <span class="badge badge-pill badge-info">  {{__('messages.In Progress') }}</span>
                    @elseif($project->status == 3)
                        <span class="badge badge-pill badge-danger">{{__('messages.canceled') }}</span>
                    @elseif($project->status == 4)
                        <span class="badge badge-pill badge-success">{{__('messages.finished') }}</span>
                    @endif
                </div>
                &nbsp;
                @if(auth()->user())
                    <button type="button" class="mr-2  btn-lg  btn btn-outline-primary" id="edit">
                        <a href="{{route('project.edit',$project->id)}}">
                            <i class="pe-7s-note  btn-icon-wrapper"></i>{{ __('messages.update') }}
                        </a>
                    </button>
                @endif
                {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                        elements and components
                    </div>--}}

            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    {{--       <button class="btn-shadow mb-2 mr-2 btn btn-alternate btn-lg">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                     <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                           </button>--}}
                </div>
            </div>
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">


    </div>
    <div class="row">
        <div class="col-md-12">
            <!------ carde tab ---------->
            <div class="mb-3 card">
                <div class="card-header card-header-tab-animation">
                  <strong>{{ __('messages.project') }}</strong>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{--projet--}}
                        <div class="tab-pane active" id="tab-eg115-0" role="tabpanel">

                            <div class="row">
                                <div class="col-sm-8" style="max-height: 400px; overflow-y: auto;">
                                    <div class="panel-body b-all border-radius container" id="details_project">
                                        <h5><strong>{{ __('messages.Project Details') }}</strong> </h5>
                                        {!! strip_tags($project->description) !!}
                                        <br>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="float: right">
                                    <div class="col-md-12">
                                        <div class="panel panel-inverse">
                                            <div class="panel-heading"><strong>{{ __('messages.members') }}</strong>
                                                <span class="label label-rouded label-custom pull-right">
{{$project->employees_count}}
                                                    </span>
                                            </div>

                                            <br>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body container">
                                                    @foreach($project->employees as $employee)
                                                        <img src="{{asset($employee->image)}}"
                                                             class="rounded-circle"
                                                             data-toggle="tooltip"
                                                             data-original-title="{{$employee->name}}"
                                                             height="30px" width="30px" alt="employee"/>
                                                    @endforeach
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-8" style="max-height: 400px; overflow-y: auto;">
                                <div class="panel-body b-all border-radius container" id="details_project">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6> {{ __('messages.Start Date') }} </h6> {{ $project->start_date}}
                                        </div>
                                        <div class="col-6">
                                            <h6> {{ __('messages.due date') }}</h6> {{ $project->deadline}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br> <br> <br>
                            <div class="card mb-3" style="max-width: 540px; position: center">
                                <div class="panel-heading" id="CLIENT_DETAILS"><strong>{{ __('messages.CLIENT_DETAILS') }}</strong></div>
                                <div class="row no-gutters container">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>{{ __('messages.name') }} :</strong></h5>
                                            <h5 class="card-title"><strong>{{ __('messages.email') }} :</strong></h5>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="card-text">{{$project->client->name}}</p>
                                            <p class="card-text">{{$project->client->email}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- / client détailles--}}

                        </div>

                    </div>
                </div>
            </div>
            {{--                /carde tab--}}

        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

@endsection
