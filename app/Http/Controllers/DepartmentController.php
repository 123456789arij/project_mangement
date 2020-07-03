<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $departments = Department::withCount('employees')->where('user_id', auth()->user()->id);
        if ($search) {
            $departments = $departments->where("name", "LIKE", "%{$search}%");

        }
        $departments = $departments->paginate(5);
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departement = auth()->user()->id;
        return view('department.create', compact('departement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $department = new Department();
        $department->name = $request->input('name');
        $department->user_id = auth()->user()->id;
        $department->save();
        return redirect()->route('department')->with('toast_success', 'department is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::withCount('employees')->findorfail($id);
//        $departmentemployee = Department::withCount('employees')->findorfail($id);
//        dd($department);
     return view('department.show',compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.edit', compact('department'));
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
        $request->validate([
            'name' => 'required',
        ]);
        $department = Department::findorfail($id);
        $department->name = $request->input('name');
        $department->user_id = auth()->user()->id;
        $department->save();
        return redirect()->route('department')->with('sucess', 'department is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::where('user_id', auth()->user()->id)->findorfail($id)->delete();
        return redirect()->route('department')->with('success', 'department is successfully deleted');
    }
}
