@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>

    </style>
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> {{ __('messages.project') }} #
                    {{--                    @foreach($project as $projet)--}}
                    {{--                        {{$projet->id}}--}}
                    {{--                    @endforeach--}}
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
                              <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                          </span>
                        <a href="{{route('employee.profile.edit',$project->id)}}"
                           style="color: white;font-size: 15px;">   {{__('messages.edit') }}</a>&nbsp;&nbsp;
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
                <div class="card-header card-header-tab-animation">
                    <ul class="nav nav-justified">
                        {{--<li class="nav-item"><a
                                class="active nav-link {{request()->is('')? 'active':null }}"
                                href="">Projet</a>
                        </li>--}}
                        <li class="nav-item"><a>Membre</a>
                        </li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-2" class="nav-link"> Tache</a>
                        </li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-2" class="nav-link"> facture</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                            <div class="row">
                                {{--                   Project_Membres             --}}
                                <div class="col-6">
                                    <h4 style="text-align: center">{{ __('messages.Project_Membres') }}</h4>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{ __('messages.name') }}</th>
                                            <th scope="col">{{ __('messages.role') }}</th>
                                            <th scope="col">Action</th>
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
                                                                    {{$employee->name }}   </div>
                                                                {{--                                                                <div class="widget-subheading opacity-7">Web Developer</div>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td style="text-align: justify;">
                                                    @if($employee->role  == 1)
                                                        <span> Employée</span>
                                                    @else
                                                        <span>Chef De Projet</span>
                                                    @endif

                                                    {{--       <form action="{{ route('destroy_membre',$employee->id) }}"
                                                                              method="post">.
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button
                                                                                class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                                                                                <i class="pe-7s-trash btn-icon-wrapper"
                                                                                   style="font-size: 20px;"> </i></button>

                                                                        </form>--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{--                   /Project_Membres             --}}
                                {{--                                add_Project_Membres     --}}
                                <div class="col-6">
                                    <h4 style="text-align: center">{{ __('messages.add_Project_Membres') }} </h4>
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
                                            Save
                                        </button>
                                    </form>
                                </div>
                                {{--                               / add_Project_Membres     --}}
                            </div>
                        <div class="tab-pane" id="tab-eg115-2" role="tabpanel">
                            <button>Ajouter une Nouvelle tache</button>
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
