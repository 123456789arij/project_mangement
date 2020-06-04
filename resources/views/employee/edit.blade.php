@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        #im {
            float: right;
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

        /* /bordure de adresse*/
    </style>
@endsection

@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-user-edit icon-gradient bg-arielle-smile"></i>
                </div>
                <div>

                    <h4 class="page-title">
                        {{__('messages.employees') }} # {{$employee->id}} [ {{$employee->name}} ]
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
                    {{ __('messages.UPDATE_EMPLOYEE_INFO') }}
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                @if(auth()->user())
                                    <form method="POST" action="{{ route('employee.update',$employee->id) }}"
                                          class="container"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        {{--                                      upload image--}}
                                        <div class="form-row">
                                            <div class="col-md-4" id="im">
                                                <div class="avatarContainer">
                                                    <label for="image"> Image Upload</label>
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' name="image"
                                                                   value="{{$employee->image}}"
                                                                   id="imageUpload"/>
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="avatar-preview">

                                                            @if ("/images/{{$employee->image}}")
                                                                <div id="clock"
                                                                     style="background-image: url({{asset($employee->image)}});"
                                                                     class="rounded-circle"
                                                                     height="40px" width="40px">
                                                                </div>

                                                            @else
                                                                <div id="clock"
                                                                     style="background-image: url(https://4.bp.blogspot.com/-H232JumEqSc/WFKY-6H-zdI/AAAAAAAAAEw/DcQaHyrxHi863t8YK4UWjYTBZ72lI0cNACLcB/s1600/profile%2Bpicture.png);">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="name"> NOM </label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{$employee->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           value="{{$employee->email }}"
                                                           class="@error('email', 'login') is-invalid @enderror"
                                                           required>
                                                    @error('email', 'login')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" data-toggle="password" class="form-control"
                                                           id="password"
                                                           name="password">
                                                </div>
                                            </div>
                                        </div>
                                        {{--  /partie email +adresse--}}

                                        <div class="form-row">
                                            {{--  date d'inscription--}}
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="joining_date"> date d'inscription </label>
                                                    <input type="date" class="form-control" id="joining_date"
                                                           value="{{$employee->joining_date}}"
                                                           name="joining_date">
                                                </div>
                                            </div>
                                            {{-- date d'inscription--}}
                                            {{--   sex--}}
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="gender"> sex </label>
                                                    <select class="mb-2 form-control form-control" name="gender">
                                                        <option
                                                            value="1" {{$employee->gender == '1' ? 'selected' : ''}}>
                                                            femme
                                                        </option>
                                                        <option
                                                            value="2" {{$employee->gender == '2' ? 'selected' : ''}}>
                                                            homme
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{--/sex--}}
                                            {{--mobile--}}
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="mobile"> Mobile </label>
                                                    <input type="tel" class="form-control" id="mobile"
                                                           value="{{$employee->mobile}}"
                                                           name="mobile">
                                                </div>
                                            </div>
                                            {{--/mobile--}}
                                        </div>


                                        <div class="position-relative form-group">
                                            <div class="col-12 purple-border">
                                                <label for="address">Adresse</label>
                                                <textarea name="address" rows="5" id="exampleText" class="form-control">
                                          {{$employee->address}}  </textarea>
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <div class="col-12">
                                                <label for="skills">Compétence</label>
                                                <input id="basic" type="text" name="skills" class="form-control"
                                                       value="{{$employee->skills}}">
                                            </div>
                                        </div>
                                        {{--  row role et departement--}}
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="role">
                                                    <strong> role</strong>
                                                </label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="1" type="radio" name="role"
                                                           value="1" {{ $employee->role == '1' ? 'checked' : ''}} >
                                                    <label class="custom-control-label" for="1">
                                                        Employée
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="role" id="2"
                                                           value="2" {{ $employee->role == '2' ? 'checked' : ''}} >
                                                    <label class="custom-control-label" for="2">
                                                        Chef de projet
                                                    </label>
                                                </div>
                                            </div>
                                            {{--    Département--}}
                                            <div class="col-md-6">
                                                <div class="position-relative form-group" for="department_id">
                                                    <label>Département</label>
                                                    <select class="mb-2 form-control-lg form-control"
                                                            name="department_id">
                                                        @foreach( $departments as $department)
                                                            <option
                                                                value="{{$department->id}}"{{ old('department_id', $employee->department_id) == $department->id ? 'selected' : ''}}> {{$department->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{--/departement--}}
                                        </div>

                                        <div class="d-block  card-footer">
                                            <button class="btn-wide btn btn-success" type="submit"><i
                                                    class="fas fa-check"></i> {{ __('messages.update') }}</button>
                                        </div>

                                    </form>
                                @endif
                                @if(auth()->guard('employee')->user())
                                    <form method="POST" action="{{ route('chef.employee.update',$employee->id) }}"
                                          class="container"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        {{--                                      upload image--}}
                                        <div class="form-row">
                                            <div class="col-md-4" id="im">
                                                <div class="avatarContainer">
                                                    <label for="image"> Image Upload</label>
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' name="image"
                                                                   value="{{$employee->image}}"
                                                                   id="imageUpload"/>
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="avatar-preview">

                                                            @if ("/images/{{$employee->image}}")
                                                                <div id="clock"
                                                                     style="background-image: url({{asset($employee->image)}});"
                                                                     class="rounded-circle"
                                                                     height="40px" width="40px">
                                                                </div>

                                                            @else
                                                                <div id="clock"
                                                                     style="background-image: url(https://4.bp.blogspot.com/-H232JumEqSc/WFKY-6H-zdI/AAAAAAAAAEw/DcQaHyrxHi863t8YK4UWjYTBZ72lI0cNACLcB/s1600/profile%2Bpicture.png);">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="name"> NOM </label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{$employee->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           value="{{$employee->email }}"
                                                           class="@error('email', 'login') is-invalid @enderror"
                                                           required>
                                                    @error('email', 'login')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" data-toggle="password" class="form-control"
                                                           id="password"
                                                           name="password">
                                                </div>
                                            </div>
                                        </div>
                                        {{--  /partie email +adresse--}}

                                        <div class="form-row">
                                            {{--  date d'inscription--}}
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="joining_date"> date d'inscription </label>
                                                    <input type="date" class="form-control" id="joining_date"
                                                           value="{{$employee->joining_date}}"
                                                           name="joining_date">
                                                </div>
                                            </div>
                                            {{-- date d'inscription--}}
                                            {{--   sex--}}
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="gender"> sex </label>
                                                    <select class="mb-2 form-control form-control" name="gender">
                                                        <option
                                                            value="1" {{$employee->gender == '1' ? 'selected' : ''}}>
                                                            femme
                                                        </option>
                                                        <option
                                                            value="2" {{$employee->gender == '2' ? 'selected' : ''}}>
                                                            homme
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{--/sex--}}
                                            {{--mobile--}}
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="mobile"> Mobile </label>
                                                    <input type="tel" class="form-control" id="mobile"
                                                           value="{{$employee->mobile}}"
                                                           name="mobile">
                                                </div>
                                            </div>
                                            {{--/mobile--}}
                                        </div>


                                        <div class="position-relative form-group">
                                            <div class="col-12 purple-border">
                                                <label for="address">Adresse</label>
                                                <textarea name="address" rows="5" id="exampleText" class="form-control">
                                          {{$employee->address}}  </textarea>
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <div class="col-12">
                                                <label for="skills">Compétence</label>
                                                <input id="basic" type="text" name="skills" class="form-control"
                                                       value="{{$employee->skills}}">
                                            </div>
                                        </div>
                                        {{--  row role et departement--}}
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="role">
                                                    <strong> role</strong>
                                                </label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="1" type="radio" name="role"
                                                           value="1" {{ $employee->role == '1' ? 'checked' : ''}} >
                                                    <label class="custom-control-label" for="1">
                                                        Employée
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="role" id="2"
                                                           value="2" {{ $employee->role == '2' ? 'checked' : ''}} >
                                                    <label class="custom-control-label" for="2">
                                                        Chef de projet
                                                    </label>
                                                </div>
                                            </div>
                                            {{--    Département--}}
                                            <div class="col-md-6">
                                                <div class="position-relative form-group" for="department_id">
                                                    <label>Département</label>
                                                    <select class="mb-2 form-control-lg form-control"
                                                            name="department_id">
                                                        @foreach( $departments as $department)
                                                            <option
                                                                value="{{$department->id}}"{{ old('department_id', $employee->department_id) == $department->id ? 'selected' : ''}}> {{$department->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{--/departement--}}
                                        </div>

                                        <div class="d-block  card-footer">
                                            <button class="btn-wide btn btn-success" type="submit"><i
                                                    class="fas fa-check"></i> {{ __('messages.update') }}</button>
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    {{--    targify skills --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.querySelector('input[id=basic]');
        // init Tagify script on the above inputs
        new Tagify(input)
    </script>
    //upload image
    <script>
        document.getElementById('imageUpload').addEventListener('change', readURL, true);

        function readURL() {
            const file = document.getElementById("imageUpload").files[0];
            const reader = new FileReader();
            reader.onloadend = function () {
                document.getElementById('clock').style.backgroundImage = "url(" + reader.result + ")";
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
            }
        }
    </script>
@endsection

