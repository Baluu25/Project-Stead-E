<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return back()->with('error', 'Ez az email már foglalt!');
        }
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);
        return redirect('/dashboard');
    }
}