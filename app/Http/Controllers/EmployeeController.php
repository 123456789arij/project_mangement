<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employeescount = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->count();

        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        });
        if ($search) {
            $employees = $employees->where("name", "LIKE", "%{$search}%");

        }
        $employees = $employees->paginate(5);
        return view('employee.index', compact('employees', 'employeescount'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = auth()->user()->departments;
        return view('employee.create', compact('departments'));
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
            'email' => 'required',
            'password' => 'required', 'string', 'min:6',
            'role' => 'required',
            'gender' => 'required',
            'joining_date' => 'required',
            'department_id' => 'required',
            'image' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',

        ]);
        $emplyoee = new Employee();
        $emplyoee->name = $request->input('name');
        $emplyoee->email = $request->input('email');
        $emplyoee->password = $request->input('password');
        $emplyoee->role = $request->input('role');
        $emplyoee->gender = $request->input('gender');
        $emplyoee->skills = $request->input('skills');
        $emplyoee->mobile = $request->input('mobile');
        $emplyoee->address = $request->input('address');
        $emplyoee->joining_date = $request->input('joining_date');
        $emplyoee->department_id = $request->input('department_id');

        if ($files = $request->file('image')) {
//       dd(request()->all());
            $destinationPath = '/images/';
            $profileImage = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $emplyoee->image = $destinationPath . $profileImage;
        }
        $emplyoee->save();
        return redirect()->route('employee.index')->with('sucess');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $employee = Employee::findorfail($id);
        $projects = $employee->projects;
        return view('employee.show', compact('employee', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
//        $employees = Employee::whereHas('department', function (Builder $query) {
//            $query->where('user_id', auth()->user()->id);
//        })->get();
        $employee = Employee::find($id);
        $departments = Department::where('user_id', auth()->user()->id)->get();
        return view('employee.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'gender' => 'required',
            'joining_date' => 'required',
            'department_id' => 'required',
            'image' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',

        ]);


        $employee = Employee::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = $request->input('password');
        $employee->role = $request->input('role');
        $employee->gender = $request->input('gender');
        $employee->skills = $request->input('skills');
        $employee->mobile = $request->input('mobile');
        $employee->address = $request->input('address');
        $employee->joining_date = $request->input('joining_date');
        $employee->department_id = $request->input('department_id');
        if ($files = $request->file('image')) {
//       dd(request()->all());
            $destinationPath = '/images/';
            $profileImage = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $employee->image = $destinationPath . $profileImage;
        }
        $employee->save(); //persist the data
        return redirect()->route('employee.index')->with('toast_success', 'employee is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'employee is successfully deleted');
    }
}
