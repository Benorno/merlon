<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        return view('admin.profile.index', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . Auth::id(),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->update([
            'username' => $request->input('username'),
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->update([
                'password' => bcrypt($request->input('password')),
            ]);
            return redirect()->back()->with('success', 'Password updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
    }

    public function destroy()
    {
        Auth::user()->delete();
        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
