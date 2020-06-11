@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.css') }}">
@endsection

@section('content')

    <div class="container">

       {{-- <div class="page-title-actions">
            <div class="d-inline-block dropdown text-center">
                <button class="btn-shadow mb-2 mr-2 btn btn-info btn-lg">
                         <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                          </span>
                    <a href=""
                       style="color: white;font-size: 15px;"> Ajouter un Event </a>&nbsp;&nbsp;
                </button>
            </div>
        </div>--}}
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsBlock')
    <script>
        var taskEvents = [
                @foreach($events as $event)
            {
                id: '{{ ucfirst($event->id) }}',
                title: '{{ ucfirst($event->title) }}',
                start: '{{ $event->start }}',
                end:  '{{ $event->end }}',
                {{--className: '{{ $event->label_color }}'--}}
            },
            @endforeach
        ];

        var getEventDetail = function (id) {
            var url = '{{ route('admin.events.show', ':id')}}';
            url = url.replace(':id', id);

            $('#modelHeading').html('Event');
            $.ajaxModal('#eventDetailModal', url);
        }

        var calendarLocale = '{{ $global->locale }}';
    </script>

    <script src="{{ asset('plugins/bower_components/calendar/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/calendar/dist/locale-all.js') }}"></script>
    <script src="{{ asset('js/event-calendar.js') }}"></script>

    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>

    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.js') }}"></script>

    <script>
        jQuery('#start_date, #end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: '{{ $global->date_picker_format }}',
        })

        $('#colorselector').colorselector();

        $('#start_time, #end_time').timepicker({
            @if($global->time_format == 'H:i')
            showMeridian: false,
            @endif
        });

        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        function addEventModal(start, end, allDay){
            if(start){
                $('#start_date, #end_date').datepicker('destroy');
                jQuery('#start_date, #end_date').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: '{{ $global->date_picker_format }}'
                })

                jQuery('#start_date').datepicker('setDate', new Date(start));
                jQuery('#end_date').datepicker('setDate', new Date(start));

            }

            $('#my-event').modal('show');

        }

        $('.save-event').click(function () {
            $.easyAjax({
                url: '{{route('admin.events.store')}}',
                container: '#modal-data-application',
                type: "POST",
                data: $('#createEvent').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        window.location.reload();
                    }
                }
            })
        })

        $('#repeat-event').change(function () {
            if($(this).is(':checked')){
                $('#repeat-fields').show();
            }
            else{
                $('#repeat-fields').hide();
            }
        })

        $('#send_reminder').change(function () {
            if($(this).is(':checked')){
                $('#reminder-fields').show();
            }
            else{
                $('#reminder-fields').hide();
            }
        })

    </script>

@endsection
