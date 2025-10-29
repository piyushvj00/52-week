<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginGet()
    {
        return view('admin.auth.login');

    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1], $request->remember)) {
            return redirect()->intended('/admin/dashboard');
        }
        return back()->withErrors(['email' => 'These credentials do not match our records.']);

    }
}
