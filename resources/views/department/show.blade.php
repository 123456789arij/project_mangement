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

        .card {
            font-size: 1em;
            overflow: hidden;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
            margin-top: 20px;
        }

        .carousel-indicators li {
            border-radius: 12px;
            width: 12px;
            height: 12px;
            background-color: #404040;
        }

        .carousel-indicators li {
            border-radius: 12px;
            width: 12px;
            height: 12px;
            background-color: #404040;
        }

        .carousel-indicators .active {
            background-color: white;
            max-width: 12px;
            margin: 0 3px;
            height: 12px;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
        }

        lex-direction: column

        ;
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

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                        <i class="fa fa-plus">
                            <a href="{{ route('department.create') }}" id="create_department_btn"> Ajouter un nouveau
                                Départment </a>&nbsp;&nbsp;
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{ __('messages.departments') }}</div>

                <div class="container py-3">
                    <!-- Card Start -->
                    <div class="card">
                        <div class="row ">
                            <div class="col-md-7 px-3">
                                <div class="card-block px-6">
                                    <h1 class="card-title">{{ __('messages.departments') }} : {{ $department->name }}</h1>
                                    <br>
                                    <h5 class="card-title"><u>Membres :</u></h5>
                                    <div class="widget-content-left mr-3">
                                        <div class="widget-content-left container">
                                            @foreach( $department->employees as $employee )
                                                <a href="{{route('employee.index')}}" style="display: inline-block">
                                                    <img
                                                        src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                        data-original-title="{{ $employee->name}}"
                                                        class="rounded-circle"
                                                        height="42px" width="42px" alt="employee"/>
                                                    <strong class="text-center"><a href="{{route('employee.index')}}">{{ $employee->name  }}</a></strong>  </a>

<br>
                                            @endforeach
                                        </div>
                                    </div>

                                    <br>
                                </div>
                            </div>
                            <br><br>
                        </div>
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
