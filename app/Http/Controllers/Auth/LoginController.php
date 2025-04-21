<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/myArticles';

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validar las credenciales ingresadas
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            // Redirigir al usuario a la página definida en $redirectTo
            return redirect()->intended($this->redirectTo);
        }

        // Si las credenciales no son válidas, redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('email', 'remember'));
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
