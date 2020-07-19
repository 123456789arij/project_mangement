@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            text-decoration: none;
            color: black;
        }

        #example1 {
            border: 1px solid #778899;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <strong><h2 class="card-title"> {{ __('messages.listofdiscussions') }}</h2></strong>
                    <div class="divider"></div>
                    <div id="discussions_container"></div>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <strong><h2 class="card-title"> {{ __('messages.listofmessages') }}</h2></strong>
                    <div class="divider"></div>
                    <div id="messages_container"></div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col  container">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"> {{ __('messages.startconversation') }}</h3>
                    <div class="divider"></div>
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
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="content"
                                      rows="3"></textarea>

                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary mb-2">send</button>
                    </form>
                </div>
            </div>
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
                if ($message) _callback();
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
  <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                     <div class="widget-content-left mr-3">
                         <div class="widget-content-left">
                              <img src="${$image}" alt="user-img" width="38px" height="38px">
                          </div>
                     </div>
               <div class="widget-content-left flex2">
                     <div class="widget-heading">
                       ${$name}
                     </div>
                    <div class="widget-subheading opacity-7"><small>${$date}</small></div>

               </div>
</div></div>
                    </a>
                </div>`;
        }

        function makeMessageItem(message) {
            return `
                <div id="example1">
<p>${message.sender.name}</p>
<img src="${message.sender.image}" width="20px" height="20px">
            <p >${message.content}<br>
<small>${message.created_at}</small>
</p>

                </div>`;


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
