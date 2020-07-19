@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
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
                <div><h4 class="page-title">
                        <strong>{{__('messages.project') }} # {{$project->id}} - {{$project->name}}</strong>
                    </h4></div>
                {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                        elements and components
                    </div>--}}
            </div>
            {{--   /page-title-wrapper--}}

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
                    <strong>{{__('messages.UPDATE_PROJECT_DETAILS') }}</strong>
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                <form method="POST" action="{{ route('employee.project.update',$project->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        <div class="col-12 ">
                                            <div class="position-relative form-group">
                                                <label for="name"><strong>{{ __('messages.project name') }}</strong> </label>
                                                <input type="text" class="form-control" value="{{$project->name}}"
                                                       name="name">
                                            </div>
                                        </div>
                                    </div>
                                    {{--Categorie du projet--}}
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group" for="category_id">
                                                <label><strong>{{ __('messages.ProjectCategory') }}</strong></label>
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
                                                <label><strong> {{ __('messages.client') }}</strong></label>
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
                                                <label for="start_date"> <strong> {{ __('messages.Start Date') }}  </strong></label>
                                                <input type="date" class="form-control"
                                                       value="{{$project->start_date}}"
                                                       name="start_date">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="position-relative form-group">
                                                <label for="deadline"> <strong> {{ __('messages.due date') }}</strong></label>
                                                <input type="date" class="form-control" id="deadline"
                                                       name="deadline" value="{{$project->deadline}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label> L'état du projet </label>
                                                <select class="mb-2 form-control form-control" name="status">
                                                    <option value="1"
                                                        {{$project->status == '1' ? 'selected' : ''}}>
                                                        {{__('messages.not Started') }}
                                                    </option>
                                                    <option value="2"
                                                        {{$project->status == '2' ? 'selected' : ''}}>
                                                        {{__('messages.on Hold') }}
                                                    </option>
                                                    <option value="3"
                                                        {{$project->status == '3' ? 'selected' : ''}}>
                                                        {{__('messages.In Progress') }}
                                                    </option>
                                                    <option value="4"
                                                        {{$project->status == '4' ? 'selected' : ''}}>
                                                        {{__('messages.canceled') }}
                                                    </option>
                                                    <option value="5"
                                                        {{$project->status == '5' ? 'selected' : ''}}>
                                                        {{__('messages.finished') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12">
                                            <label for=""><strong> {{ __('messages.ProjectCompletionStatus') }}</strong></label>
                                            <input type="text" class="js-range-slider" name="my_range"
                                                   value="{{$project->progress_bar}}"/>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <br>
                                    <div class="col">
                                        <label for="description" class="control-label"><strong> {{ __('messages.Project description') }}  </strong></label>
                                        <textarea id="textarea" name="description" class="form-control summernote">{{$project->description}}</textarea>
                                    </div>
                                    <br><br>
                                    <div class="d-block text-center">
                                        <button class="btn btn-lg btn-success" type="submit" style="float:left;" ><i
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
{{--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
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
    </script>--}}
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
