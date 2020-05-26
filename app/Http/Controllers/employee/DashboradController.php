<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboradController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('client', 'employees')->whereHas('client', function (Builder $query) {
            $query->whereHas('user', function (Builder $query) {
                $query->whereHas('departments', function (Builder $query) {
                    $query->where('id', auth()->guard('employee')->user()->department_id);
                });
            });
        })->count();
        $tasks = Task::whereHas('project', function (Builder $query) {
            $query->whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->whereHas('departments', function (Builder $query) {
                        $query->where('id', auth()->guard('employee')->user()->department_id);
                    });
                });
            });
        })->count();

        $taskscount = Task::where('status',2)->whereHas('project', function (Builder $query) {
            $query->whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->whereHas('departments', function (Builder $query) {
                        $query->where('id', auth()->guard('employee')->user()->department_id);
                    });
                });
            });
        })->count();
        return view('home', compact('projects','tasks','taskscount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
