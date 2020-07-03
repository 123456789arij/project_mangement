@extends('layouts.base')
@section('cssBlock')

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
                <div><strong> {{ __('messages.clients') }}</strong></div>
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
                    <strong>  {{__('messages.add_client') }}</strong>
                </div>

                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title"><strong> {{__('messages.CLIENT_DETAILS') }}</strong></h5>
                                <hr>
                                <form method="POST" action="{{ route('client.store') }}">
                                    @csrf     {{--  partie email +adresse--}}
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="name"> <strong> {{__('messages.name') }} </strong></label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="email"> <strong> {{__('messages.email') }}</strong></label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       class="@error('email', 'login') is-invalid @enderror" required>
                                                @error('email', 'login')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="password">
                                                    <strong> {{__('messages.Password') }} </strong></label>
                                                <input type="password" data-toggle="password" class="form-control"
                                                       id="password"
                                                       name="password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="mobile">
                                                    <strong>  {{__('messages.mobile') }}</strong></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile">
                                            </div>
                                        </div>
                                    </div>


                                    <div class=" form-row">
                                        <div class="col-12">
                                            <label for="address"><strong> {{__('messages.Address') }}</strong></label>
                                            <textarea name="address" id="exampleText" class="form-control">
                                            </textarea>

                                        </div>
                                    </div>
                                    <br><br>


                                    <h5 class="card-title"><strong> {{__('messages.CLIENT_OTHER_DETAILS') }} </strong>
                                    </h5>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="linked_in"> <strong>  {{__('messages.Linkedin') }} </strong></label>
                                                <input type="text" class="form-control" id="linked_in" name="linked_in">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="facebook"> <strong>   {{__('messages.Facebook') }} </strong></label>
                                                <input type="text" class="form-control" id="facebook" name="facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="skype"> <strong> {{__('messages.Skype') }}</strong></label>
                                                <input type="text" class="form-control" id="skype" name="skype">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="d-block text-center" style="float: left">
                                        <button class="btn-wide btn btn-success"
                                                type="submit">{{__('messages.Save') }}</button>
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
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
@endsection
