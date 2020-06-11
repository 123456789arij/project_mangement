@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

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
                <div>{{ __('messages.Companies') }}</div>
            </div>
            {{--   /page-title-wrapper--}}
            <div style="float: right">
                <a href="{{route('super_admin')}}"  class="btn btn-outline-secondary">Back</a>
            </div>
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
                    {{__('messages.add_new_Company') }}
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"> {{__('messages.Company_DETAILS') }}</h5>
                                <hr>
                                <form method="POST" action="{{ route('super_admin.store') }}">
                                    @csrf
                                    {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="name"> {{__('messages.name') }} </label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="email">{{__('messages.email') }}</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       class="@error('email', 'login') is-invalid @enderror" required>
                                                @error('email', 'login')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="password"> {{__('messages.Password') }} </label>
                                                <input type="password" data-toggle="password" class="form-control"
                                                       id="password"
                                                       name="password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="mobile"> {{__('messages.mobile') }}</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile">
                                            </div>
                                        </div>
                                    </div>


                                    <div class=" form-row">
                                        <label for="address"> {{__('messages.Address') }}</label>
                                        <div class="col-12">
                                            <textarea name="address" id="exampleText" class="form-control">
                                            </textarea>
                                        </div>
                                    </div>
                                    <br><br>


                                    <h5 class="card-title"> {{__('messages.Company_OTHER_DETAILS') }}</h5>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label> {{__('messages.logo') }}</label>
                                                <input type="file" value="{{ old('image') }}" name="logo">
                                            </div>
                                        </div>
                                        {{--     <div class="col-md-4">
                                                 <div class="position-relative form-group">
                                                     <label for="facebook">  {{__('messages.Facebook') }}</label>
                                                     <input type="text" class="form-control" id="facebook" name="facebook">
                                                 </div>
                                             </div>
                                             <div class="col-md-4">
                                                 <div class="position-relative form-group">
                                                     <label for="skype">  {{__('messages.Skype') }}</label>
                                                     <input type="text" class="form-control" id="skype" name="skype">
                                                 </div>
                                             </div>--}}
                                    </div>


                                    <div class="d-block text-center card-footer">
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
@endsection