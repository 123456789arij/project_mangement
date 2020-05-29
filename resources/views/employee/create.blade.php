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
                    <i class="far fa-user icon-gradient bg-arielle-smile"></i>
                </div>
                <div> Employée</div>
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
                    Ajouter un nouveau Employée
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                {{--                                    <h5 class="card-title">Grid Rows</h5>--}}
                                <form method="POST" action="{{ route('employee.store') }}" class="container"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{--                                      upload image--}}
                                    <div class="form-row">
                                        <div class="col-md-4" id="im">
                                            <div class="avatarContainer">
                                                <label> Image Upload</label>
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' name="image" value="{{ old('image') }}"
                                                               id="imageUpload"/>
                                                        <label for="imageUpload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="clock"
                                                             style="background-image: url(https://4.bp.blogspot.com/-H232JumEqSc/WFKY-6H-zdI/AAAAAAAAAEw/DcQaHyrxHi863t8YK4UWjYTBZ72lI0cNACLcB/s1600/profile%2Bpicture.png);">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="name"> {{ __('messages.name') }}</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="email">{{ __('messages.email') }}</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       class="@error('email', 'login') is-invalid @enderror" required>
                                                @error('email', 'login')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="password">{{ __('messages.Password') }}</label>
                                                <input type="password" data-toggle="password" class="form-control"
                                                       id="password"
                                                       name="password" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  /partie email +adresse--}}

                                    <div class="form-row">
                                        {{--  date d'inscription--}}
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="joining_date"> {{ __('messages.Joining_Date') }}  </label>
                                                <input type="date" class="form-control" id="joining_date"
                                                       name="joining_date">
                                            </div>
                                        </div>
                                        {{-- date d'inscription--}}
                                        {{--   sex--}}
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="gender"> {{ __('messages.gender') }} </label>
                                                <select class="mb-2 form-control form-control" name="gender"
                                                        id="projet_id">
                                                    <option value="1" @if (old('gender')=="femme")  checked @endif >
                                                        {{ __('messages.female') }}
                                                    </option>
                                                    <option value="2" @if (old('gender')=="homme")  checked @endif>
                                                        {{ __('messages.male') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        {{--/sex--}}
                                    </div>


                                    <div class="position-relative form-group">
                                        <div class="col-12  purple-border">
                                            <label for="address">Adresse</label>
                                            <textarea name="address" id="exampleText" rows="5" class="form-control">
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="position-relative form-group">
                                        <div class="col-12">
                                            <label for="skills">Compétence</label>
                                            <input id="basic" type="text" name="skills" class="form-control"
                                                   placeholder="Compétence">
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
                                                       value="1" @if (old('role')=="employee")  checked @endif >
                                                <label class="custom-control-label" for="1">
                                                    Employée
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="role" id="2"
                                                       value="2" @if (old('role')=="admin")  checked @endif >
                                                <label class="custom-control-label" for="2">
                                                    Chef De Projet
                                                </label>
                                            </div>
                                        </div>
                                        {{--    Département--}}
                                        <div class="col-md-6">
                                            <div class="position-relative form-group" for="department_id">
                                                <label>Département</label>
                                                <select class="mb-2 form-control-lg form-control"
                                                        name="department_id">
                                                    <option value="">Choose....</option>

                                                    @foreach( $departments as $department)
                                                        <option
                                                            value="{{$department->id}}"> {{$department->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{--/departement--}}
                                    </div>

                                    <br><br><br>
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

