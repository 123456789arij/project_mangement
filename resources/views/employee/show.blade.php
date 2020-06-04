@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        #im {
            float: right;
        }

        #profile-color {
            color: #6b6b47;
            font-size: 13px;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview > div {
            background-image: url('');
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /*bordure de adresse*/
        .purple-border textarea {
            border: 1px solid #ba68c8;
        }

        .purple-border .form-control:focus {
            border: 1px solid #ba68c8;
            box-shadow: 0 0 0 0.2rem rgba(186, 104, 200, .25);
        }

        .green-border-focus .form-control:focus {
            border: 1px solid #8bc34a;
            box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
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
                    <i class="metismenu-icon fas fa-user icon-gradient bg-arielle-smile" style="font-size:36px"></i>
                </div>
                <div>
                    <h5 class="page-title">
                        {{__('messages.employee') }} # {{$employee->id}}
                    </h5>
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="row">
                    {{--image--}}
                    <div class="col-6 col-md-4" id="im">
                        <div class="avatarContainer">
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <div id="clock"
                                         style="background-image: url({{asset($employee->image)}});"
                                         class="rounded-circle"
                                         height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- project--}}
                    <div class="col-md-8 container">
                        <br><br>
                        <div class="card">
                            <div class="card-header">{{ __('messages.projects') }}</div>
                            <div class="card-body">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                    <tr style="text-align: justify">
                                        <th>{{ __('messages.project name') }}</th>
                                        <th>{{ __('messages.deadline') }}</th>
                                        <th>{{ __('messages.completion') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employee->projects as $project)
                                        <tr>
                                            <td>
                                                <a href="{{route('project')}}">{{$project->name}}</a></td>
                                            <td>{{ $project->deadline}}</td>
                                            <td class="text-center">
                                                @if($project->progress_bar <50)
                                                    <h5>Progress
                                                        <span class="pull-right">{{ $project->progress_bar }} %</span>
                                                    </h5>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                             style="width: 25%"
                                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            {{ $project->progress_bar }}
                                                        </div>
                                                    </div>
                                                @elseif($project->progress_bar<80)
                                                    <h5>Progress
                                                        <span class="pull-right">{{ $project->progress_bar }} %</span>
                                                    </h5>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                             style="width: 80%"
                                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                            {{ $project->progress_bar }}
                                                            <span
                                                                class="sr-only">          {{ $project->progress_bar }}</span>
                                                        </div>

                                                    </div>
                                                @elseif($project->progress_bar >= 80)
                                                    <h5>Progress
                                                        <span class="pull-right">{{ $project->progress_bar }} %</span>
                                                    </h5>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                             style="width: 90%"
                                                             aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                            {{ $project->progress_bar }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row container">
                    {{--profile--}}
                    <div class="col-6 col-md-4">
                        <div class="main-card mb-4 card">
                            <div class="card-header">Profile</div>
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title"> NOM : &nbsp;<label
                                                id="profile-color">{{$employee->name }}</label></h4>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title">Email :
                                            <label id="profile-color">{{$employee->email }}</label></h4>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title"> date d'inscription : &nbsp; <label id="profile-color">
                                                {{$employee->joining_date}}</label></h4>

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title"> sex : &nbsp;
                                            <label id="profile-color">
                                                @if($employee->gender == '1')
                                                    femme
                                                @else
                                                    homme
                                                @endif
                                            </label>
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title"> Mobile : &nbsp;<label
                                                id="profile-color">{{$employee->mobile}}</label></h4>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title">Adresse : &nbsp;
                                            <label id="profile-color">{{$employee->address}}  </label></h4>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <h4 class="card-title">Compétence &nbsp;</h4>
                                        <label id="profile-color">{{$employee->skills}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- task--}}
                    <div class="col-md-8 container">
                        <div class="card">
                            <div class="card-header">{{ __('messages.tasks') }}</div>
                            <div class="card-body">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                    <tr style="text-align: justify">
                                        <th scope="col">{{ __('messages.tasks') }}</th>
                                        <th scope="col">{{ __('messages.projects') }}</th>
                                        <th scope="col">{{ __('messages.due date') }}</th>
                                        <th scope="col">{{ __('messages.status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employee->tasks as $task)
                                        <tr>
                                            <td><a href="{{route('task')}}">{{$task->title}}</a></td>
                                            @foreach($employee->projects as $project)
                                                <td><a href="{{route('project')}}">{{ $project->name}}</a></td>
                                            @endforeach
                                            <td>{{$task->end_date }}</td>

                                            <td>
                                                @if($task->status === 1)
                                                    <span
                                                        class="badge badge-success"> {{ __('messages.Completed') }}</span>
                                                @elseif($task->status === 2)
                                                    <span
                                                        class="badge badge-danger"> {{ __('messages.Incomplete') }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-info"> {{ __('messages.In Progress') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
