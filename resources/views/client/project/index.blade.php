@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        #crud_btn, form {
            display: flex;
            height: 40px;
        }

        #show {
            background: transparent;
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
    </style>
@endsection
@section('content')

    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Projets Dashboard
                    {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components
                        </div>--}}
                </div>
            </div>
            {{--   /page-title-wrapper--}}
            {{--
                        <div class="page-title-actions">
                            <div class="d-inline-block dropdown text-center">
                            </div>
                        </div>--}}
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
                            {{--                            <th scope="col">{{ __('messages.client') }}</th>--}}
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
                                                    <a href="{{route('client.project.show',$project->id)}}">{{ $project->name }}</a>
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
                                {{--                                <td id="client">--}}
                                {{--                                    {{ $project->client->name}}--}}
                                {{--                                </td>--}}
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
                                        <span class="badge badge-pill badge-secondary">pas encore commencé</span>
                                    @elseif($project->status ==  1)
                                        <span class="badge badge-pill badge-warning">en attente</span>
                                    @elseif($project->status ==  2)
                                        <span class="badge badge-pill badge-info">en cour</span>
                                    @elseif($project->status == 3)
                                        <span class="badge badge-pill badge-danger">annulé</span>
                                    @elseif($project->status == 4)
                                        <span class="badge badge-pill badge-success">fini</span>
                                    @endif
                                </td>

                                <td class="text-center" id="crud_btn">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info" id="show">
                                        <a href="{{route('client.project.show',$project->id)}}" data-toggle="tooltip"
                                           data-original-title="View Project Details">
                                            <i class="pe-7s-search" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                    {{--    @if(auth()->guard('employee')->user())
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
                                        @endif
    --}}


                                    {{--     <form action="{{route('project.destroy',$project->id)}}" method="post">
                                             @csrf
                                             @method('DELETE')
                                             <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                                                 <i class="pe-7s-trash btn-icon-wrapper" style="font-size: 20px;"> </i>
                                             </button>
                                         </form>--}}

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