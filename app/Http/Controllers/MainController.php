<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
        'username' => 'required',
        'password' => 'required',
        'email' => 'required',
        'nip' => 'required',
        ]);
    }
}
