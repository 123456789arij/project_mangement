@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        #delete:hover {
            color: white;
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

        #create_task_btn {
            color: white;
            font-size: 18px;
        }

        #create_task_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .project_task {
            color: #24248f;
            font-size: 18px;
        }

        .project_task:hover {
            text-decoration: none;
            color: #5c5cd6;
        }

        a:hover {
            text-decoration: none;
        }

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
                    <i class="metismenu-icon fas fa-tasks"></i>
                </div>
                <div> Tâche Dashboard
                    @if(auth()->user())
                        <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{  $tasksCount }}
                    </span>
                    </span>
                    @endif
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    @if(auth()->user()&& auth()->user()->role_id ==  1)
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                            <i class="fa fa-plus">

                                <a href="{{ route('task.create')}}" id="create_task_btn">
                                    <strong> {{ __('messages.add_new_task') }}  </strong>
                                </a>
                                &nbsp;&nbsp;</i></button>
                    @endif
                    {{--chef de projet--}}
                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                            <i class="fa fa-plus">
                                <a href="{{ route('employee.task.create')}}" id="create_task_btn">
                                    <strong> {{ __('messages.add_new_task') }}  </strong>
                                </a>
                            </i></button>
                    @endif
                    {{--/chef de projet--}}


                </div>
            </div>
        </div>
    </div>
    {{--/app-page-title--}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{ __('messages.tasks') }}</div>
                <br>
                {{--search--}}
                @if(auth()->user()&& auth()->user()->role_id ==  1)
                    <div class="row">
                        <div class="col-6">
                            <form action="{{route('task')}}" type="get">
                                <div class="row container">
                                    <div class="col">
                                        <label> <strong> {{ __('messages.project') }}  </strong></label>
                                        <select class="mb-2 form-control-lg form-control custom-select"
                                                name="project_id">
                                            <option value="">all</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}"
                                                        @if($projectId==$project->id) selected @endif>
                                                    {{$project->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label><strong> {{ __('messages.status') }}  </strong></label>
                                        <select class="mb-2 form-control-lg form-control custom-select" name="status">
                                            <option value="">all</option>
                                            @foreach($status  as  $key=> $value)
                                                <option value="{{ $value}}" @if($statusId==$value) selected @endif>
                                                    {{trans("messages.$key")}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-light my-2 my-sm-0 bg-transparent">
                                        <i class="pe-7s-filter"
                                           style="color:#4d4dff;font-size:30px;font-weight: bolder"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6" style="padding-left: 200px">
                            <form class="form-inline my-2 my-lg-0" action="{{route('task')}}">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                       aria-label="Search"
                                       name="search">
                                <button class="btn btn-light my-2 my-sm-0" style="background: #ffe6ff" type="submit"><i
                                        class="fa fa-search"
                                        style="color: #cc00cc"></i>
                                </button>
                            </form>
                        </div>
                    </div>


                @endif
                {{--/search--}}
                @if(auth()->guard('employee')->user())
                    <div class="row">
                        <div class="col-6">
                            <form action="{{route('employee.task')}}" type="get">
                                <div class="row container">
                                    <div class="col">
                                        <label> <strong> {{ __('messages.project') }}  </strong></label>
                                        <select class="mb-2 form-control-lg form-control" name="project_id">
                                            <option value="">all</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}"
                                                        @if($projectId==$project->id) selected @endif>
                                                    {{$project->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label><strong> {{ __('messages.status') }}  </strong></label>
                                        <select class="mb-2 form-control-lg form-control" name="status">
                                            <option value="">all</option>
                                            @foreach( $status  as  $key=> $value)
                                                <option value="{{ $value}}" @if($statusId==$value) selected @endif>
                                                    {{trans("messages.$key")}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-light my-2 my-sm-0 bg-transparent">
                                        <i class="pe-7s-filter"
                                           style="color:#4d4dff;font-size:30px;font-weight: bolder"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6" style="padding-left: 200px">
                            <form class="form-inline my-2 my-lg-0" action="{{route('employee.task')}}">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                       aria-label="Search"
                                       name="search">
                                <button class="btn btn-light my-2 my-sm-0" style="background: #ffe6ff" type="submit"><i
                                        class="fa fa-search"
                                        style="color: #cc00cc"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                @endif
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('messages.tasks') }}</th>
                            <th scope="col">{{ __('messages.projects') }}</th>
                            <th scope="col">{{ __('messages.assigned to') }}</th>
                            <th scope="col">{{ __('messages.due date') }}</th>
                            <th scope="col">{{ __('messages.status') }}</th>
                            <th colspan="2">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach(  $tasks  as  $task)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div>
                                                @if(auth()->guard('employee')->user())
                                                    <div>
                                                        <a href="{{route('employee.task.show',$task->id)}}">{{ $task->title}}</a>
                                                    </div>
                                                @endif
                                                @if(auth()->user()&& auth()->user()->role_id ==  1)
                                                    <div>
                                                        <a href="{{route('task.show',$task->id)}}">{{ $task->title}}</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @if(auth()->guard('employee')->user())
                                    <td>
                                        <a href="{{route('employee.project.show',$project->id)}}"
                                           class="project_task">{{ $task->project->name}}</a>
                                    </td>

                                    <td>
                                        @foreach($task->employees as $employee)
                                            <div style="display:inline-block">
                                                <img src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                     data-original-title="{{$employee->name}}" class="rounded-circle"
                                                     height="30px" width="30px" alt="employee"/>
                                            </div>
                                        @endforeach
                                    </td>

                                    <td style="color: green;font-size: 15px;">
                                        {{$task->end_date }}
                                    </td>

                                    <td style="color: tomato;font-size: 15px;">
                                        @if($task->status === 1)
                                            <span class="badge badge-success"> {{ __('messages.Completed') }}</span>
                                        @elseif($task->status === 2)
                                            <span class="badge badge-danger"> {{ __('messages.Incomplete') }}</span>
                                        @else
                                            <span class="badge badge-info"> {{ __('messages.In Progress') }}</span>
                                        @endif
                                    </td>
                                    {{--                                action btn--}}
                                    <td class="text-center">
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('employee.task.edit',$task->id)}}">
                                                        <strong>
                                                            <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                               style="font-size:20px;"></i>
                                                            {{ __('messages.edit') }}
                                                        </strong>
                                                    </a>
                                                </li>
                                                @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                                    <li>
                                                        <form action="{{route('employee.task.destroy',$task->id)}}"
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
                                                @endif
                                            </ul>

                                        </div>

                                    </td>
                                @endif
                                @if(auth()->user()&& auth()->user()->role_id ==  1)
                                    <td>
                                        <a href="{{route('project.show',$project->id)}}"
                                           class="project_task">{{ $task->project->name}}</a>
                                    </td>

                                    <td>
                                        @foreach($task->employees as $employee)
                                            <div style="display:inline-block">
                                                <img src="{{asset($employee->image)}}" data-toggle="tooltip"
                                                     data-original-title="{{$employee->name}}" class="rounded-circle"
                                                     height="30px" width="30px" alt="employee"/>
                                            </div>
                                        @endforeach
                                    </td>

                                    <td style="color: green;font-size: 15px;">
                                        {{$task->end_date }}
                                    </td>

                                    <td style="color: tomato;font-size: 15px;">
                                        @if($task->status === 1)
                                            <span class="badge badge-success"> {{ __('messages.Completed') }}</span>
                                        @elseif($task->status === 2)
                                            <span class="badge badge-danger"> {{ __('messages.Incomplete') }}</span>
                                        @else
                                            <span class="badge badge-info"> {{ __('messages.In Progress') }}</span>
                                        @endif
                                    </td>
                                    {{--                                action btn--}}
                                    <td class="text-center">
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('task.edit',$task->id)}}">
                                                        <strong>
                                                            <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                               style="font-size:20px;"></i>
                                                            {{ __('messages.edit') }}
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{route('task.destroy',$task->id)}}" method="post">
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
                    <br>
                    <span style="float: right">{{ $tasks->links() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#findBtn").click(function () {
                var project_id = $('project_id').val();
                var status = $('status').val();

                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '{{url('/tasks')}}',
                    data: 'project_id=' + project_id + 'status=' + status,
                    success: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
