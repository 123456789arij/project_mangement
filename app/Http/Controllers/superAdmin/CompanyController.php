<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 0) {
            $users = User::where('role_id', 1)->get();
            return view('superAdmin.entreprise.index', compact('users'));
        }
        abort(403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role_id == 0) {
            $users = User::where('role_id', 1);
            $password = self::generateRandomString(7);

            return view('superAdmin.entreprise.create', compact('users', 'password'));
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

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => '1',
        ]);

        $mail = new SendMail([
            'address_from' => config('mail.from.address'),
            'name_from' => config('mail.from.name'),
            'address_to' => $request['email'],
            'name_to' => $request['name'],
            'title' => 'password created',
            'body' => $request['password'],
            'subject' => 'hello company ',
        ]);
        Mail::send($mail);

        return redirect()->route('super_admin')->with('success', '  Entreprise is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->role_id == 0) {
            $users = User::where('role_id', 1)->findorfail($id);
            return view('superAdmin.entreprise.show', compact('users'));
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
        if (auth()->user()->role_id == 0) {
            $users = User::where('role_id', 1)->findorfail($id);
            return view('superAdmin.entreprise.edit', compact('users'));
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
            'password' => 'required', 'string', 'min:6',
        ]);

        $users = User::where('role_id', 1)->findorfail($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = $request->input('password');
        $users->address = $request->input('address');
        $users->logo = $request->input('logo');
        $users->mobile = $request->input('mobile');
        return redirect()->route('super_admin')->with('success', 'Entreprise is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role_id == 0) {
            $users = User::where('role_id', 1)->findorfail($id);
            $users->delete();
            return redirect()->route('super_admin')->with('success', 'employee is successfully deleted');
        }
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
