@extends('layouts.base')
@section('cssBlock')
    <style>

        .pull-right {
            float: right !important;
        }

        .progress {
            background-color: rgba(120, 130, 140, .13);
            box-shadow: none !important;
            margin-bottom: 18px;
            overflow: hidden;
        }

        #name {
            text-transform: capitalize;
            text-align: justify;
        }

        #client {
            text-transform: capitalize;
            text-align: justify;
        }

        #status:first-letter {
            text-transform: uppercase;
            /*text-transform: capitalize;*/
            text-align: center;
        }

        h5 {
            font-size: 13px;
            font-family: 'Montserrat', sans-serif;
            color: #2b2b2b;
            text-align: justify;
            display: block;
            font-size: 0.83em;
            margin-block-start: 1.67em;
            margin-block-end: 1.67em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;

            line-height: 1.1;
            margin: 10px 0;
            font-weight: 300;
        }

        img {
            display: inline-block;
            margin: 2px;
            float: left;

        }

        #add_membres {
            color: #ab8ce4;
            border: 1px solid #ab8ce4;
            display: inline-block;
            font-weight: 400;
            white-space: nowrap;
            vertical-align: middle;
            text-decoration: none;
        }

        #add_membres:hover {
            background: transparent;
        }

        .btn-circle {
            border-radius: 4px;
            background: transparent;
            line-height: 1.428571429;
        }
        /*  btn crud */
        .m-r-10 {
            margin-right: 10px !important;
        }

        .dropdown-menu > li > a {
            padding: 9px 20px;
        }

        .dropdown-menu > li > a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
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
                <div> Projets Dashboard</div>
            </div>
        </div>
    </div>
    {{--  /app-page-title--}}

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card-header">{{ __('messages.projects') }}</div>
{{--                    <form action="{{route('client.project')}}" method="get" role="search" style="float: right">--}}
{{--                        <div  style="float: right">--}}
{{--                            <input type="text" name="search" placeholder="Type to search">--}}
{{--                            <button type="submit">search</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                <br>
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr style="text-align: justify">
                            <th scope="col">{{ __('messages.project name') }}</th>
                            <th scope="col">{{ __('messages.members') }}</th>
                            <th scope="col">{{ __('messages.deadline') }}</th>
                            <th scope="col">{{ __('messages.completion') }}</th>
                            <th scope="col">{{ __('messages.status') }}</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects  as $project)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading" id="name">
                                                    <a href="{{route('client.project.show',$project->id)}}">{{ $project->name }}</a>
                                                </div>
                                                {{--                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @foreach($project->employees as $employee)
                                        <img src="{{asset($employee->image)}}" class="rounded-circle"
                                             data-toggle="tooltip" data-original-title="{{$employee->name}}"
                                             height="30px" width="30px" alt="employee"/>

                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-warning">
                                        {{ $project->deadline}}
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($project->progress_bar <50)
                                        <h5>Progress
                                            <span class="pull-right">{{ $project->progress_bar }} %</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                {{ $project->progress_bar }}
                                            </div>
                                        </div>
                                    @elseif($project->progress_bar<80)
                                        <h5>Progress
                                            <span class="pull-right">{{ $project->progress_bar }} %</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 80%"
                                                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                {{ $project->progress_bar }}
                                                <span class="sr-only">          {{ $project->progress_bar }}</span>
                                            </div>

                                        </div>
                                    @elseif($project->progress_bar >= 80)
                                        <h5>Progress
                                            <span class="pull-right">{{ $project->progress_bar }} %</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 90%"
                                                 aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                {{ $project->progress_bar }}
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td id="status">
                                    @if($project->status == 1)
                                        <span
                                            class="badge badge-pill badge-secondary">{{__('messages.not Started') }}</span>
                                    @elseif($project->status ==  2)
                                        <span class="badge badge-pill badge-warning">{{__('messages.on Hold') }}</span>
                                    @elseif($project->status ==  3)
                                        <span
                                            class="badge badge-pill badge-info">  {{__('messages.In Progress') }}</span>
                                    @elseif($project->status == 4)
                                        <span class="badge badge-pill badge-danger">{{__('messages.canceled') }}</span>
                                    @elseif($project->status == 5)
                                        <span class="badge badge-pill badge-success">{{__('messages.finished') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group dropdown m-r-10 open">
                                        <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                type="button">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul role="menu" class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{route('client.project.show',$project->id)}}">
                                                    <strong>
                                                        <i class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                            style="font-size: 20px;"></i>
                                                        Show
                                                    </strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <footer class="card-footer" style="float: right">
                        {{ $projects->links() }}
                    </footer>
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
