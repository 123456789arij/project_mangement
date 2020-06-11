@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">

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
                <div><h4 class="page-title">
                        {{__('messages.task') }} # {{$task->id}} - {{$task->title}}
                    </h4></div>
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
                               <a href="{{route('Entreprise.Employee.create')}}"
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

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif

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
                    MISE À JOUR DE LA TÂCHE
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                <form method="POST" action="{{ route('task.update',$task->id) }}" class="container">
                                    {{--  partie email +adresse--}}
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-row">
                                        <div class="col-12 ">
                                            <div class="position-relative form-group">
                                                <label> Titre </label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                       value="{{$task->title}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group" for="projet_id">
                                                <label><strong>Projet </strong></label>
                                                <select class="mb-2 form-control-lg form-control" name="project_id">
                                                    <option value="">select projet</option>
                                                    @foreach( $projects as $project )
                                                        <option
                                                            value="{{$project->id}}" {{old('project_id',$project->id) == $project->id ? 'selected' : ''}}> {{$project->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="position-relative form-group" style="float: right">
                                                <label class="text-center"> Assigné à</label>
                                                <select name="ids[]" class="mb-2 form-control-lg form-control" multiple>
                                                    @foreach($employees as $emplyoee)
                                                        <option
                                                            value="{{$emplyoee->id}}" {{ (collect(old('ids'))->contains($emplyoee->id)) ? 'selected':'' }} {{in_array($emplyoee->id, old("ids") ?: []) ? "selected": ""}}> {{$emplyoee->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="start_date"> Date de début </label>
                                                <input type="date" class="form-control" id="start_date"
                                                       name="start_date" value="{{$task->start_date}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="end_date"> Date limite</label>
                                                <input type="date" class="form-control"
                                                       name="end_date" value="{{$task->end_date}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="status"> Statut</label>
                                                <select class="mb-2 form-control form-control" name="status">
                                                    <option value="1" {{$task->status == '1' ? 'selected' : ''}} >
                                                        {{ __('messages.Completed') }}
                                                    </option>
                                                    <option value="2" {{$task->status == '2' ? 'selected' : ''}} >
                                                        {{ __('messages.Incomplete') }}
                                                    </option>
                                                    <option value="3" {{$task->status == '3' ? 'selected' : ''}} >
                                                        {{ __('messages.In Progress') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- Priorité --}}
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label>
                                                <strong> Priorité </strong>
                                            </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="priority"
                                                       value="0" {{ $task->priority == '1' ? 'checked' : ''}}>
                                                <label class="form-check-label">
                                                    Medium
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="priority"
                                                       value="1" {{ $task->priority == '2' ? 'checked' : ''}}>
                                                <label class="form-check-label">
                                                    Low
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="priority"
                                                       value="2"{{ $task->priority == '3' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    High
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Priorité--}}
                                    <div class="divider"></div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label  class="control-label"><strong> Déscription du Tâche </strong></label>
                                            <textarea id="description" name="description" class="form-control summernote">
                                                       {{$task->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label for="image_name"> importer vos fichier :</label>
                                            {{--                                            <span id="drag-drop-area"  name="image_name"> </span>--}}
                                            <input type="file" name="file_name"/>
                                        </div>
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
{{--    <script src="https://cdn.tiny.cloud/1/z16d94mf443baw8z854loin2821iav5xoeeauwqbzs789l2h/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            branding: false,
            plugins: "fullscreen",
            menubar: false,
            //  toolbar: "fullscreen",
        });
    </script>--}}
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            height: 100,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ["view", ["fullscreen"]]
            ]
        });

    </script>
@endsection
