<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\Project;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskboardController extends Controller
{
   /* public function index(Request $request)
    {
        $this->start_date = Carbon::now()->subDays(15)->format($this->global->date_format);
        $this->end_date = Carbon::now()->addDays(15)->format($this->global->date_format);
        $this->projects = Project::with('client', 'employees')->whereHas('client', function (Builder $query) {
        $query->whereHas('user', function (Builder $query) {
            $query->where('id', auth()->user()->id);
        });
    });
        $this->clients = Client::where('user_id', auth()->user()->id);
        $this->employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        });
        if (request()->ajax()) {

            $start_date = Carbon::createFromFormat($this->global->date_format, $request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat($this->global->date_format, $request->end_date)->toDateString();

            $boardColumns = TaskboardColumn::with(['tasks' => function ($q) use ($start_date, $end_date, $request) {
                $q->with([ 'completedSubtasks', 'users', 'project'])
                    ->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
                    ->leftJoin('users as client', 'client.id', '=', 'projects.client_id')
                    ->join('task_users', 'task_users.task_id', '=', 'tasks.id')
                    ->join('users', 'task_users.user_id', '=', 'users.id')
                    ->leftJoin('users as creator_user', 'creator_user.id', '=', 'tasks.created_by')
                    ->select('tasks.*')
                    ->groupBy('tasks.id');

                $q->where(function ($task) use ($start_date, $end_date) {
                    $task->whereBetween(DB::raw('DATE(tasks.`due_date`)'), [$start_date, $end_date]);

                    $task->orWhereBetween(DB::raw('DATE(tasks.`start_date`)'), [$start_date, $end_date]);
                });
                $q->whereNull('projects.deleted_at');

                if ($request->projectID != 0 && $request->projectID != null && $request->projectID != 'all') {
                    $q->where('tasks.project_id', '=', $request->projectID);
                }

                if ($request->clientID != '' && $request->clientID != null && $request->clientID != 'all') {
                    $q->where('projects.client_id', '=', $request->clientID);
                }

                if ($request->assignedTo != '' && $request->assignedTo != null && $request->assignedTo != 'all') {
                    $q->where('task_users.user_id', '=', $request->assignedTo);
                }

                if ($request->assignedBY != '' && $request->assignedBY != null && $request->assignedBY != 'all') {
                    $q->where('creator_user.id', '=', $request->assignedBY);
                }
            }])->orderBy('priority', 'asc')->get();

            $this->boardColumns = $boardColumns;

            $this->start_date = $start_date;
            $this->end_date = $end_date;

            $view = view('admin.taskboard.board_data', $this->data)->render();
            return Reply::dataOnly(['view' => $view]);
        }
        return view('admin.taskboard.index', $this->data);
    }*/
}
