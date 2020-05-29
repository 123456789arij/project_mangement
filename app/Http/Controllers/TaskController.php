<?php

namespace App\Http\Controllers;

use App\Employee;
use App\File;
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
    public function index(Request $request)
    {
        $projectId = $request->input('project_id');
        $statusId = $request->input('status');

        $status = Task::STATUS;
        $projects = Project::whereHas('client', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        $tasksCount = Task::with('project', 'employees')->whereHas('project', function (Builder $query) {
            $query->whereHas('client', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            });
        })->count();

        $tasks = Task::with('project', 'employees')->whereHas('project', function (Builder $query) use ($projectId) {
            if ($projectId != null) {
                $query = $query->where('id', $projectId);
            }
            $query->whereHas('client', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            });
        });
        if ($statusId != null) {
            $tasks = $tasks->where('status', $statusId);
        }

        $tasks = $tasks->paginate(5);

        return view('task.index', compact('tasks', 'status', 'projects', 'projectId', 'statusId','tasksCount'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required',
            'file' => 'required|file|mimes:doc,docx,pdf,txt|max:2048',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->start_date = $request->input('start_date');
        $task->end_date = $request->input('end_date');
        $task->priority = $request->input('priority');
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
        $task = Task::findorfail($id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projects = Project::whereHas('client', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        $task = Task::find($id);
        return view('task.edit', compact('task', 'projects', 'employees'));
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
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required',

        ]);
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
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
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('task')->with('success', 'task is successfully deleted');
    }

    public function itemView()
    {
        $panddingItem = Task::where('status', 0)->get();
        $completeItem = Task::where('status', 1)->get();

        return view('task.dragAndDroppable', compact('panddingItem', 'completeItem'));
    }

    public function updateItems(Request $request)
    {
        $input = $request->all();

        foreach ($input['panddingArr'] as $key => $value) {
            $key = $key + 1;
            Task::where('id', $value)->update(['status' => 0, 'order' => $key]);
        }

        foreach ($input['completeArr'] as $key => $value) {
            $key = $key + 1;
            Task::where('id', $value)->update(['status' => 1, 'order' => $key]);
        }

        return response()->json(['status' => 'success']);
    }

    public function changeStatus(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->status = $request->status;
        $task->save();

        return response()->json(['success' => 'User status change successfully.']);
    }


//    public function bb(){
//        dd('here');
//    }
//    public function calendar_task()
//    {
//        dd('here');
//        if (request()->ajax()) {
//            $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
//
//            $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
//
//
//            $data = Task::whereDate('start_date', '>=', $start_date)->whereDate('end_date', '<=', $end_date)->get(['id', 'title', 'start_date', 'end_date']);
//
//            return Response::json($data);
//
//        }
//
//        return view('task.fullcalender');
//    }

}
