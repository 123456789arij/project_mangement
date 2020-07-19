@extends('layouts.base')
@section('cssBlock')
    <style>
        #name {
            text-transform: capitalize;
            text-align: justify;
        }

        .pull-right {
            float: right !important;
        }

        #create_department_btn {
            color: white;
            font-size: 18px;
        }

        #create_department_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }


        a:hover {
            text-decoration: none;
        }

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
    </style>
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-building icon-gradient bg-premium-dark">
                    </i>
                </div>
                <div>   {{ __('messages.departments') }}
                    {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components
                        </div>--}}
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                        <i class="fa fa-plus">
                            <a href="{{ route('department.create') }}" id="create_department_btn"> Ajouter un nouveau
                                Départment </a>&nbsp;&nbsp;
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
                <div class="card-header">{{ __('messages.departments') }}</div>
                <br>
                @if(auth()->user())
                    {{--                    search--}}
             {{--       <form action="{{route('department')}}"
                          class="form-inline d-flex mb-5 active-purple-3 active-purple-4 d-flex "
                          method="get" role="search">
                        <div style="float: right" class="container">
                            <input type="text" name="search" placeholder="search" id="search">
                            <button><i class="fas fa-search active" aria-hidden="true" type="submit"></i></button>
                        </div>
                    </form>--}}
                    <div style="padding-left: 700px">
                        <form class="form-inline my-2 my-lg-0" action="{{route('department')}}">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                                   name="search">
                            <button class="btn btn-light my-2 my-sm-0" style="background: #ffe6ff" type="submit"><i
                                    class="fa fa-search"
                                    style="color: #cc00cc"></i>
                            </button>
                        </form>
                    </div>
                    {{--                    search--}}
                @endif
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr class="text-center">
                            <th scope="col" style="text-align: justify"> {{ __('messages.departments') }}</th>
                            <th colspan="3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="container text-center">
                        @foreach($departments as $department)
                            <tr>
                                <td class="text-center text-muted">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading" id="name">
                                                    <a href="{{route('department.show',$department->id)}}"> {{ $department->name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>


                                <td class="text-center">
                                    <div class="btn-group dropdown m-r-10 open">
                                        <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                type="button">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul role="menu" class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{route('department.edit',$department->id)}}">
                                                    <strong>
                                                        <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                           style="font-size:20px;"></i>
                                                        {{ __('messages.edit') }}
                                                    </strong>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('department.show',$department->id)}}">
                                                    <strong> <i
                                                            class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                            style="font-size: 20px;"></i>
                                                        {{ __('messages.show') }}
                                                    </strong>
                                                </a>
                                            </li>

                                            <li>
                                                <form action="{{route('department.destroy',$department->id)}}"
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
