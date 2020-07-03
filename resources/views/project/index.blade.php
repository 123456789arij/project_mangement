@extends('layouts.base')
@section('cssBlock')
    <style>
        {{--create_Projet_btn--}}
        #create_Projet_btn {
            color: white;
            font-size: 18px;
        }

        #create_Projet_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        #delete:hover {
            color: white;
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

        a:hover {
            text-decoration: none;
        }

        /*  gantt  */
        #gantt:hover {
            background: transparent;
        }

        /*/gantt  */

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

        /* /btn crud */
        /*search */
        .active-purple-3 input[type=text] {
            border: 1px solid #ce93d8;
            box-shadow: 0 0 0 1px #ce93d8;
        }

        .ml-3, .mx-3 {
            margin-left: 1rem !important;
        }

        .w-75 {
            width: 75% !important;
        }

        .active-purple .fas, .active-purple-2 .fas, .active-purple-3 .fas, .active-purple-4 .fas {
            color: #ce93d8;
        }

        .active-purple .fa, .active-purple-2 .fa {
            color: #ce93d8;
        }

        #search:hover {
            border: 1px solid #ce93d8;
        }

        button {
            border: transparent;
            background-color: transparent;
        }

        .active-purple input[type=text] {
            border-bottom: 1px solid #ce93d8;
            box-shadow: 0 1px 0 0 #ce93d8;
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
                <div><strong>   {{ __('messages.projects') }} Dashboard</strong>
                    @if(auth()->user())
                        <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{  $projectsCount }}
                         </span>
                    </span>
                    @endif
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                  {{--  @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                            <i class="fa fa-plus" style="font-size: 20px;">
                                <a href="{{ route('employee.project.create')}}" id="create_Projet_btn">
                                    {{ __('messages.add_new_Project') }}     </a>&nbsp;
                                &nbsp;</i>
                        </button>
                    @endif--}}
                    @if(auth()->user()&& auth()->user()->role_id ==  1)
                        <button type="button" class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                            <i class="fa fa-plus" style="font-size: 20px;">
                                <a href="{{ route('project.create')}}" id="create_Projet_btn">
                                    {{ __('messages.add_new_Project') }}
                                </a></i>
                        </button>
                        <button type="button" class="btn-shadow mb-2 mr-2 btn btn-info  btn-lg">
                            <i class="fa fa-plus" style="font-size: 20px;">
                                <a href="{{route('category.create')}}" id="create_Projet_btn">
                                    {{ __('messages.add_new_Category') }}
                                </a>
                            </i>
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

                <div class="card-header"><strong>{{ __('messages.projects') }}</strong></div>
                <br>
                @if(auth()->guard('employee')->user())
                    <div style="float: right;" class="container">
                        <form action="{{route('employee.project')}}"
                              class="form-inline d-flex mb-5 active-purple-3 active-purple-4 d-flex "
                              method="get" role="search">
                            <input type="text" name="search" placeholder="search" id="search">
                            <button>
                                <i class="fas fa-search active" aria-hidden="true" type="submit"></i>
                            </button>
                        </form>
                    </div>
                @endif
                @if(auth()->user())
                    <form action="{{route('project')}}"
                          class="form-inline d-flex mb-5 active-purple-3 active-purple-4 d-flex "
                          method="get" role="search">
                        <div style="float: right" class="container">
                            <input type="text" name="search" placeholder="search" id="search">
                            <button><i class="fas fa-search active" aria-hidden="true" type="submit"></i></button>
                        </div>
                    </form>
                @endif
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" class="display">
                        <thead>
                        <tr style="text-align: justify">
                            <th><strong>{{ __('messages.project name') }}</strong></th>
                            <th><strong>{{ __('messages.members') }}</strong></th>
                            <th><strong>{{ __('messages.deadline') }}</strong></th>
                            <th><strong>{{ __('messages.client') }}</strong></th>
                            <th><strong>{{ __('messages.completion') }}</strong></th>
                            <th><strong>{{ __('messages.status') }}</strong></th>
                            <th colspan="4"><strong>Action</strong></th>
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
                                                    @if(auth()->guard('employee')->user())
                                                        <a href="{{route('employee.project.show',$project->id)}}">{{ $project->name }}</a>
                                                    @endif
                                                    @if(auth()->user())
                                                        <a href="{{route('project.show',$project->id)}}">{{ $project->name }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                        <a href="{{route('employee.membre_projet',['id' => $project->id])}}"
                                           data-toggle="tooltip"
                                           data-original-title="Add Project Members"
                                           class="btn btn-primary btn-circle" id="add_membres"
                                           style="width: 28px;height: 28px;padding: 3px;">
                                            <i class=" pe-7s-plus" style="font-size: 20px;"></i>
                                        </a>
                                    @endif
                                    @if(auth()->user())
                                        <a href="{{route('membre_projet',['id' => $project->id])}}"
                                           data-toggle="tooltip"
                                           data-original-title="Add Project Members"
                                           class="btn btn-primary btn-circle" id="add_membres"
                                           style="width: 28px;height: 28px;padding: 3px;">
                                            <i class=" pe-7s-plus" style="font-size: 20px;"></i>
                                        </a>
                                    @endif

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

                                {{--                                @if(auth()->guard('employee')->user())--}}
                                {{--                                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==1)--}}
                                @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                    <td class="text-center">
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('employee.project.show',$project->id)}}">
                                                        <strong> <i
                                                                class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                                style="font-size: 20px;"></i>
                                                            Show
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('employee.project.edit',$project->id)}}">
                                                        <strong>
                                                            <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                               style="font-size:20px;"></i>
                                                            Edit
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{route('employee.project.destroy',$project->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        &nbsp;
                                                        <button class="mr-2 btn-icon btn-icon-only btn">
                                                            <strong>
                                                                <i class="fa fa-trash btn-icon-wrapper icon-gradient bg-love-kiss"
                                                                   style="font-size: 20px;" id="delete">
                                                                </i> Delete
                                                            </strong>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                @endif

                                @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==1)
                                    <td class="text-center">
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('employee.project.show',$project->id)}}">
                                                        <strong> <i
                                                                class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                                style="font-size: 20px;"></i>
                                                            Show
                                                        </strong>
                                                    </a>
                                                </li>
                                @endif
                                @if(auth()->user() && auth()->user()->role_id == 1)
                                    <td class="text-center">
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('project.edit',$project->id)}}">
                                                        <strong>
                                                            <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                               style="font-size:20px;"></i>
                                                            {{ __('messages.edit') }}
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('project.show',$project->id)}}">
                                                        <strong> <i
                                                                class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                                style="font-size: 20px;"></i>
                                                            {{ __('messages.show') }}
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('gantt',$project->id)}}" id="gantt">
                                                        <strong>
                                                            <i class="fas fa-chart-bar icon-gradient bg-amy-crisp"
                                                               style="font-size: 20px;"></i>
                                                            Gantt
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{route('project.destroy',$project->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        &nbsp;
                                                        <button class="mr-2 btn-icon btn-icon-only btn">
                                                            <strong>
                                                                <i class="fa fa-trash btn-icon-wrapper icon-gradient bg-love-kiss"
                                                                   style="font-size: 20px;" id="delete">
                                                                </i> {{ __('messages.delete') }}
                                                            </strong>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif

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
