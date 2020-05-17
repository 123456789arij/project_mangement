<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function get()
    {
        $tasks = new Task();
        $projects = new Project();

        return response()->json([
            "data" => $tasks->all(),
            "links" => $projects->all()
        ]);
    }
}
