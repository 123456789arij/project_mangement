@extends('layouts.base')
@section('cssBlock')
    <style>
        #name {
            text-transform: capitalize;
            text-align: justify;
        }

        #membres {
            text-transform: capitalize;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
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
                            <a href="{{ route('department.create') }}" id="create_department_btn"> Ajouter un nouveau Départment </a>&nbsp;&nbsp;
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

                <div class="card-header">{{ __('messages.departments') }}

                </div>
                <div class="table-responsive container">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr class="text-center">
                            <th scope="col" style="text-align: justify"> {{ __('messages.departments') }}</th>
                            <th colspan="2">Action</th>

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
                                                    {{ $department->name }}
                                                    &nbsp;&nbsp;
                                                    <span class="badge badge-pill badge-success" id="membres">{{$department->employees_count}} &nbsp; Members</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td class="text-center">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning">
                                        <a href="{{route('department.edit',$department->id)}}">
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                </td>

                                <td>
                                    <form action="{{route('department.destroy',$department->id)}}"
                                          method="post">
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
