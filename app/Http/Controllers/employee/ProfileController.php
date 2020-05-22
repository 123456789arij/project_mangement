<?php

namespace App\Http\Controllers\employee;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {

        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->paginate(5);
        return view('layouts.header_right', compact('employees'));

    }
    function edit($id)
    {
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
            'password' => 'required', 'string', 'min:6',
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
        return redirect()->route('employee.dashborad')->with('toast_success', 'employee is successfully updated');
    }
}
