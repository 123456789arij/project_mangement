@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <br/>
        <form method="post" action="{{route('admin.events.store')}}" class="container">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="Title">Title:</label>
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <strong> Start Date : </strong>
                    <input type="date" class="form-control date" id="start" name="start">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <strong> End Date : </strong>
                    <input  type="date" class="form-control date" id="end" name="end">
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="form-group">
                    <label>colors</label>
                    <select id="colorselector" name="color">
                        <option value="bg-info" data-color="#5475ed" selected>Blue</option>
                        <option value="bg-warning" data-color="#f1c411">Yellow</option>
                        <option value="bg-purple" data-color="#ab8ce4">Purple</option>
                        <option value="bg-danger" data-color="#ed4040">Red</option>
                        <option value="bg-success" data-color="#00c292">Green</option>
                        <option value="bg-inverse" data-color="#4c5667">Grey</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success">Add Event</button>
                </div>
            </div>
            <div>
                <select class="mb-2 form-control-lg form-control" name="category_id">
                    <option value=""> {{ __('messages.employee') }}</option>
                    @foreach($employees as $employee)
                        <option
                            value="{{$employee->id}}"> {{$employee->name}} </option>
                    @endforeach
                </select>


            </div>
        </form>
    </div>
@endsection
@section('jsBlock')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>--}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.js') }}"></script>
    <script>
        $('#colorselector').colorselector();
    </script>
@endsection
