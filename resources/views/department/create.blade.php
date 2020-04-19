@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

@endsection

@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div> Départment</div>
                {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                        elements and components
                    </div>--}}
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    {{--       <button class="btn-shadow mb-2 mr-2 btn btn-alternate btn-lg">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                     <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                                 </span>
                               <a href="{{route('entreprise.Employee.create')}}"
                                  style="color: white;font-size: 15px;"> Ajouter un nouveau employée  </a>&nbsp;&nbsp;
                           </button>--}}
                </div>
            </div>

        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">
                    Ajouter une nouvelle category du projet
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                <form method="POST" action="{{ route('department.store') }}">
                                    {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        @csrf
                                        <div class="col-12 ">
                                            <div class="position-relative form-group">
                                                <label for="name"> Nom du Département</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="position-relative form-group">
                                                <label>Sélectionnez un Employée</label>
                                              {{--  <select class="mb-2 form-control-lg form-control" name="client_id">
                                                    @foreach($clients as $client)
                                                        <option
                                                            value="{{$client->id}}"> {{$client->name}} </option>
                                                    @endforeach
                                                </select>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-block text-center card-footer">
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                                            <i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                        <button class="btn-wide btn btn-success" type="submit">Save</button>
                                    </div>

                                </form>

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
