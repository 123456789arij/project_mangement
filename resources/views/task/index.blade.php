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
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                        <i class="fa fa-plus">
                            <a href="{{ route('task.create')}}" id="create_task_btn">
                                Ajouter une nouvelle Tâche
                            </a>
                            &nbsp;&nbsp;</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--/app-page-title--}}
    {{--employee task filtre--}}
    @if(auth()->guard('employee')->user())
        <form action="{{route('employee.task')}}" type="get">
            <div class="row">
                <div class="col-3">
                    <label>Project </label>
                    <select class="mb-2 form-control-lg form-control" name="project_id">
                        <option>all</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}" @if($projectId==$project->id) selected @endif>
                                {{$project->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label>Status </label>
                    <select class="mb-2 form-control-lg form-control" name="status">
                        <option>all</option>
                        @foreach( $status  as  $key=> $value)
                            <option value="{{ $value}}" @if($statusId==$value) selected @endif>
                                {{trans("messages.$key")}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary" type="submit">filter</button>
                </div>
            </div>
        </form>
    @endif
    {{--employee task filtre--}}


    {{--entreprise task filtre--}}
    @if(auth()->user())
        <form action="{{route('task')}}" type="get">
            <div class="row">
                <div class="col-3">
                    <label>Project </label>
                    <select class="mb-2 form-control-lg form-control custom-select" name="project_id">
                        <option value="">all</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}" @if($projectId==$project->id) selected @endif>
                                {{$project->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label>Status </label>
                    <select class="mb-2 form-control-lg form-control custom-select" name="status">
                        <option value="">all</option>
                        @foreach($status  as  $key=> $value)
                            <option value="{{ $value}}" @if($statusId==$value) selected @endif>
                                {{trans("messages.$key")}} </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="font-icon-wrapper font-icon-lg" data-toggle="tooltip" id="findBtn"
                        data-original-title="filtre">
                    <i class="pe-7s-filter icon-gradient bg-warm-flame"></i>
                </button>
            </div>
        </form>
    @endif
    {{--/entreprise  task filtre--}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    {{ __('messages.tasks') }}
                </div>
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
                                                @else
                                                <div>
                                                    <a href="{{route('task.show',$task->id)}}">{{ $task->title}}</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('project')}}" class="project_task">{{ $task->project->name}}</a>
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
                                                        Edit
                                                    </strong>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{route('task.destroy',$task->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
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

                                    </div>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <footer class="card-footer" style="float: right">
                        {{ $tasks->links() }}
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
