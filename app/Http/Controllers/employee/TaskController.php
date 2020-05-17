<?php

namespace App\Http\Controllers\employee;

use App\Employee;
use App\File;
use App\Http\Controllers\Controller;
use App\Project;
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
        $employee = auth()->guard('employee')->user();
        $status = Task::STATUS;
        if (auth()->guard('employee')->user()->role == 2) {
            $projects = Project::whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->whereHas('departments', function (Builder $query) {
                        $query->where('id', auth()->guard('employee')->user()->department_id);
                    });
                });
            })->get();
            $tasks = Task::whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->whereHas('user', function (Builder $query) {
                        $query->whereHas('departments', function (Builder $query) {
                            $query->where('id', auth()->guard('employee')->user()->department_id);
                        });
                    });
                });
            })->paginate(5);
        } else {
            $tasks = $employee->tasks()->paginate(5);
            $projects = $employee->projects;
        }

        return view('task.index', compact('tasks', 'projects', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guard('employee')->user()->role == 2) {
            $employees = auth()->guard('employee')->user();
            $projects = $employees->projects()->get();
            /*     $projects = Project::whereHas('client', function (Builder $query) {
                     $query->where('user_id', auth()->user()->id);
                 })->get();
                 $employees = Employee::whereHas('department', function (Builder $query) {
                     $query->where('user_id', auth()->user()->id);
                 })->get();*/
            return view('task.create', compact('projects', 'employees'));
        }
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
            'titre' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required',
            'file' => 'required|file|mimes:doc,docx,pdf,txt|max:2048',
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

        if ($files = $request->file('file')) {

            $destinationPath = '/files/';
            $file_doc = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('files'), $file_doc);
            $file = new File();
            $file->path = $destinationPath . $file_doc;
            $task->files()->save($file);
        }
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
        return view('task.edit', compact('task'));
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
        $emplyeeIds = $request->input('ids');
        $task->save();
        $task->employees()->sync($emplyeeIds);
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
        //
    }
}