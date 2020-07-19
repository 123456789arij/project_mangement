<?php

namespace App\Http\Controllers\employee;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboradController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = auth()->guard('employee')->user();
        if (auth()->guard('employee')->user()->role == 2) {
            $projects = Project::with('client', 'employees')->whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->whereHas('departments', function (Builder $query) {
                        $query->where('id', auth()->guard('employee')->user()->department_id);
                    });
                });
            });
        } else {
            $projects = $employee->projects();
        }
        $projects = $projects->count();

        if (auth()->guard('employee')->user()->role == 2) {
            $tasks = Task::whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->whereHas('user', function (Builder $query) {
                        $query->whereHas('departments', function (Builder $query) {
                            $query->where('id', auth()->guard('employee')->user()->department_id);
                        });
                    });
                });
            });
        } else {
            $tasks = $employee->tasks();
        }
        $tasks = $tasks->count();

        if (auth()->guard('employee')->user()->role == 2) {
            $taskscount = Task::where('status', 2)->whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->whereHas('user', function (Builder $query) {
                        $query->whereHas('departments', function (Builder $query) {
                            $query->where('id', auth()->guard('employee')->user()->department_id);
                        });
                    });
                });
            });
        } else {
            $taskscount = $employee->tasks();
        }
        $taskscount = $taskscount->count();
        if (auth()->guard('employee')->user()->role == 2) {
            $task_home = Task::whereHas('project', function (Builder $query) {
                $query->whereHas('client', function (Builder $query) {
                    $query->whereHas('user', function (Builder $query) {
                        $query->whereHas('departments', function (Builder $query) {
                            $query->where('id', auth()->guard('employee')->user()->department_id);
                        });
                    });
                });
            });
        } else {
            $task_home = $employee->tasks();
        }
        $task_home = $task_home->get();
        return view('home', compact('projects', 'tasks', 'taskscount', 'task_home'));
    }

    public function profile()
    {
        $employee = auth()->guard('employee')->user();
        return view('employee.profile.edit', compact('employee'));

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'image' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'new-password' => 'string|min:6|confirmed',
        ]);

        $password = $request->input('new-password');

        $employee = Employee::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->gender = $request->input('gender');
        if ($password) {
            $employee->password = bcrypt($password);
        }
        //optional
        $employee->skills = $request->input('skills');
        $employee->mobile = $request->input('mobile');
        $employee->address = $request->input('address');

        if ($files = $request->file('image')) {
            $destinationPath = '/images/';
            $profileImage = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $employee->image = $destinationPath . $profileImage;
        }
        $employee->save();
        return redirect()->route('employee.dashborad')->with('toast_success', 'employee is successfully updated');
    }

    /*    public function profile()
        {
            $employee_profile= Employee::whereHas('department', function (Builder $query) {
                $query->where('id', auth()->guard('employee')->user()->department_id);
            })->get();
            return view('layouts.header_right',compact('employee_profile'));
        }*/

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
    /*    public function edit($id)
        {
            $employee = Employee::find($id);
            $departments = Department::where('user_id', auth()->user())->get();
            return view('employee.profile.edit', compact('employee','departments'));
        }*/

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


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
