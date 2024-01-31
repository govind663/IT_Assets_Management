<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\logs\UserLogActivityLogs;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    protected $UserLogActivityLogs;

    public function __construct(UserLogActivityLogs $UserLogActivityLogs)
    {
        $this->UserLogActivityLogs = $UserLogActivityLogs;
    }

    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }

    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_token') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            $this->UserLogActivityLogs->logUserLoginActivity('users', 'loged In');
            return redirect()->route('dashboard')->with('message', 'You are successfully logged in!');
        }
        else{
            return redirect()->route('login')->with(['Input' => $request->only('email','password'), 'error' => 'Your Email id and Password do not match our records!']);
        }

    }

    public function logout() {
        $this->UserLogActivityLogs->logUserLoginActivity('users', 'log Out');
        Session::flush();
        Auth::logout();

        return redirect('/')->with('message', 'You are logout Successfully.');
    }
}
