@extends('layouts.base')
@section('cssBlock')
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <i class="metismenu-icon fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                    {{ __('messages.Task_Calendar') }}

                </div>

{{--                <div class="page-title-subheading">--}}
{{--                    Le calendrier indique les dates d’échéance des tâches.--}}
{{--                </div>--}}
                <div id='calendar' class="container"></div>
            </div>
        </div>
    </div>

@endsection
@section('jsBlock')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
            integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: [
                        @foreach($tasks as $task)
                    {
                        title: '{{ $task->titre }}',
                        start: '{{ $task->start_date }}',
                        end: '{{ $task->end_date }}',
                        url: '{{ route('task.edit', $task->id) }}'
                    },
                    @endforeach
                ]
            })
        });
    </script>
@endsection
