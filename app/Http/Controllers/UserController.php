<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'bio' => 'nullable|string|max:255',
        ]);

        $user = $request->user();

        if ($user->username !== $request->username) {
            $request->validate([
            'username' => 'unique:users,username',
            ]);
            $user->username = $request->username;
        }

        if ($user->email !== $request->email) {
            $request->validate([
            'email' => 'unique:users,email',
            ]);
            $user->email = $request->email;
        }

        $user->bio = $request->bio;
        $user->save();

        return back()->with('status', 'Perfil actualizada correctamente');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        $this->validateCurrentPassword($request);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Contraseña actualizada correctamente');
    }
    
    private function validateCurrentPassword(Request $request)
    {
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['current_password' => 'La contrasenya proporcionada no coincideix amb la teva contrasenya actual.'])->with('modal', 'passwordModal');
        }
    }
}
