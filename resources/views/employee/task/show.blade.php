@extends('layouts.base')
@section('cssBlock')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>

        .display-comment .display-comment {
            margin-left: 40px
        }

    </style>
@endsection
@section('content')
    {{-- app-page-title--}}
    <div class="app-page-title">
        <div class="page-title-wrapper">
            {{-- page-title-wrapper--}}
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="metismenu-icon fas fa-tasks"></i>
                </div>
                <div> {{ __('messages.task') }} &nbsp; #{{$task->id}}
                </div>
            </div>
            {{--   /page-title-wrapper--}}

            <div class="page-title-actions">
                <div class="d-inline-block dropdown text-center">
                    {{--       <button class="btn-shadow mb-2 mr-2 btn btn-alternate btn-lg">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                     <i class="fa pe-7s-add-user " style="font-size: 20px;"></i>
                           </button>--}}
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
                <div class="card-header">
                    {{ __('messages.task') }}
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{--projet--}}
                        <div class="tab-pane active container" id="tab-eg115-0" role="tabpanel">
                            <div class="row">
                                <div class="col-4">
                                    <a href="" class="btn btn-outline-success status-class" data-id="{{ $task->id }}"
                                       name="status">
                                        <i class="fa fa-check" style="font-size: 20px;"></i>
                                        {{ __('messages.marke_as_complete') }}  </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{route('task.edit',$task->id)}}"
                                       class="mr-2 btn-icon btn-icon-only btn btn-outline-primary">
                                        <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                        {{ __('messages.edit') }}  </a>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <label> {{$task->title}}</label>

                                    @if($task->priority == 0)
                                        <span class="badge badge-pill"
                                              style="background-color: #fcf2ed;font-size: 75%;border-radius: 60px;">Priority =>
                                                <label style="color: #fec107;">Medium</label> </span>
                                    @elseif($task->priority == 1)
                                        <span class="badge badge-pill"
                                              style="background-color: #fcf2ed;font-size: 75%;border-radius: 60px;">Priority =>
                                                <label style="color: #00c292;">Low</label> </span>
                                    @elseif($task->priority == 2)
                                        <span class="badge badge-pill"
                                              style="background-color: #fcf2ed;font-size: 75%;border-radius: 60px;">Priority =>
                                                <label style="color: #e15931">High</label> </span>
                                    @endif
                                </div>

                            </div>

                            <br>
                            <br>
                            {{--   client détailles--}}
                            <div class="col-12">
                                <div class="main-card mb-3 card">
                                    {{--                                    <div class="card-header">Client</div>--}}
                                    <div class="card-body">
                                        <h4 class="card-title"> {{ __('messages.Task_Details') }}</h4>
                                        {!! strip_tags($task->description) !!}

                                        <div>
                                            Due Date : {{$task->end_date }} &nbsp;

                                            @if($task->status === 1)
                                                <span class="badge badge-success"> {{ __('messages.Completed') }}</span>
                                            @elseif($task->status === 2)
                                                <span class="badge badge-danger"> {{ __('messages.Incomplete') }}</span>
                                            @else
                                                <span class="badge badge-info"> {{ __('messages.In Progress') }}</span>
                                            @endif
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- / client détailles--}}

                            <div tabindex="-1" class="dropdown-divider"></div>

                            {{--comment --}}
                            <div class="row">
                                <div class="col-12 container">
                                    <h4><strong>{{ __('messages.comments') }}</strong></h4><br>
                              {{--      @foreach($comments as $comment)
                                        <div class="display-comment">
                                            <div style="display:inline-block">
                                                <img src="{{asset($comment->employee->image)}}" data-toggle="tooltip"
                                                     data-original-title="{{ $comment->employee->name}}"
                                                     class="rounded-circle"
                                                     height="42px" width="42px" alt="employee"/>
                                            </div>
                                            &nbsp;&nbsp; <strong>{{ $comment->employee->name  }}</strong>
                                            <br>
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                    @endforeach--}}
                                    @include('employee.task.comment_replies', ['comments' => $task->comments, 'task_id' => $task->id])

                                    <div tabindex="-1" class="dropdown-divider"></div>
                                </div>
                            </div>
                            {{--/comment --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <strong>
                                            <i class="pe-7s-note  btn-icon-wrapper" style="font-size: 20px;"></i>
                                            Add Comment </strong>
                                        <form method="post" action="{{ route('employee.comment.store') }}">
                                            @csrf
                                            <div class="form-group">
{{--                                                <textarea name="body" class="form-control" rows="3" placeholder="votre commentaire"></textarea>--}}

                                                <input type="text" name="body" class="form-control" />
                                                <input type="hidden" name="task_id" value="{{ $task->id }}"/>
                                            </div>
                                            <input type="submit" style="float: right" class="btn btn-warning col-sm-4"
                                                   value="Add Comment"/>
                                        </form>
                                    </div>

                                </div>
                                {{-- add comment --}}
                                <div class="col-sm-4">

                                </div>
                                {{--/add comment --}}
                            </div>
                        </div>
                        {{--projet--}}

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
    <script>
        $(document).ready(function () {
            $('.status-class').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var taskId = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{route('task.changeStatus')}}',
                    data: {'status': status, 'task_id': taskId},
                    success: function (data) {
                        console.log(data.success)
                    }
                });
            });
        });
    </script>
@endsection
