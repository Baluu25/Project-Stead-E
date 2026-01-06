<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Megjeleníti a regisztrációs űrlapot
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Feldolgozza a regisztrációs adatokat - EGYSZERŰBB VERZIÓ
     */
    public function register(Request $request)
    {
        // 1. EGYSZERŰBB VALIDÁLÁS (kevesebb szabállyal)
        $validated = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2. Ellenőrizd, hogy létezik-e már az email
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return back()->with('error', 'Ez az email már foglalt!');
        }

        // 3. Új user létrehozása - MINIMÁLIS ADATOKKAL
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // 4. Automatikus bejelentkeztetés - EGYSZERŰ MÓDON
        Auth::login($user);

        // 5. Átirányítás - ABSZOLÚT ÚTVONALLAL
        return redirect('/dashboard');
    }
}