@extends('layouts.base')
@section('cssBlock')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-4">
            <h2>list of discussions</h2>
            <div id="discussions_container"></div>
        </div>
        <div class="col-8">
            <h2>list of messages</h2>
            <div id="messages_container"></div>
        </div>
        <br>
        <div class="col">
            <form action="{{route('discussion.msg')}}" method="POST" id="message_form">
                {{--  partie email +adresse--}}
                {{csrf_field()}}
                <div class="form-row">
                    <label for="exampleFormControlInput1">Membre</label>
                    {{--                    <input name="receiver" placeholder="receiver" class="form-control">--}}
                    <select name="receiver" id="exampleFormControlInput1" class="form-control">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>

                </div>
                <br>
                <button type="submit" class="btn btn-primary mb-2">send</button>
            </form>
        </div>
    </div>
@endsection
@section('jsBlock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            fetchDiscussions();
        });

        function fetchDiscussions($message, _callback) {
            //WS list of discussions
            $.ajax({
                method: 'get',
                url: '/employee/discussions/messages',
            }).done((data) => {
                var discussions = data.discussions;
                $('#discussions_container').html('');
                $.each(discussions, function (index, value) {
                    $('#discussions_container').append(makeDiscussionItem(value));
                });
                if($message) _callback();
            }).fail((error) => {
                console.log(error)
            });
        }

        function fetchMessages($id) {
            //WS list of messages
            $.ajax({
                method: 'get',
                url: '/employee/discussions/' + $id,
            }).done((data) => {
                $('#messages_container').html('');
                $.each(data, function (index, message) {
                    $('#messages_container').append(makeMessageItem(message));
                });
            }).fail((error) => {
                console.log(error)
            });
        }

        function makeDiscussionItem(discussion) {
            var $date = discussion.created_at;
            var $contact = discussion.contact;
            var $name = $contact.name;
            var $image = $contact.image;
            var $id = $contact.id;
            return `<div data-id="${$id}" class="discussion_item">
                    <a href="javascript:void(0)" data-id="${$id}">
                        <img src="${$image}" alt="user-img" width="25px" height="25px">
                        <span>${$name}<small class="text-simple">${$date}</small></span>
                    </a>
                </div>`;
        }

        function makeMessageItem(message) {
            return `<div><span>${message.content}</span><span>${message.created_at}</span></div>`;
        }

        //event on click discussionItem
        $('#discussions_container').on('click', '.discussion_item', function () {
            var $id = $(this).data('id');
            fetchMessages($id);
        });

        //event form submit
        $('#message_form').on('submit', function (e) {
            e.preventDefault();
            //WS list of messages
            $.ajax({
                method: 'post',
                url: '/employee/discussions/message',
                data: $(this).serialize()
            }).done((data) => {
                console.log(data);
                $('#exampleFormControlTextarea1').val('');
                fetchDiscussions(true, function () {
                    fetchMessages($('#exampleFormControlInput1').val())
                });
                // setTimeout(function () {
                //     fetchMessages($('#exampleFormControlInput1').val())
                // }, 500)
            }).fail((error) => {
                console.log(error)
            });
        })
    </script>
@endsection
