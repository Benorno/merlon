<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create a new user
        User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Registration successful! You can now login.');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to dashboard or any other page
            return redirect('/admin/orders')->with('success', 'Login successful!');
        } else {
            // Authentication failed, redirect back to login with error message
            return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function index()
    {
        return route('admin.orders.table');
    }

    public function help()
    {
        return view('admin.help');
    }
}
