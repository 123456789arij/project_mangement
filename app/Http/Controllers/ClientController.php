<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $clientsCount = Client::where('user_id', auth()->user()->id)->count();
         $clients = Client::where('user_id', auth()->user()->id);
         if ($search) {
            $clients = $clients->where("name", "LIKE", "%{$search}%");

        }
        $clients =$clients->simplePaginate(5);
        return view('client.index', compact('clients', 'clientsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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
        ]);
        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->password = $request->input('password');
        $client->mobile = $request->input('mobile');
        $client->address = $request->input('address');
        $client->linked_in = $request->input('linked_in');
        $client->skype = $request->input('skype');
        $client->facebook = $request->input('facebook');
        $client->user_id = Auth::user()->id;
        $client->save();
        return redirect()->route('client.index')->with('toast_success', 'client is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        if ($client->user_id == auth()->id()) {
            $projects = $client->projects;
            return view('client.show', compact('client', 'projects'));
        }
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
        Client::where('user_id', auth()->user()->id)->findorfail($id)->delete();
        return redirect()->route('client.index')->with('success', 'client  is successfully deleted');
    }
}
