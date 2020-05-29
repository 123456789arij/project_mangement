@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        #crud_btn, form {
            display: flex;
            height: 40px;
        }

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
            float: left;
            margin: 2px;

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

        .vertical-line {
            border-left: 2px solid #A9A9A9;
            display: inline-block;
            height: 20px;
            margin: 20px 10px;
        }

        /*    */
        #gantt:hover {
            background: transparent;
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
                <div> Projets Dashboard
                    @if(auth()->user())
                    <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{  $projectsCount }}
                         </span>
                    </span>
                    @endif
             {{--       @if(auth()->guard('employee')->user())
                        <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{$projectscount}}
                    </span>
                    </span>
                    @endif--}}
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                         <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                          </span>
                            <a href="{{ route('employee.project.create')}}"
                               style="color: black;font-size: 15px;"> Ajouter un nouveau Projet </a>&nbsp;&nbsp;
                        </button>
                    @endif
                    @if(auth()->user())
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                         <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                          </span>
                            <a href="{{ route('project.create')}}"
                               style="color: black;font-size: 15px;"> Ajouter un nouveau Projet </a>&nbsp;&nbsp;
                        </button>
                        <button type="button" class="btn btn-primary">
                            <a href="{{route('category.create')}}" style="color:white;">
                                Ajouter Catégories du projet</a>
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="card-header">Projets

                </div>
                <br>
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example"
                           class="display">
                        <thead>
                        <tr style="text-align: justify">
                            {{--                            <th scope="col">#</th>--}}
                            <th scope="col">{{ __('messages.project name') }}</th>
                            <th scope="col">{{ __('messages.members') }}</th>
                            <th scope="col">{{ __('messages.deadline') }}</th>
                            <th scope="col">{{ __('messages.client') }}</th>
                            <th scope="col">{{ __('messages.completion') }}</th>
                            <th scope="col">{{ __('messages.status') }}</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects  as $project)
                            <tr>
                                {{--                                <td class="text-center text-muted"> {{ $project->id }} </td>--}}
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            {{--  <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                             --}}{{--  img--}}{{--
                                                        </div>
                                                    </div>--}}

                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading" id="name">
                                                    @if(auth()->guard('employee')->user())
                                                        <a href="{{route('employee.project.show',$project->id)}}">{{ $project->name }}</a>
                                                    @else
                                                        <a href="{{route('project.show',$project->id)}}">{{ $project->name }}</a>
                                                    @endif
                                                </div>
                                                {{--                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="widget-content-left">
                                        {{--  <img src="{{asset($employee->image)}}" class="rounded-circle"
                                               height="40px" width="40px" alt="im"/>--}}
                                    </div>

                                    <a href="{{route('membre_projet',['id' => $project->id])}}" data-toggle="tooltip"
                                       data-original-title="Add Project Members"
                                       class="btn btn-primary btn-circle" id="add_membres"
                                       style="width: 28px;height: 28px;padding: 3px;">
                                        <i class=" pe-7s-plus" style="font-size: 20px;"></i>
                                    </a>
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
                                <td id="client">
                                    {{ $project->client->name}}
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
                                    @if($project->status == 0)
                                        <span
                                            class="badge badge-pill badge-secondary">{{__('messages.not Started') }}</span>
                                    @elseif($project->status ==  1)
                                        <span class="badge badge-pill badge-warning">{{__('messages.on Hold') }}</span>
                                    @elseif($project->status ==  2)
                                        <span
                                            class="badge badge-pill badge-info">  {{__('messages.In Progress') }}</span>
                                    @elseif($project->status == 3)
                                        <span class="badge badge-pill badge-danger">{{__('messages.canceled') }}</span>
                                    @elseif($project->status == 4)
                                        <span class="badge badge-pill badge-success">{{__('messages.finished') }}</span>
                                    @endif
                                </td>

                                <td class="text-center" id="crud_btn">
                                    @if(auth()->guard('employee')->user())
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">
                                            <a href="{{route('employee.project.show',$project->id)}}">
                                                <i class="pe-7s-info  btn-icon-wrapper" style="font-size: 20px;"></i>
                                            </a>
                                        </button>
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                            <a href="{{route('employee.project.edit',$project->id)}}">
                                                <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                            </a>
                                        </button>
                                    @else
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">
                                            <a href="{{route('project.show',$project->id)}}">
                                                <i class="pe-7s-info  btn-icon-wrapper" style="font-size: 20px;"></i>
                                            </a>
                                        </button>
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                            <a href="{{route('project.edit',$project->id)}}">
                                                <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                            </a>
                                        </button>
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-light">
                                            <a href="{{route('gantt',$project->id)}}" id="gantt">
                                                <i class="fas fa-chart-bar" style="font-size: 20px;"></i>
                                            </a>
                                        </button>
                                    @endif


                                    <form action="{{route('project.destroy',$project->id)}}" method="post">
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });
        });
    </script>

@endsection
