<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
        'username' => 'required',
        'password' => 'required',
        ]);

        $data = $request->all();
        if (Auth::attempt(['name'=>$data['username'], 'password' =>$data['password']]))
        {
            return redirect()->intended('list_vats');
        }else{
            return redirect()->intended('/')->withErrors('Zła nazwa użytkownika lub hasło');
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
        'username' => 'required|unique:users,name|max:20|min:4',
        'password' => 'required|min:5|confirmed',
        'email' => 'required|unique:users|email',
        ]);

        $data = $request->all();
        $check = User::create([
            'name' => $data['username'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);

        if($check == TRUE)
        {
            return redirect()->intended('list_vats');
        }else{
            return redirect()->intended('/')->WithErrors('Wystąpił błąd podczas rejestracji. Spróbuj ponownie lub w innym terminie.');
        }
    }
}
