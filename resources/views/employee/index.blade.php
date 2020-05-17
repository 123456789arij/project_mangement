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
                    {{--    <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components
                        </div>--}}
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
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Des Employés</div>
                            <div class="widget-subheading">Last year expenses</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold</div>
                            <div class="widget-subheading">Revenue streams</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">$3M</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Followers</div>
                            <div class="widget-subheading">People Interested</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">45,9%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">Income</div>
                            <div class="widget-subheading">Expected totals</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-focus">$147</div>
                        </div>
                    </div>
                    <div class="widget-progress-wrapper">
                        <div class="progress-bar-sm progress-bar-animated-alt progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                        </div>
                        <div class="progress-sub-label">
                            <div class="sub-label-left">Expenses</div>
                            <div class="sub-label-right">100%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">{{ __('messages.name') }}</th>
                            <th scope="col" id="employee">{{ __('messages.email') }}</th>
                            <th scope="col" id="employee">{{ __('messages.role') }}</th>
                            <th scope="col" class="text-center">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td class="text-center text-muted"> {{ $employee->id }}</td>
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
