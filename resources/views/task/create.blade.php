@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
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
                <div><strong>{{ __('messages.tasks') }}</strong></div>
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
                    <strong>{{ __('messages.add_new_task') }}</strong>
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                @if(auth()->user()&& auth()->user()->role_id ==  1)
                                    <form method="POST" action="{{ route('task.store') }}" class="container"
                                          enctype="multipart/form-data">
                                        {{--  partie email +adresse--}}
                                        {{csrf_field()}}
                                        <div class="form-row">

                                            <div class="col-12 ">
                                                <div class="position-relative form-group">
                                                    <label> <strong>{{ __('messages.title') }}</strong></label>
                                                    <input type="text" class="form-control" id="titre" name="title"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group" for="projet_id">
                                                    <label><strong>{{ __('messages.project') }}</strong></label>
                                                    <select class="mb-2 form-control-lg form-control" name="project_id"
                                                            id="project_id">
                                                        <option value="">{{ __('messages.selectproject') }}</option>
                                                        @foreach( $projects as $project )
                                                            <option
                                                                value="{{$project->id}}"> {{$project->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{--bouton radio--}}
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label>
                                                        <strong>{{ __('messages.Priority') }} </strong>
                                                    </label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="priority"
                                                               value="1"
                                                               @if (old('priority')=="Medium")  checked @endif >
                                                        <label class="form-check-label">
                                                            Medium
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="priority"
                                                               value="2"
                                                               @if (old('priority')=="Low")  checked @endif >
                                                        <label class="form-check-label">
                                                            Low
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="priority"
                                                               value="3"
                                                               @if (old('priority') == "High") checked @endif >
                                                        <label class="form-check-label" for="exampleRadios3">
                                                            High
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- /bouton radio--}}
                                        </div>

                                        <div class="form-row">
                                            <div class="col-4">
                                                <div class="position-relative form-group">
                                                    <label for="start_date">
                                                        <strong> {{ __('messages.Start Date') }}  </strong> </label>
                                                    <input type="date" class="form-control date"
                                                           name="start_date" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="position-relative form-group">
                                                    <label for="end_date">
                                                        <strong> {{ __('messages.due date') }}</strong></label>
                                                    <input type="date" class="form-control date"
                                                           name="end_date" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="position-relative form-group">
                                                    <label> <strong> {{ __('messages.assigned to') }}</strong></label>
                                                    <select name="ids[]" multiple
                                                            class="mb-2 form-control-lg form-control">
                                                        @foreach($employees as $emplyoee)
                                                            <option
                                                                value="{{$emplyoee->id}}"> {{$emplyoee->name}} </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="divider"></div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label
                                                    for="description"><strong> {{ __('messages.task description') }}  </strong></label>
                                                <textarea id="textarea" name="description"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="image_name"> importer vos fichier :</label>
                                                {{--                                            <span id="drag-drop-area"  name="image_name"> </span>--}}
                                                <input type="file" name="file[]" multiple/>

                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="d-block text-center">
                                            <button class="btn btn-lg btn-success" type="submit"
                                                    style="float:left;">{{ __('messages.Save') }}</button>
                                        </div>

                                    </form>
                                @endif
                                @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                        <form method="POST" action="{{ route('employee.task.store') }}" class="container"
                                              enctype="multipart/form-data">
                                            {{--  partie email +adresse--}}
                                            {{csrf_field()}}
                                            <div class="form-row">

                                                <div class="col-12 ">
                                                    <div class="position-relative form-group">
                                                        <label> <strong>{{ __('messages.title') }}</strong></label>
                                                        <input type="text" class="form-control" id="titre" name="title"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group" for="projet_id">
                                                        <label><strong>{{ __('messages.project') }}</strong></label>
                                                        <select class="mb-2 form-control-lg form-control" name="project_id"
                                                                id="project_id">
                                                            <option value="">{{ __('messages.selectproject') }}</option>
                                                            @foreach( $projects as $project )
                                                                <option
                                                                    value="{{$project->id}}"> {{$project->name}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--bouton radio--}}
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label>
                                                            <strong>{{ __('messages.Priority') }} </strong>
                                                        </label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="priority"
                                                                   value="1"
                                                                   @if (old('priority')=="Medium")  checked @endif >
                                                            <label class="form-check-label">
                                                                Medium
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="priority"
                                                                   value="2"
                                                                   @if (old('priority')=="Low")  checked @endif >
                                                            <label class="form-check-label">
                                                                Low
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="priority"
                                                                   value="3"
                                                                   @if (old('priority') == "High") checked @endif >
                                                            <label class="form-check-label" for="exampleRadios3">
                                                                High
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- /bouton radio--}}
                                            </div>

                                            <div class="form-row">
                                                <div class="col-4">
                                                    <div class="position-relative form-group">
                                                        <label for="start_date"><strong> {{ __('messages.Start Date') }}  </strong>  </label>
                                                        <input type="date" class="form-control date"
                                                               name="start_date" required>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="position-relative form-group">
                                                        <label for="end_date">
                                                            <strong> {{ __('messages.due date') }}</strong></label>
                                                        <input type="date" class="form-control date"
                                                               name="end_date">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="position-relative form-group">
                                                        <label> <strong> {{ __('messages.assigned to') }}</strong></label>
                                                        <select name="ids[]" multiple
                                                                class="mb-2 form-control-lg form-control">
                                                            @foreach($employees as $emplyoee)
                                                                <option
                                                                    value="{{$emplyoee->id}}"> {{$emplyoee->name}} </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="divider"></div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label
                                                        for="description"><strong> {{ __('messages.task description') }}  </strong></label>
                                                    <textarea id="textarea" name="description"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="image_name"> importer vos fichier :</label>
                                                    {{--                                            <span id="drag-drop-area"  name="image_name"> </span>--}}
                                                    <input type="file" name="file[]" multiple/>

                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="d-block text-center">
                                                <button class="btn btn-lg btn-success" type="submit"
                                                        style="float:left;">{{ __('messages.Save') }}</button>
                                            </div>

                                        </form>
                                @endif
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
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/z16d94mf443baw8z854loin2821iav5xoeeauwqbzs789l2h/tinymce/5/tinymce.min.js"
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
    </script>

    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd"
        });
    </script>
    {{--    dropezonne--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endsection
