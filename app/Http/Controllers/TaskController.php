<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\Projet;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('project', 'employees')->whereHas('project', function (Builder $query) {
            $query->whereHas('client', function (Builder $query) {
                $query->where('id', auth()->user()->id);
            });
        })->paginate(3);
        return view('task.index', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $projects = Project::whereHas('client', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return view('task.create', compact('projects', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo upload file
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required',
        ]);

        $task = new Task();
        $task->titre = $request->input('titre');
        $task->description = $request->input('description');
        $task->start_date = $request->input('start_date');
        $task->end_date = $request->input('end_date');
        $task->priority = $request->input('priority');
    //TODO STATUS CHANGER DANS DB
        $task->status = 0;
        $task->project_id = $request->input('project_id');
        $emplyeeIds = $request->input('ids');

        $task->save();
        $task->employees()->sync($emplyeeIds);
//        $emplyoee = Employee::find([3, 4]);
//        $task->emplyoees()->attach( $emplyoee);
        return redirect()->route('task')->with('toast_success', 'task  is successfully saved');
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
        $task = Task::find($id);
        return view('task.edit', compact('project'));
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
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required',

        ]);
        $task = Task::findOrFail($id);
        $task->titre = $request->input('titre');
        $task->description = $request->input('description');
        $task->start_date = $request->input('start_date');
        $task->end_date = $request->input('end_date');
        $task->priority = $request->input('priority');
        $task->status = $request->input('status');
        $task->project_id = $request->input('project_id');
        $task->save();
        return redirect()->route('task')->with('toast_success', 'task is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('task')->with('success', 'task is successfully deleted');
    }
}
