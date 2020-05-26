<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function get(Request $request,$id)
    {
        $project = Project::with('tasks')->findOrFail($id);

        if ($request->ajax()) {

            $data = [
                ['id' => $project->id, 'text' => $project->name, 'start_date' => $project->start_date, 'duration' => 5, 'progress' => $project->progress_bar / 100, 'parent' => 0]
            ];

            foreach ($project->tasks as $task) {
                $data[] = ['id' => $task->id, 'text' => $task->titre, 'start_date' => $task->start_date, 'duration' => 5, 'progress' => 0, 'parent' => $project->id];
            }

            return response()->json([
                "data" => $data,
                "links" => [],
            ]);
        }

        return view('project.gantt', compact('project','id'));
    }
}
