<?php

namespace App\Http\Controllers;

use App\Link;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GanttController extends Controller
{
    public function get(Request $request, $id)
    {
        $project = Project::with('tasks')->findOrFail($id);


        if ($request->ajax()) {

            $data = [
                ['id' => $project->id, 'text' => $project->name, 'start_date' => $project->start_date,
                    'duration' => 5, 'progress' => $project->progress_bar / 100, 'parent' => 0]
            ];
            $ids = [];
            foreach ($project->tasks as $task) {
                $ids[] = $task->id;
                $start = Carbon::parse($task->start_date);
                $end = Carbon::parse($task->end_date);

                $diff = $end->diffInDays($start);
                $data[] = ['id' => $task->id, 'text' => $task->title, 'start_date' => $task->start_date, 'duration' => $diff, 'progress' => 0, 'parent' => $project->id];
            }
            $link = Link::whereIn('source',$ids)->get();

            return response()->json([
                "data" => $data,
                "links" => $link,
            ]);
        }

        return view('project.gantt', compact('project'));
    }
}
