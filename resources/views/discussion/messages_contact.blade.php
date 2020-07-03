@extends('layouts.base')
@section('cssBlock')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="table-responsive container">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">created_at</th>
                        <th scope="col">{{ __('messages.due date') }}</th>
                        <th scope="col">{{ __('messages.status') }}</th>
                        <th colspan="2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
{{--                    <h5>unreadDiscussionCount : {{$unreadDiscussionCount}}</h5><br>--}}
                      @foreach(   $contact as $contact)
{{--                   <h1>{{$contact->name}}</h1>--}}
               @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
