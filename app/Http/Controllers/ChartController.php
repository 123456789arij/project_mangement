<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('tasks')
                ->select(
                    DB::raw('status as status'),
                    DB::raw('count(*) as number'))
                ->groupBy('status')
                ->whereIn('status', [0, 1, 3])
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
        return view('pie_chart');
    }


}
