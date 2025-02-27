<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8'],  
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        $credentials = $request->only('username', 'email', 'password', 'confirm_password');

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
        ]);

        return redirect()->route('login');
    }
}
