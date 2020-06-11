<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\Feed;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $userCount = Client::where('user_id', auth()->user()->id)->count();
            $employeesCount = Employee::whereHas('department', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->count();
            $projectsCount = Project::whereHas('client', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->count();

            $tasksCount = Task::with('project', 'employees')->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })->count();
            $tasksPadaing = Task::with('project', 'employees')->where('status', 3)->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })->count();
            $tasksCompleted = Task::with('project', 'employees')->where('status', 1)->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })->count();

            $homeTask = Task::with('project', 'employees')->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })->get();
            $projectsHome = Project::whereHas('client', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
          /*  $feeds = Feed::whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->where('id', auth()->user()->id);
                });
            })->get();*/
            return view('home', compact('userCount', 'employeesCount', 'projectsCount', 'tasksCount', 'tasksPadaing', 'projectsHome', 'tasksCompleted', 'homeTask'));
        }
    }
}
