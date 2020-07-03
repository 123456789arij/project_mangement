@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading container">
                <div class="page-title-icon">
                    <i class="fas fa-user-edit icon-gradient bg-arielle-smile"></i>
                </div>
                <div>
                    <h4 class="page-title"><strong>   {{__('messages.client') }}
                            # {{$client->id}}
                            [ {{$client->name}} ]
                        </strong></h4></div>
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

                {{--        @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif--}}
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

                    <strong>   {{__('messages.UPDATE_CLIENT_INFO') }} </strong>
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>      {{__('messages.CLIENT_DETAILS') }}</strong></h5>
                                <hr>
                                <form action="{{ route('client.update', $client->id ) }}" method="POST">
                                    {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        @csrf
                                        @method('PATCH')
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="name"> <strong> {{__('messages.name') }} </strong></label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{$client->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="email"> <strong> {{__('messages.email') }}</strong></label>
                                                <input type="email" class="form-control" name="email"
                                                       value="{{$client->email}}"
                                                       class="@error('email', 'login') is-invalid @enderror">
                                                @error('email', 'login')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="password">
                                                    <strong> {{__('messages.Password') }} </strong></label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        @csrf
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="mobile">
                                                    <strong>  {{__('messages.mobile') }} </strong></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                       value="{{$client->mobile}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="address">
                                                    <strong> {{__('messages.Address') }}</strong></label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                       value="{{$client->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="card-title">   <strong> {{__('messages.CLIENT_OTHER_DETAILS') }} </strong></h5>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="linked_in">   <strong> {{__('messages.Linkedin') }}</strong></label>
                                                <input type="text" class="form-control" value="{{$client->linked_in}}"
                                                       name="linked_in">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="facebook">  <strong>  {{__('messages.Facebook') }}</strong></label>
                                                <input type="text" class="form-control" value="{{$client->facebook}}"
                                                       name="facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="skype">  <strong>  {{__('messages.Skype') }}</strong></label>
                                                <input type="text" class="form-control" value="{{$client->Skype}}"
                                                       name="skype">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-block">
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
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
@endsection

