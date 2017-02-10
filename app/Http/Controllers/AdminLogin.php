<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Controller
{
    public function login()
    {


        if (Auth::user()) {
            return redirect(action('AdminController@home'));
        }
        return view('admin.login')->with([
            'title' => 'Login'
        ]);
    }

    public function loginPost(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect(action('AdminController@home'));
        } else {
            return redirect()->back()->with('error', 'wrong username or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(action('AdminLogin@login', 'en'));
    }
}
