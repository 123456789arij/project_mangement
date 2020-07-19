<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Task::whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->whereHas('user', function (Builder $query) {
                        $query->whereHas('departments', function (Builder $query) {
                            $query->where('id', auth()->guard('employee')->user()->department_id);
                        });
                    });
                });
            })->select(
                DB::raw('status as status'),
                DB::raw('count(*) as number'))
                ->groupBy('status')
                ->get();

            $statuses = [];
            foreach (Task::STATUS as $key => $value) {
                $statuses[$value] = $key;
            }

            $array[] = ['status', 'Number'];
            foreach ($data as $key => $value) {
                $array[++$key] = [$statuses[$value->status], $value->number];
            }
            return response()->json(['status' => 'success', 'data' => $array]);
        }

        return view('home');
    }


}
