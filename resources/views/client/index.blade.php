@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        #crud_btn, form {
            display: flex;
            height: 40px;
        }

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
    </style>
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
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
                         <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                          </span>
                        <a href="{{route('client.create')}}"
                           style="color: white;font-size: 15px;">  {{__('messages.add_new_client') }}</a>&nbsp;&nbsp;
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

                <div class="card-header">{{ __('messages.clients') }}
                </div>
                <br>
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example"
                           class="display">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">{{ __('messages.name') }}</th>
                            <th scope="col">{{ __('messages.email') }}</th>
                            <th scope="col">{{ __('messages.company name') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th scope="col">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            {{--  <div class="widget-content-left mr-3">
                                                  <div class="widget-content-left">
                                                         img
                                                  </div>
                                              </div>--}}
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading" id="name">
                                                    {{ $client->name }}   </div>
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
                                <td class="text-center" id="crud_btn">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{ route('client.edit', $client->id) }}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                    {{--                                    button show--}}
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">
                                        <a href="{{route('client.show',['id' => $client->id]) }})}}">
                                            <i class="pe-7s-info  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                    {{--                                    button delete--}}
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

                        {{ $clients->links() }}
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });
        });
    </script>
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
