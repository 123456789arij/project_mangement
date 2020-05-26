<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CalendarTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project', 'employees')->whereHas('project', function (Builder $query) {
            $query->whereHas('client', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            });
        })->get();
        return view('task.fullcalender',compact('tasks'));
    }
}
