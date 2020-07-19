@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" type="text/css" href="{{asset('dropzone/dist/min/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
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
                <div> <strong>{{ __('messages.projects') }}</strong></div>
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
                   <strong>{{ __('messages.add_new_Project') }}</strong>
                </div>
                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                <form method="POST" action="{{route('project.store')}}" enctype="multipart/form-data">
                                    {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        {{csrf_field()}}
                                        <div class="col-12 ">
                                            <div class="position-relative form-group">
                                                <label for="name"> <strong>{{ __('messages.project name') }}</strong> </label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label><strong>{{ __('messages.ProjectCategory') }}</strong></label>
                                                <select class="mb-2 form-control-lg form-control" name="category_id">
                                                    <option value=""> {{ __('messages.selectCategory') }}</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{$category->id}}"> {{$category->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--client--}}
                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="position-relative form-group" for="client_id">
                                                <label><strong> {{ __('messages.client') }}</strong></label>
                                                <select class="mb-2 form-control-lg form-control" name="client_id">
                                                    <option value="">{{ __('messages.selectClient') }}</option>
                                                    @foreach($clients as $client)
                                                        <option
                                                            value="{{$client->id}}"> {{$client->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--/client--}}
                                    <div class="form-row">
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="start_date"><strong> {{ __('messages.Start Date') }}  </strong></label>
                                                <input type="date" class="form-control" id="start_date"
                                                       name="start_date" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="deadline"><strong> {{ __('messages.due date') }}</strong></label>
                                                <input type="date" class="form-control" id="deadline"
                                                       name="deadline" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="status"> <strong>Ètat du projet </strong></label>
                                                <select class="mb-2 form-control form-control" name="status" required>
                                                    <option value="1"
                                                            @if (old('status')=="pas encore commencé")  checked @endif >
                                                        pas encore commencé
                                                    </option>
                                                    <option value="2"
                                                            @if (old('status')=="en attente")  checked @endif>
                                                        en attente
                                                    </option>
                                                    <option value="3"
                                                            @if (old('status')=="en cour")  checked @endif>
                                                        en cour
                                                    </option>
                                                    <option value="4"
                                                            @if (old('status')=="annulé")  checked @endif>
                                                        annulé
                                                    </option>
                                                    <option value="5"
                                                            @if (old('status')=="fini")  checked @endif>
                                                        fini
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="divider"></div>
                                    <br>
                                        <div class="col">
                                            <label
                                                for="description" class="control-label"><strong>  {{ __('messages.Project description') }} </strong></label>
                                            <textarea id="textarea" name="description"  class="form-control summernote"></textarea>
                                        </div>
                                    <br>
                                    <label for="file"><strong> {{ __('messages.file') }}</strong></label>
                                    <input type="file" name="file" class="form-control-file container">
                                    <br><br><br>
                                    <div class="d-block text-center">
                                        <button class="btn btn-lg btn-success" type="submit" style="float:left;" >{{ __('messages.Save') }}</button>
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
   {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            branding: false,
            plugins: "fullscreen",
            menubar: false,
            //  toolbar: "fullscreen",
        });

        //      tinymce.activeEditor.execCommand('mceFullScreen');

    </script>--}}
    <!-- JS -->
    <script src="{{asset('dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>
@endsection
