@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        #edit_Projet_btn {
            color: white;
            font-size: 18px;
        }

        #edit_Projet_btn:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;
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
                    <i class='metismenu-icon fas fa-layer-group'></i>
                </div>
                <div><strong><h5> {{ __('messages.project') }} {{$project->id}} #-{{$project->name}}</h5></strong>
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                        <a href="{{route('employee.project.edit',$project->id)}}" id="edit_Projet_btn"
                           style="color: white;font-size: 15px;"> <i class="pe-7s-note  btn-icon-wrapper"
                                                                     style="font-size: 20px;">{{__('messages.edit') }}</i>
                        </a>

                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">


    </div>
    <div class="row">
        <div class="col-md-12">
            <!------ carde tab ---------->
            <div class="mb-3 card">
                <div class="card-header"><strong>{{ __('messages.Project_Membres') }}</strong></div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            {{--                   Project_Membres             --}}
                            <div class="col-6">
                                <h4 style="text-align: center"><strong>{{ __('messages.Project_Membres') }}</strong>
                                </h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('messages.name') }}</th>
                                        <th scope="col">{{ __('messages.role') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($membres as $employee)
                                        <tr>
                                            <th scope="row">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img src="{{asset($employee->image)}}"
                                                                     class="rounded-circle"
                                                                     height="40px" width="40px" alt="im"/>
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">
                                                               <a href="{{route('chef.employee.show',$employee->id)}}">{{$employee->name }} </a>   </div>
                                                            {{--                                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <td style="text-align: justify;">
                                                @if($employee->role  == 1)
                                                    <span>  {{ __('messages.employee') }}</span>
                                                @else
                                                    <span> {{ __('messages.projectManager') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{--                   /Project_Membres             --}}
                            {{--                                add_Project_Membres     --}}
                            <div class="col-6">
                                <h4 style="text-align: center">
                                    <strong>{{ __('messages.add_Project_Membres') }} </strong></h4>
                                <form method="POST" action="{{route('employee.membre')}}">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                    <select class="mb-2 form-control-lg form-control" name="employee_id[]" multiple>
                                        @foreach($employees as $employee)
                                            <option
                                                value="{{$employee->id}}"{{ in_array($employee->id,$membres->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                    <button class="btn-wide btn btn-success" type="submit">
                                        <i class="fas fa-check"></i>
                                        {{ __('messages.Save') }}
                                    </button>
                                </form>
                            </div>
                            {{--                               / add_Project_Membres     --}}
                        </div>
                    </div>
                </div>
            </div>
            {{--                /carde tab--}}

        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
