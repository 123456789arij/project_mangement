@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        #crud_btn, form {
            display: flex;
            height: 40px;

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

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
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

                </div>
            </div>
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Des Employés</div>
                            <div class="widget-subheading">Last year expenses</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold</div>
                            <div class="widget-subheading">Revenue streams</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">$3M</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Followers</div>
                            <div class="widget-subheading">People Interested</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">45,9%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Income</div>
                            <div class="widget-subheading">Expected totals</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-focus">$147</div>
                        </div>
                    </div>
                    <div class="widget-progress-wrapper">
                        <div class="progress-bar-sm progress-bar-animated-alt progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                        </div>
                        <div class="progress-sub-label">
                            <div class="sub-label-left">Expenses</div>
                            <div class="sub-label-right">100%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nom du projet</th>
                            <th scope="col">Membres</th>
                            <th scope="col">Dedline</th>
                            <th scope="col">Client</th>
                            <th scope="col">Progression</th>
                            <th scope="col">statu</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects  as $project)
                            <tr>
                                <td class="text-center text-muted"> {{ $project->id }} </td>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            {{--  <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                             --}}{{--  img--}}{{--
                                                        </div>
                                                    </div>--}}
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">
                                                    {{-- "{{route('projet.show',$projet->id)}}"--}}
                                                    <a href="{{route('project.show',$project->id)}}">{{ $project->name }}</a>
                                                </div>
                                                {{--                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="mr-2 btn-icon btn-icon-only ">
                                        {{--  <a href="{{route('afficher_membre_projet',$project->id)}}">

                                          </a>--}}
                                        <i class=" pe-7s-plus" style="font-size: 20px;"></i>
                                    </button>
                                    {{--           {{ $projet->description }}--}}
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-warning">
                                        {{ $project->deadline}}
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $project->client->name}}
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-warning">
                                        {{ $project->progress_bar }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($project->status == 0)
                                        <span class="badge badge-secondary">pas encore commencé</span>
                                    @elseif($project->status ==  1)
                                        <span class="badge badge-warning">en attente</span>
                                    @elseif($project->status ==  2)
                                        <span class="badge badge-info">en cour</span>
                                    @elseif($project->status == 3)
                                        <span class="badge badge-danger">annulé</span>
                                    @elseif($project->status == 4)
                                        <span class="badge badge-success">fini</span>
                                    @endif
                                </td>
                                <td class="text-center" id="crud_btn">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{route('project.edit',$project->id)}}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>

                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">
                                        <a href="{{route('project.show',$project->id)}}">
                                        <i class="pe-7s-info  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>

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
              {{--      <footer class="card-footer" style="float: right">
                        {{ $projects->links() }}
                    </footer>--}}
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
