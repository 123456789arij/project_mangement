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

        .ml-3, .mx-3 {
            margin-left: 1rem !important;
        }

        .w-75 {
            width: 75% !important;
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
{{--                        {{ $clientsCount }}--}}
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
            {{--    <form action="{{route('client.index')}}"
                      class="form-inline d-flex mb-5 active-purple-3 active-purple-4 d-flex "
                      method="get" role="search">
                    <div style="float: right" class="container">
                        <input type="text" name="search" placeholder="search" id="search">
                        <button><i class="fas fa-search active" aria-hidden="true" type="submit"></i></button>
                    </div>
                </form>--}}
                {{--search--}}
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover"
                           class="display">
                        <thead class="text-center">
                        <tr>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.email') }}</th>
                            <th>{{ __('messages.company name') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th colspan="3">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
               @foreach($clients as $client)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                {{--<div class="widget-heading" id="name">
                                                    <a href="{{route('client.show',$client->id)}}"> {{ $client->name }} </a>
                                                </div>--}}
                                             {{--                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"> {{ $client->email }}</td>
                                <td class="text-center"> {{ $client->user->name}}</td>
                                <td class="text-center">
                                    <div class="badge badge-warning">{{ $client->created_at }}</div>
                                </td>
                                <td>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{ route('client.edit', $client->id) }}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                </td>
                                {{--                                    button show--}}
                                <td>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">
                                        <a href="{{route('client.show',['id' => $client->id]) }})}}">
                                            <i class="pe-7s-info  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                </td>
                               {{--  button delete--}}
                                <td>
                                    <form action="{{route('client.destroy',['id' => $client->id])}}" method="post"
                                          class="delete-confirm">
                                        @csrf
                                        @method('DELETE')
                                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                                            <i class="pe-7s-trash btn-icon-wrapper" style="font-size: 20px;"> </i>
                                        </button>
                                    </form>
                                </td>

                            </tr>


                        @endforeach
                        </tbody>
                    </table>

                    <footer class="card-footer" style="float: right">

{{--                        {{ $clients->links() }}--}}
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
