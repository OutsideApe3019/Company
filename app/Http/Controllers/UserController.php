<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editFirstName(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'password' => ['required', 'current_password'],
        ]);

        $user->firstName = str_replace(' ', '_', $request->input('firstName'));
        $user->save();
        return redirect()->route('settings')->with('success', 'First name changed successfully.');
    }

    public function editLastName(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'lastName' => ['required', 'string', 'max:255'],
            'password' => ['required', 'current_password'],
        ]);

        $user->lastName = str_replace(' ', '_', $request->input('lastName'));
        $user->save();
        return redirect()->route('settings')->with('success', 'Last name changed successfully.');
    }

    public function editUsername(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'current_password'],
        ]);

        $user->username = str_replace(' ', '_', $request->input('username'));
        $user->save();
        return redirect()->route('settings')->with('success', 'Username changed successfully.');
    }

    public function editEmail(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'current_password'],
        ]);

        $user->email = str_replace(' ', '_', $request->input('email'));
        $user->save();
        return redirect()->route('settings')->with('success', 'Email changed successfully.');
    }

    public function editPassword(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'password' => ['required', 'string', 'max:255', 'min:8', 'confirmed'],
            'old_password' => ['required', 'current_password'],
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect()->route('settings')->with('success', 'Email changed successfully.');
    }

    public function editDelete(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user->delete();
        $user->save();
        return redirect()->route('home')->with('status', 'Account deleted successfully.');
    }
}
