<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, User $user)
    {
        //var_dump($request);
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user->update(['password'=>Hash::make($validatedData['password'])]);
        $user->update(['usename'=>($validatedData['username'])]);
        $user->update(['email'=>$validatedData['email']]);
        return redirect('/')->with('success', 'La contraseña se ha actualizado correctamente');
    }

    public function index()
    {
        $user=Auth::user();

        return view('profile', ['user'=>$user]);
    }
}

