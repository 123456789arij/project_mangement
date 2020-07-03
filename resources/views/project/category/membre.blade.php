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
                    <i class='metismenu-icon fas fa-layer-group'></i>
                </div>
                {{--                <h5> {{ __('messages.project') }} {{$project->id}} #-<strong>{{$project->name}}</strong></h5>--}}
            </div>
            {{--   /page-title-wrapper--}}

            {{--    <div class="page-title-actions">
                    <div class="d-inline-block dropdown text-center">
                        <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                             <span class="btn-icon-wrapper pr-2 opacity-7">
                                  <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                              </span>
                          --}}{{--  <a href="{{route('project.edit',$project->id)}}"
                               style="color: white;font-size: 15px;">   {{__('messages.edit') }}</a>&nbsp;&nbsp;--}}{{--
                        </button>
                    </div>
                </div>--}}
        </div>
    </div>
    {{--                /app-page-title--}}

    <div class="row">


    </div>
    <div class="row">
        <div class="col-md-12">
            <!------ carde tab ---------->
            <div class="mb-3 card">
                <div class="card-header">{{ __('messages.ProjectCategory') }}</div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            {{--                   Project_Membres             --}}
                            <div class="col-6">
                                <h4 style="text-align: justify">{{ __('messages.ProjectCategory') }}</h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('messages.name') }}</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">
                                                                {{ $category->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="row">
                                                <form action="{{route('category.destroy',$category->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="mr-2 btn-icon btn-icon-only btn btn-outline-danger">
                                                        <i class="pe-7s-trash btn-icon-wrapper"
                                                           style="font-size: 20px;"> </i>
                                                    </button>

                                                </form>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{--                   /Project_Membres             --}}
                            {{--                                add_Project_Membres     --}}
                            <div class="col-6">
                                <h4 style="text-align: center">{{ __('messages.add_new_Category') }} </h4>
                                <form method="POST" action="{{ route('category.store') }}">
                                    @csrf
                                    <div class="form-row">
                                        @csrf
                                        <div class="col-12 ">
                                            <div class="position-relative form-group">
                                                <label for="name"> nom du category</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-block text-center">
                                        <button class="btn btn-md btn-success" type="submit"
                                                style="float:left;">{{ __('messages.Save') }}</button>
                                    </div>

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
