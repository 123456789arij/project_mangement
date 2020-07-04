<?php

namespace App\Http\Controllers\employee;

use App\Task;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarTaskController extends Controller
{
    public function index()
    {
        $employee = auth()->guard('employee')->user();
        if (auth()->guard('employee')->user()->role == 2) {
            $tasks = Task::whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->whereHas('user', function (Builder $query) {
                        $query->whereHas('departments', function (Builder $query) {
                            $query->where('id', auth()->guard('employee')->user()->department_id);
                        });
                    });
                });
            })->get();

        } else {
            $tasks = $employee->tasks;
        }
        return view('employee.task.fullcalender', compact('tasks'));
    }
}
