<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonutChartController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Project::whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->where('id', auth()->user()->id);
                });
            })->select(
                DB::raw('status as status'),
                DB::raw('count(*) as number'))
                ->groupBy('status')
                ->whereIn('status', [1, 2, 3, 4, 5])
                ->get();

            $statuses = [];
            foreach (Project::STATUS as $key => $value) {
                $statuses[$value] = $key;
            }

            $array[] = ['status', 'Number'];
            foreach ($data as $key => $value) {
                $array[++$key] = [$statuses[$value->status], $value->number];
            }
            return response()->json(['status' => 'success', 'data' => $array]);
        }
//        return view('donut_chart');
        return view('home');
    }


}
