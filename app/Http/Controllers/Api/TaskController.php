<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request){

        $task = new Task();
//        'titre', 'project_id', 'start_date', 'end_date', 'description', 'priority', 'status',
        $task->titre = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;

        $task->save();

        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id
        ]);
    }

    public function update($id, Request $request){
        $task = Task::find($id);

        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;

        $task->save();

        return response()->json([
            "action"=> "updated"
        ]);
    }

    public function destroy($id){
        $task = Task::find($id);
        $task->delete();

        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
