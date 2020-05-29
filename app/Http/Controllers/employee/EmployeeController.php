<?php

namespace App\Http\Controllers\employee;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee= Employee::whereHas('department', function (Builder $query) {
            $query->where('id', auth()->guard('employee')->user()->department_id);
        })->get();
        return view('layouts.header_right',compact('employee'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $departments = Department::where('user_id', auth()->user())->get();
        return view('employee.profile.edit', compact('employee','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'image' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',
        ]);


        $employee = Employee::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = $request->input('password');
        $employee->gender = $request->input('gender');
        $employee->skills = $request->input('skills');
        $employee->mobile = $request->input('mobile');
        $employee->address = $request->input('address');
        $employee->department_id = $request->input('department_id');
        if ($files = $request->file('image')) {
            $destinationPath = '/images/';
            $profileImage = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $employee->image = $destinationPath . $profileImage;
        }
        $employee->save();
        return redirect()->route('employee.dashborad')->with('toast_success', 'employee is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
