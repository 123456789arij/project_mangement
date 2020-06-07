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
    </div>
@endforeach
