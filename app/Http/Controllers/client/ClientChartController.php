<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientChartController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $client = auth()->guard('client')->user();
            $data = $projects = $client->projects()->select(
                DB::raw('status as status'),
                DB::raw('count(*) as number'))
                ->groupBy('status')
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

        return view('home');
//
//        return view('pie_chart');
    }


}
