@extends('layouts.base')
@section('cssBlock')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">--}}
    <style>

        #employee {
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

        #create_employee_btn {
            color: white;
            font-size: 18px;
        }

        #create_employee_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
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
                    <i class="fas fa-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div><strong>  {{ __('messages.EmployeesDashboard') }}</strong>
                    <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{  $employeescount }}
                    </span>
                    </span>
                    {{ __('messages.total_Employees') }}
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                            <i class="fas fa-user-plus" style="font-size: 15px;">
                                &nbsp;&nbsp;
                                <a href="{{route('chef.employee.create')}}"
                                   id="create_employee_btn">   {{__('messages.add_new_employee') }}</a>&nbsp;&nbsp;</i>
                        </button>
                    @endif
                    @if(auth()->user()&& auth()->user()->role_id ==  1)
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                            <i class="fas fa-user-plus" style="font-size: 15px;">
                                &nbsp;&nbsp;
                                <a href="{{route('employee.create')}}"
                                   id="create_employee_btn">   {{__('messages.add_new_employee') }}</a>&nbsp;&nbsp;</i>
                        </button>
                    @endif
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
                <div class="card-header">{{ __('messages.employees') }}</div>
                <br>
                {{--                    search btn company --}}
                @if(auth()->user()&& auth()->user()->role_id ==  1)
                    <form action="{{route('employee.index')}}"
                          class="form-inline d-flex mb-5 active-purple-3 active-purple-4 d-flex "
                          method="get" role="search">
                        <div style="padding-left: 800px;" class="container">
                            <button><i class="fas fa-search active" aria-hidden="true" type="submit"></i></button>
                            <input type="text" name="search" placeholder="search" id="search">

                        </div>
                    </form>

                @endif
                @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                    <form action="{{route('chef.employee.index')}}"
                          class="form-inline d-flex mb-5 active-purple-3 active-purple-4 d-flex "
                          method="get" role="search">
                        <div style="float: right" class="container">
                            <input type="text" name="search" placeholder="search" id="search">
                            <button><i class="fas fa-search active" aria-hidden="true" type="submit"></i></button>
                        </div>
                    </form>
                @endif
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example"
                           class="display">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('messages.name') }}</th>
                            <th scope="col" id="employee">{{ __('messages.email') }}</th>
                            <th scope="col" id="employee">{{ __('messages.userRole') }}</th>
                            <th colspan="3">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img src="{{asset($employee->image)}}" class="rounded-circle"
                                                         data-toggle="tooltip" data-original-title="{{$employee->name}}"
                                                         height="40px" width="40px" alt="im"/>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">
                                                    @if(auth()->user())
                                                        <a href="{{route('employee.show',$employee->id)}}"> {{$employee->name }} </a>
                                                    @endif
                                                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                                        <a href="{{route('chef.employee.show',$employee->id)}}"> {{$employee->name }} </a>
                                                    @endif

                                                </div>
                                                <div class="widget-subheading opacity-7">{{$employee->specialty }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td id="employee"> {{ $employee->email }}</td>
                                <td id="employee">
                                    @if($employee->role  == 1)
                                        <span> Employée</span>
                                    @else
                                        <span>Chef De Projet</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if(auth()->user()&& auth()->user()->role_id ==  1)
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ route('employee.edit', $employee->id) }}">
                                                        <strong>
                                                            <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                               style="font-size:20px;"></i>
                                                            {{ __('messages.edit') }}
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('employee.show', $employee->id) }})}}">
                                                        <strong> <i
                                                                class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                                style="font-size: 20px;"></i>
                                                            Show
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{route('employee.destroy',$employee->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        &nbsp;
                                                        <button class="mr-2 btn-icon btn-icon-only btn">
                                                            <strong>
                                                                <i class="fa fa-trash btn-icon-wrapper icon-gradient bg-love-kiss"
                                                                   style="font-size: 20px;" id="delete">
                                                                </i> Delete
                                                            </strong>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    @if(auth()->guard('employee')->user() && auth()->guard('employee')->user()->role==2)
                                        <div class="btn-group dropdown m-r-10 open">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn"
                                                    type="button">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul role="menu" class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ route('chef.employee.edit', $employee->id) }}">
                                                        <strong>
                                                            <i class="fa fa-edit btn-icon-wrapper icon-gradient bg-sunny-morning"
                                                               style="font-size:20px;"></i>
                                                            Edit
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('chef.employee.show', $employee->id) }})}}">
                                                        <strong> <i
                                                                class="fa fa-search  btn-icon-wrapper icon-gradient bg-plum-plate"
                                                                style="font-size: 20px;"></i>
                                                            Show
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{route('employee.destroy',$employee->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        &nbsp;
                                                        <button class="mr-2 btn-icon btn-icon-only btn">
                                                            <strong>
                                                                <i class="fa fa-trash btn-icon-wrapper icon-gradient bg-love-kiss"
                                                                   style="font-size: 20px;" id="delete">
                                                                </i> Delete
                                                            </strong>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <footer class="card-footer" style="float: right">
                        {{ $employees->links() }}
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
    {{--  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script>
          $(document).ready(function () {
              $('#example').DataTable({
                  "paging": false,
                  "ordering": false,
                  "info": false
              });
          });
      </script>--}}
    //sweet alert cdn
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function () {

            $("body").on("click", "#deleteCompany", function (e) {

                if (!confirm("Do you really want to do this?")) {
                    return false;
                }

                e.preventDefault();
                var id = $(this).data("id");
                // var id = $(this).attr('data-id');
                var token = $("meta[name='csrf-token']").attr("content");
                var url = e.target;

                $.ajax(
                    {
                        url: url.href, //or you can use url: "company/"+id,
                        type: 'DELETE',
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function (response) {

                            $("#success").html(response.message)

                            Swal.fire(
                                'Remind!',
                                'Company deleted successfully!',
                                'success'
                            )
                        }
                    });
                return false;
            });


        });
    </script>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
