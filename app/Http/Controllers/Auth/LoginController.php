<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // A régi process_login.php logika
        $email = $request->input('email');
        $password = $request->input('password');
        $rememberMe = $request->has('rememberMe');
        
        // Hibák gyűjtése
        $errors = [];
        
        if (empty($email)) $errors[] = "Email or username is required";
        if (empty($password)) $errors[] = "Password is required";
        
        if (!empty($errors)) {
            return back()->withErrors(['email' => implode(', ', $errors)]);
        }
        
        // A régi validateCredentials függvény
        if ($this->validateCredentials($email, $password)) {
            // Mivel nincs adatbázis, sima session-t használunk
            session([
                'user_id' => 1,
                'user_email' => $email,
                'user_name' => 'John Doe',
                'logged_in' => true
            ]);
            
            if ($rememberMe) {
                // Cookie beállítása
                cookie('remember_user', $email, 30 * 24 * 60); // 30 nap
            }
            
            return redirect('/dashboard');
        }
        
        return back()->withErrors(['email' => 'Invalid email/username or password']);
    }
    
    private function validateCredentials($email, $password)
    {
        // Pontosan ugyanaz a mock validáció, mint a régi fájlban
        $mockUsers = [
            [
                'email' => 'user@example.com',
                'username' => 'demo_user',
                'password' => 'password123'
            ],
            [
                'email' => 'test@stead-e.com',
                'username' => 'testuser',
                'password' => 'test123'
            ]
        ];
        
        foreach ($mockUsers as $user) {
            if (($email === $user['email'] || $email === $user['username']) && 
                $password === $user['password']) {
                return true;
            }
        }
        
        return false;
    }
    
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}