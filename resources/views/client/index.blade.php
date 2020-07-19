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
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-user-friends icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Client Dashboard
                    <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{ $clientsCount }}
                    </span></span>
                    {{ __('messages.total_clients') }}
                </div>
            </div>
            {{--   /page-title-wrapper--}}
            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                        <i class="fas fa-user-plus" style="font-size: 15px;">
                            &nbsp;&nbsp;
                            <a href="{{route('client.create')}}" id="create_client_btn">
                                {{__('messages.add_new_client') }}</a>
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--/app-page-title--}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div><br/>
                @endif
                <div class="card-header">{{ __('messages.clients') }}</div>
                <br>
                <div style="padding-left: 700px">
                    <form class="form-inline my-2 my-lg-0" action="{{route('client.index')}}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               name="search">
                        <button class="btn btn-light my-2 my-sm-0" style="background: #ffe6ff" type="submit"><i
                                class="fa fa-search"
                                style="color: #cc00cc"></i>
                        </button>
                    </form>
                </div>
                {{--search--}}
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover"
                           class="display">
                        <thead>
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
                                                <div class="widget-heading" id="name">
                                                    <a href="{{route('client.show',$client->id)}}"> {{ $client->name }} </a>
                                                </div>
                                                {{--                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-justify"> {{ $client->email }}</td>
                                <td class="text-justify"> {{ $client->user->name}}</td>
                                <td class="text-justify">
                                    <div class="badge badge-warning">{{ $client->created_at }}</div>
                                </td>
                                <td>
                                    <div class="btn-group dropdown m-r-10 open">
                                        <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                type="button">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul role="menu" class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ route('client.edit', $client->id) }}">
                                                    <strong>
                                                        <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                           style="font-size:20px;"></i>
                                                        {{ __('messages.edit') }}
                                                    </strong>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('client.show',['id' => $client->id]) }})}}">
                                                    <strong> <i
                                                            class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                            style="font-size: 20px;"></i>
                                                        {{ __('messages.show') }}
                                                    </strong>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{route('client.destroy',['id' => $client->id])}}"
                                                      method="post"
                                                      class="delete-confirm">
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
                    <br>
                    <span style="float: right">{{ $clients->links() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        /*

                $(document).on('click', '.delete-confirm', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    swal({
                            title: "Are you sure!",
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes!",
                            showCancelButton: true,
                        },
                        function() {
                            $.ajax({
                                type: "POST",
                                url: "{{url('/destroy')}}",
                        data: {id:id},
                        success: function (data) {
                            //
                        }
                    });
                });
        });
*/








        /*   $('.delete-confirm').on('click', function () {
               // return confirm('Are you sure want to delete?');
               event.preventDefault();//this will hold the url
               swal({
                   title: "Are you sure?",
                   text: "Once clicked, this will be softdeleted!",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               })
                   .then((willDelete) => {
                       if (willDelete) {
                           swal("Done! category has been softdeleted!", {
                               icon: "success",
                               button: false,
                           });
                           location.reload(true);//this will release the event
                       } else {
                           swal("Your imaginary file is safe!");
                       }
                   });
           });
*/

    </script>
@endsection
