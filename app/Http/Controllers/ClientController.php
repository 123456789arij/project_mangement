<?php

namespace App\Http\Controllers;

use App\Client;
use App\Mail\SendMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


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
        $clients = $clients->simplePaginate(5);
        return view('client.index', compact('clients', 'clientsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role_id == 1) {
            $password = self::generateRandomString(7);
            return view('client.create', compact('password'));
        }
        abort(403);
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
        $email = $request->input('email');
        $exist = Client::where('email', $email)->first();

        if ($exist) {
            return redirect()->back()->with("error", "client exists");
        }


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

        $mail = new SendMail([
            'address_from' => config('mail.from.address'),
            'name_from' => config('mail.from.name'),
            'address_to' => $request['email'],
            'name_to' => $request['name'],
            'title' => 'bonjour,voici votre mot de passe pour se connecter',
            'body' => $request['password'],
            'subject' => 'FÉLICITATIONS VOTRE COMPTE A ÉTÉ CRÉÉ',
        ]);
        Mail::send($mail);
        return redirect()->route('client.index')->with('success', 'client is successfully saved');
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

    static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
