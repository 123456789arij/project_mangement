@extends('layouts.base')
@section('cssBlock')
    <style>
        body {
            background-color: #eee;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            text-align: center;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;

        }

        .label-custom {
            background-color: #01c0c8;
        }

        .label-rouded, .label-rounded {
            border-radius: 50%;
            padding: 6px 8px;
            font-weight: 400;
        }

        .card {
            font-size: 1em;
            overflow: hidden;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
            margin-top: 20px;
        }

        label-rouded, .label-rounded {
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
            font-size: 100%;
            font-weight: 800;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }


        .btn {
            margin-top: auto;
        }

        #create_department_btn {
            color: white;
            font-size: 18px;
        }

        #create_department_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }


        a:hover {
            text-decoration: none;
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

        .pull-right {
            float: right !important;
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
                    <i class="fas fa-building icon-gradient bg-premium-dark">
                    </i>
                </div>
                <div>   {{ __('messages.departments') }}
                    {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components
                        </div>--}}
                </div>
            </div>
            {{--   /page-title-wrapper--}}
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{ __('messages.departments') }} : {{ $department->name }} </div>

                <div class="container py-3">
                    <!-- Card Start -->
                    <div class="card col-sm-6">
                        {{--           <div class="col-md-7 px-3">
                                       <div class="card-block px-6">
                                           <h1 class="card-title">{{ __('messages.departments') }}
                                               : {{ $department->name }}</h1>
                                           {{$department->employees_count}}
                                           <br>
                                           <h5 class="card-title"><strong>Membres :</strong></h5>
                                           <div class="widget-content-left mr-3">
                                               <div class="widget-content-left container">
                                                   @foreach( $department->employees as $employee )
                                                       <a href="{{route('employee.index')}}" style="display: inline-block">
                                                           <img
                                                               src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                               data-original-title="{{ $employee->name}}"
                                                               class="rounded-circle"
                                                               height="42px" width="42px" alt="employee"/>
                                                           <strong class="text-center"><a
                                                                   href="{{route('employee.index')}}">{{ $employee->name  }}</a></strong>
                                                       </a>

                                                       <br>
                                                   @endforeach
                                               </div>
                                           </div>

                                           <br>
                                       </div>
                                   </div>--}}
                        <div class="panel panel-inverse">
                            <div class="panel-heading">{{ __('messages.members') }}
                                <span class="label label-rouded label-custom pull-right">
                              <strong> {{$department->employees_count}}</strong>
                                                    </span>
                            </div>
                            <br>
                            <div class="panel-wrapper">
                                <div class="panel-body container">
                                    @foreach( $department->employees as $employee )
                                        <a href="{{route('employee.index')}}" style="display: inline-block">
                                            <img
                                                src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                data-original-title="{{ $employee->name}}"
                                                class="rounded-circle"
                                                height="42px" width="42px" alt="employee"/>
                                            <strong class="text-center"><a
                                                    href="{{route('employee.index')}}">{{ $employee->name  }}</a></strong>
                                        </a>
                                        <br>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <br><br>
                    </div>
                    <!-- End of card -->

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
