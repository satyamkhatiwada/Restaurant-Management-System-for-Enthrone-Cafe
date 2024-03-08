<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class WaiterAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('waiter.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('code', 'password');
        
        if (Auth::guard('waiter')->attempt($credentials)) {
            return redirect()->intended('/waiter/dashboard');
        }
        return redirect()->route('waiter.login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('waiter')->logout();
        return redirect('/');
    }

}
