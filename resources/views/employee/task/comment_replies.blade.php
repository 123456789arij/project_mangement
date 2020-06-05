@foreach($comments as $comment)
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
{{--        <a href="" id="reply"></a>--}}

{{--        <form method="post" action="{{ route('employee.reply.add') }}">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <textarea name="body" class="form-control" rows="3" placeholder="votre commentaire"></textarea>--}}
{{--                <input type="hidden" name="task_id" value="{{ $task->id }}"/>--}}
{{--                <input type="hidden" name="comment_id" value="{{ $comment->id }}">--}}
{{--            </div>--}}
{{--            <input type="submit" style="float: right" class="btn btn-warning col-sm-4"--}}
{{--                   value="Reply" />--}}
{{--        </form>--}}

{{--        @include('employee.task.comment_replies', ['comments' => $comment->replies])--}}




    </div>
@endforeach
