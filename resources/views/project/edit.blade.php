@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
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
                <div><h4 class="page-title">
                        {{__('messages.project') }} # {{$project->id}} - {{$project->name}}
                    </h4></div>
                {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                        elements and components
                    </div>--}}
            </div>
            {{--/page-title-wrapper--}}

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


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-header">

                    {{__('messages.UPDATE_PROJECT_DETAILS') }}
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                <form method="POST" action="{{ route('project.update',$project->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        <div class="col-12 ">
                                            <div class="position-relative form-group">
                                                <label for="name"> nom du projet </label>
                                                <input type="text" class="form-control" value="{{$project->name}}"
                                                       name="name">
                                            </div>
                                        </div>
                                    </div>
                                    {{--Categorie du projet--}}
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group" for="category_id">
                                                <label>Categorie du projet</label>
                                                <select class="mb-2 form-control-lg form-control" name="category_id">
                                                    @foreach($categories as $category )
                                                        <option
                                                            value="{{$category->id}}"{{ old('category_id', $project->category_id) == $category->id ? 'selected' : ''}}> {{$category->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--/Categorie du projet--}}
                                    {{--client--}}
                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="position-relative form-group" for="client_id">
                                                <label>Sélectionnez un client</label>
                                                <select class="mb-2 form-control-lg form-control" name="client_id">
                                                    @foreach($clients as $client)
                                                        <option
                                                            value="{{$client->id}}"{{ old('client_id', $project->client_id) == $client->id ? 'selected' : ''}}> {{$client->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--/client--}}
                                    <div class="form-row">
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="start_date"> Date de début </label>
                                                <input type="date" class="form-control"
                                                       value="{{$project->start_date}}"
                                                       name="start_date">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="deadline"> Date limite</label>
                                                <input type="date" class="form-control" id="deadline"
                                                       name="deadline" value="{{$project->deadline}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label> L'état du projet </label>
                                                <select class="mb-2 form-control form-control" name="status">
                                                    <option value="0"
                                                        {{$project->status == '0' ? 'selected' : ''}}>
                                                        {{__('messages.not Started') }}
                                                    </option>
                                                    <option value="1"
                                                        {{$project->status == '1' ? 'selected' : ''}}>
                                                        {{__('messages.on Hold') }}
                                                    </option>
                                                    <option value="2"
                                                        {{$project->status == '2' ? 'selected' : ''}}>
                                                        {{__('messages.In Progress') }}
                                                    </option>
                                                    <option value="3"
                                                        {{$project->status == '3' ? 'selected' : ''}}>
                                                        {{__('messages.canceled') }}
                                                    </option>
                                                    <option value="4"
                                                        {{$project->status == '4' ? 'selected' : ''}}>
                                                        {{__('messages.finished') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12">

                                            <label for="">Statut d'achèvement du projet</label>
                                            <input type="text" class="js-range-slider" name="my_range"
                                                   value="{{$project->progress_bar}}"/>
                                        </div>
                                    </div>

                                    <div class="divider"></div>
                                    <br>
                                    <div class="col">
                                        <label for="description"><strong> Déscription du projet </strong></label>
                                        <textarea id="textarea" name="description">{{$project->description}}</textarea>
                                    </div>

                                    <div class="d-block  card-footer">
                                        <button class="btn-wide btn btn-success" type="submit"><i
                                                class="fas fa-check"></i> {{ __('messages.update') }}</button>
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

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            branding: false,
            plugins: "fullscreen",
            menubar: false,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            },
            //  toolbar: "fullscreen",
        });

        //      tinymce.activeEditor.execCommand('mceFullScreen');

    </script>
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script>
        $(".js-range-slider").ionRangeSlider({
            skin: "modern",
            grid: true,
            prefix: "%",
        });
    </script>
@endsection
