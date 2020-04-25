<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmplyoeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emplyoees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->paginate(5);
        return view('emplyoee.index', compact('emplyoees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    /*    if (Session('sucess')) {
            toast('Employee is successfully saved', 'success');
        }*/

        $departments = auth()->user()->departments;
        return view('emplyoee.create', compact('departments'));
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
        return redirect()->route('emplyoee.index')->with('sucess');
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
        //
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
        //
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
        //
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
        $emplyoee = Employee::findOrFail($id);
        $emplyoee->delete();
        return redirect()->route('emplyoee.index')->with('success', 'emplyoee is successfully deleted');
    }
}
