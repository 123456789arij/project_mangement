<?php

namespace App\Http\Controllers\Entreprise;

use App\Client;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = DB::table('clients')->simplePaginate(10);
        return view('Entreprise.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('Entreprise.client.create', compact('users'));
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
            'user_id' => 'required',
            'password' => 'required', 'string', 'min:6',
            'mobile' => 'nullable',
            'address' => 'nullable',
            'linked_in' => 'nullable',
            'skype' => 'nullable',
            'facebook' => 'nullable',

        ]);

        Client::create($request->all());
        return redirect()->route('client.index')->with('toast_success', 'client is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('Entreprise.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $users = User::all();
        return view('Entreprise.client.edit', compact('users', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'user_id' => 'required',
            'password' => 'required', 'string', 'min:6',
            'mobile' => 'nullable',
            'address' => 'nullable',
            'linked_in' => 'nullable',
            'skype' => 'nullable',
            'facebook' => 'nullable',
        ]);

        $client->update($request->all());
        return redirect()->route('client.index')->with('toast_success', 'Client is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Client::find($request->id)->delete();
        return redirect()->route('client.index')->with('success', 'client  is successfully deleted');

        /* $client->delete();
         return redirect()->route('client.index')->with('delete', 'client  is successfully deleted');*/
    }
}
