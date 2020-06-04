<?php

namespace App\Http\Controllers\employee;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comments = Comment::whereHas('employee', function (Builder $query) {
            $query->whereHas('department', function (Builder $query) {
                $query->where('id', auth()->guard('employee')->user()->department_id);
            });
        })->get();
        return view('employee.task.show', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment;
        $comment->body = $request->input('body');
        $comment->employee_id =auth()->guard('employee')->user()->id;
        $task = Task::find($request->task_id);
        $task->comments()->save($comment);
        return back();
    }
    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->input('body');
        $reply->employee_id =auth()->guard('employee')->user()->id;
        $reply->parent_id = $request->input('comment_id');
        $task = Task::find($request->input('task_id'));
        $task->comments()->save($reply);
        return back();

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
