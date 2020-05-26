@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        #crud_btn, form {
            display: flex;
            height: 40px;
        }

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
                <div> Employees Dashboard
                    <span class="vertical-line">  	&nbsp;
                        <span class="label label-rouded label-custom pull-right">
                        {{  $employeescount }}
                    </span></span>
                    {{ __('messages.total_Employees') }}
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                         <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                          </span>
                        <a href="{{route('employee.create')}}"
                           style="color: white;font-size: 15px;">   {{__('messages.add_new_employee') }}</a>&nbsp;&nbsp;
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

                <div class="card-header">{{ __('messages.employees') }}
                </div>
                <br>
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example"
                           class="display">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('messages.name') }}</th>
                            <th scope="col" id="employee">{{ __('messages.email') }}</th>
                            <th scope="col" id="employee">{{ __('messages.role') }}</th>
                            <th scope="col" class="text-center">ACTIONS</th>
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
                                                         height="40px" width="40px" alt="im"/>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">
                                                    {{$employee->name }}   </div>
                                                <div class="widget-subheading opacity-7">Web Developer</div>
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
                                <td class="text-center" id="crud_btn">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{ route('employee.edit', $employee->id) }}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                    {{--                                    button show--}}
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">
                                        <a href="{{route('employee.show', $employee->id) }})}}">
                                            <i class="pe-7s-info  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                    {{--                                    button delete--}}
                                    <form action="{{route('employee.destroy',$employee->id)}}" method="post"
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
