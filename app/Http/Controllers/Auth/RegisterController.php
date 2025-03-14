<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class RegisterController extends Controller
{
    public function showRegisterForm() 
    {
        return view('signup');
    }

    public function register(Request $request)
    {

       $this->validator($request->all())->validate();

       $user = $this->create($request->all());

       Auth::login($user);
       
       return redirect()->route('articles');
    }

    protected function validator (array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'creado_el' => now(),
        ]);
    }
}
?>
