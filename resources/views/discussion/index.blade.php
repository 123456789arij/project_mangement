@extends('layouts.base')
@section('cssBlock')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <form action="{{route('discussion.msg')}}" method="POST">
                {{--  partie email +adresse--}}
                {{csrf_field()}}
                <div class="form-row">
                    <label for="exampleFormControlInput1">Membre</label>
                    <input name="receiver" placeholder="receiver" class="form-control">
                    <br>
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea  class="form-control"name="content" rows="3"></textarea>

                </div> <br>
                <button type="submit" class="btn btn-primary mb-2">send</button>
            </form>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
