<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'miniyar23@gmail.com';
    }

    public function showLoginForm()
    {
        return view('auth.login', compact('texts', 'texts'));
    }

    /* Miniyar login */
    public function login(Request $request)
    {
        $username = $request->email;
        $pass = $request->password;
        if (Auth::attempt(['consumer_login' => $username, 'password' => $pass])) {
            return redirect()->intended('home');
        }
        else{
            return view('auth.login', compact('texts', 'texts'));
        }
    }
}
