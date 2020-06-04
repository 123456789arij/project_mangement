<?php

namespace App\Http\Controllers;

use App\Comment;
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

        $comments = Comment::whereHas('task', function (Builder $query) {
            $query->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            });
        })->get();
        return view('task.show', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comment = Comment::whereHas('task', function (Builder $query) {
            $query->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            });
        })->get();
        return view('task.comment _create', compact('comment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment;
        $comment->body = $request->input('body');
        $comment->user()->associate($request->user());
        $task = Task::find($request->task_id);
        $task->comments()->save($comment);
        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->input('body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $task = Task::find($request->get('task_id'));
        $task->comments()->save($reply);
        return back();

    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
