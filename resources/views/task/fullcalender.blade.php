@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>
@endsection
@section('content')

    <h3>{{ __('messages.Task_Calendar') }}</h3>
    <div class="page-title-subheading">
        Le calendrier indique les dates d’échéance des tâches.
    </div>
    <br><br>
    <div id='calendar'></div>
@endsection
@section('jsBlock')
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
