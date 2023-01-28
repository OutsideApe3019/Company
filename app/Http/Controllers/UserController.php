<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editFirstName(Request $request) {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'password' => ['required'],
        ]);

        if (Hash::check($request->input('password'), $user->password)) {
            $user->firstName = $request->input('firstName');
            $user->save();
            return redirect()->route('settings')->with('success', 'First name changed successfully.');
        }else {
            return redirect()->back()->with('password', 'The password does not match our records.');
        }
        
    }

    public function editLastName(Request $request) {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'lastName' => ['required', 'string', 'max:255'],
            'password' => ['required'],
        ]);

        if (Hash::check($request->input('password'), $user->password)) {
            $user->lastName = $request->input('lastName');
            $user->save();
            return redirect()->route('settings')->with('success', 'Last name changed successfully.');
        }else {
            return redirect()->back()->with('password', 'The password does not match our records.');
        }
        
    }

    public function editUsername(Request $request) {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        if (Hash::check($request->input('password'), $user->password)) {
            $user->username = $request->input('username');
            $user->save();
            return redirect()->route('settings')->with('success', 'Username changed successfully.');
        }else {
            return redirect()->back()->with('password', 'The password does not match our records.');
        }
        
    }

    public function editEmail(Request $request) {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        if (Hash::check($request->input('password'), $user->password)) {
            $user->email = $request->input('email');
            $user->save();
            return redirect()->route('settings')->with('success', 'Email changed successfully.');
        }else {
            return redirect()->back()->with('password', 'The password does not match our records.');
        }
        
    }

    public function editPassword(Request $request) {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'password' => ['required', 'string', 'max:255', 'min:8', 'confirmed'],
            'old_password' => ['required'],
        ]);

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect()->route('settings')->with('success', 'Email changed successfully.');
        }else {
            return redirect()->back()->with('old_password', 'The password does not match our records.');
        }
        
    }
}
