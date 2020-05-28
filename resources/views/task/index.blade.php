@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
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
                    <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{  $tasksCount }}
                    </span>
                    </span>
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                         <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                          </span>
                        <a href="{{ route('task.create')}}"
                           style="color: white;font-size: 15px;"> Ajouter une nouvelle Tâche</a>&nbsp;&nbsp;
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->guard('employee')->user())
        <form action="{{route('employee.task')}}" type="get">
            <div class="row">
                <div class="col-3">
                    <select class="mb-2 form-control-lg form-control" name="project_id">
                        <option value="">choose</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}" @if($projectId==$project->id) selected @endif>
                                {{$project->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select class="mb-2 form-control-lg form-control" name="status">
                        <option value="">choose</option>
                        @foreach( $status  as  $key=> $value)
                            <option value="{{ $value}}" @if($statusId===$value) selected @endif>
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
    {{--/app-page-title--}}

    {{--entreprise task filtre--}}
    @if(auth()->user())
        <form action="{{route('task')}}" type="get">
            <div class="row">
                <div class="col-3">
                    <select class="mb-2 form-control-lg form-control" name="project_id">
                        <option value="">choose</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}" @if($projectId==$project->id) selected @endif>
                                {{$project->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select class="mb-2 form-control-lg form-control" name="status">
                        <option value="">choose</option>
                        @foreach( $status  as  $key=> $value)
                            <option value="{{ $value}}" @if($statusId===$value) selected @endif>
                                {{trans("messages.$key")}} </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="font-icon-wrapper font-icon-lg" data-toggle="tooltip"
                        data-original-title="filtre">
                    <i class="pe-7s-filter icon-gradient bg-warm-flame"> </i>
                </button>
            </div>
        </form>
    @endif
    {{--/entreprise  task filtre--}}


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    Tâche
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
                                                <div>
                                                    <a href="{{route('task.show',$task->id)}}">{{ $task->titre}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#">{{ $task->project->name}}</a></td>
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
                                        <span class="badge badge-info"> {{ __('messages.inProgress') }}</span>
                                    @endif
                                </td>


                                <td>

                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{route('task.edit',$task->id)}}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>

                                    <form action="{{route('task.destroy',$task->id)}}" method="post">
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
@endsection
