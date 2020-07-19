@extends('layouts.base')
@section('cssBlock')
    <style>
        #name {
            text-transform: capitalize;
            text-align: justify;
        }

        .label-rouded, .label-rounded {
            border-radius: 50%;
            padding: 6px 8px;
            font-weight: 400;
        }

        .label-custom {
            background-color: #01c0c8;
        }

        .pull-right {
            float: right !important;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }

        .vertical-line {
            border-left: 2px solid #A9A9A9;
            display: inline-block;
            height: 20px;
            margin: 20px 10px;
        }

        #create_client_btn {
            color: white;
            font-size: 18px;
        }

        #create_client_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        /*search */
        .active-purple-3 input[type=text] {
            border: 1px solid #ce93d8;
            box-shadow: 0 0 0 1px #ce93d8;
        }


        .active-purple .fas, .active-purple-2 .fas, .active-purple-3 .fas, .active-purple-4 .fas {
            color: #ce93d8;
        }

        .active-purple .fa, .active-purple-2 .fa {
            color: #ce93d8;
        }

        #search:hover {
            border: 1px solid #ce93d8;
        }

        button {
            border: transparent;
            background-color: transparent;
        }

        .active-purple input[type=text] {
            border-bottom: 1px solid #ce93d8;
            box-shadow: 0 1px 0 0 #ce93d8;
        }

        thead {
            text-align: justify;
        }


        .label-rouded, .label-rounded {
            border-radius: 50%;
            padding: 6px 8px;
            font-weight: 400;
        }

        .label-custom {
            background-color: #01c0c8;
        }

        .pull-right {
            float: right !important;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }

        .vertical-line {
            border-left: 2px solid #A9A9A9;
            display: inline-block;
            height: 20px;
            margin: 20px 10px;
        }


        .label-rouded, .label-rounded {
            border-radius: 50%;
            padding: 6px 8px;
            font-weight: 400;
        }

        .label-custom {
            background-color: #01c0c8;
        }

        .pull-right {
            float: right !important;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }

        .vertical-line {
            border-left: 2px solid #A9A9A9;
            display: inline-block;
            height: 20px;
            margin: 20px 10px;
        }

        a:hover {
            text-decoration: none;
        }


        /*  btn crud */
        .m-r-10 {
            margin-right: 10px !important;
        }

        .dropdown-menu > li > a {
            padding: 9px 20px;
        }

        .dropdown-menu > li > a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        /*search */
        .active-purple-3 input[type=text] {
            border: 1px solid #ce93d8;
            box-shadow: 0 0 0 1px #ce93d8;
        }


        .active-purple .fas, .active-purple-2 .fas, .active-purple-3 .fas, .active-purple-4 .fas {
            color: #ce93d8;
        }

        .active-purple .fa, .active-purple-2 .fa {
            color: #ce93d8;
        }

        #search:hover {
            border: 1px solid #ce93d8;
        }

        button {
            border: transparent;
            background-color: transparent;
        }

        .active-purple input[type=text] {
            border-bottom: 1px solid #ce93d8;
            box-shadow: 0 1px 0 0 #ce93d8;
        }

    </style>
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-user-friends icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> {{ __('messages.CompaniesDashboard') }}
                    <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
      {{ $total_entreprise }}
                    </span></span>
                    {{ __('messages.total_Companies') }}
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                        <i class="fas fa-user-plus" style="font-size: 15px;">
                            &nbsp;&nbsp;
                            <a href="{{route('super_admin.create')}}" id="create_client_btn">
                                {{__('messages.add_new_Company') }}</a>
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--                /app-page-title--}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div><br/>
                @endif

                <div class="card-header">{{ __('messages.Companies') }}</div>
                <br>
                {{--search--}}
                {{--      <form action="{{route('super_admin')}}"
                            class="d-flex mb-5 active-purple-3 active-purple-4"
                            method="get" role="search">
                          <div id="btn_search" class="container">
                              <input type="text" name="search" placeholder="search" id="search">
                              <button><i class="fas fa-search active" aria-hidden="true" type="submit"></i></button>
                          </div>
                      </form>--}}
                <div style="padding-left: 700px">
                    <form class="form-inline my-2 my-lg-0" action="{{route('super_admin')}}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               name="search">
                        <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fa fa-search"
                                                                                                  style="color: #cc00cc"></i>
                        </button>
                    </form>
                </div>

                {{--/search--}}
                <br>
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover"
                           class="display">
                        <thead>
                        <tr>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.email') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th colspan="2">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading" id="name">
                                                    {{ $user->name}}
                                                </div>
                                                {{--                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-justify"> {{ $user->email }}</td>
                                <td class="text-justify">
                                    <div class="badge badge-warning">{{ $user->created_at }}</div>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group dropdown m-r-10 open">
                                        <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                type="button">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul role="menu" class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ route('super_admin.edit.company', $user->id) }}">
                                                    <strong>
                                                        <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                           style="font-size:20px;"></i>
                                                        {{ __('messages.edit') }}
                                                    </strong>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{route('super_admin.destroy',$user->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    &nbsp;
                                                    <button class="mr-2 btn-icon btn-icon-only btn">
                                                        <strong>
                                                            <i class="fa fa-trash btn-icon-wrapper icon-gradient bg-love-kiss"
                                                               style="font-size: 20px;" id="delete">
                                                            </i> {{ __('messages.delete') }}
                                                        </strong>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>


                        @endforeach
                        </tbody>
                    </table>

                    <footer class="card-footer" style="float: right">
                        {{$users->links() }}
                    </footer>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
