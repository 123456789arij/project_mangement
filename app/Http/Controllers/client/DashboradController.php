<?php

namespace App\Http\Controllers\client;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $client = auth()->guard('client')->user();
        $projects_client_count = $client->projects()->count();
        $projects_completed_client_count = $client->projects()->where('status', 5)->count();
        $projects_Pending_client_count = $client->projects()->where('status', 1)->count();
        $projects_client = $client->projects()->get();
        return view('home', compact('projects_client_count', 'projects_Pending_client_count', 'projects_client', 'projects_completed_client_count'));
    }

    public function profile()
    {
        $client = auth()->guard('client')->user();
        return view('client.profile.edit', compact('client'));

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

    }

    /**
     * Show the form for editing the specified resource.
     * lmmmmmmmmmmmmmmmml     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
//        $client = Client::find($id);
//        return view('client.edit', compact('client'));
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

        ]);
        $client = Client::findOrFail($id);
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        if ($request->password != '') {
            $client->password = Hash::make($request->input('password'));
        }
        $client->mobile = $request->input('mobile');
        $client->address = $request->input('address');
        $client->linked_in = $request->input('linked_in');
        $client->skype = $request->input('skype');
        $client->facebook = $request->input('facebook');
        $client->user_id = auth()->guard('client')->user()->id;
        $client->save();
        return redirect()->route('client.dashborad')->with('toast_success', 'Client is successfully updated');
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
        //
    }
}
