<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ColumnChartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::whereHas('client', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->get();

            $tasks = Task::with('project', 'employees')->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })->get();


            $statuses = [];
            foreach (Task::STATUS as $key => $value) {
                $statuses[$value] = $key;
            }

            $array[] = ['status', 'Number'];
//            foreach ($data as $key => $value) {
//                $array[++$key] = [$statuses[$value->status], $value->number];
//            }
            return response()->json(['status' => 'success', 'data' => $array]);
        }

        return view('ColumnChart');
    }
}
