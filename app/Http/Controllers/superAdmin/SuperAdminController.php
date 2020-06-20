<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;


class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id == 0) {
            $search = $request->input('search');
            $users = User::where('role_id', 1);
            $total_entreprise = User::where('role_id', 1)->count();
            if ($search) {
                $users = $users->where("name", "LIKE", "%{$search}%");
            }
            $users = $users->paginate('10');
            return view('superAdmin.entreprise.index', compact('users','total_entreprise'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    public function edit()
    {
        if (Auth::user()->role_id == 0) {
            $users = User::where('role_id', 0);
            return view('superAdmin.edit', compact('users'));
        }
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
            'email' => 'required',

        ]);
        $users = User::where('role_id', 0)->findorfail($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        if ($request->password != '') {
            $users->password = Hash::make($request->input('password'));
        }
        $users->mobile = $request->input('mobile');
        $users->address = $request->input('address');
        $users->linked_in = $request->input('linked_in');
        $users->skype = $request->input('skype');
        $users->facebook = $request->input('facebook');
        $users->save();
        return redirect()->route('super_admin')->with('toast_success', 'Client is successfully updated');
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
