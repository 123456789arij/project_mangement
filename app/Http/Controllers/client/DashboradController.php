<?php

namespace App\Http\Controllers\client;

use App\Client;
use App\Http\Controllers\Controller;
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
        $client = auth()->guard('client')->user();
        $projects_client_count = $client->projects()->count();
        $projects_completed_client_count = $client->projects()->where('status',5)->count();
        $projects_Pending_client_count = $client->projects()->where('status',1)->count();
        $projects_client = $client->projects()->get();
        return view('home',compact('projects_client_count','projects_Pending_client_count','projects_client','projects_completed_client_count'));
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if ($client->user_id == auth()->id()) {
            return view('client.edit', compact('client'));
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
        $client = Client::findOrFail($id);
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->mobile = $request->input('mobile');
        $client->address = $request->input('address');
        $client->linked_in = $request->input('linked_in');
        $client->skype = $request->input('skype');
        $client->facebook = $request->input('facebook');
        $client->user_id = auth()->user()->id;
        $client->save(); //persist the data
        return redirect()->route('client.index')->with('toast_success', 'Client is successfully updated');
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
