<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // A régi process_register.php logika
        $errors = [];
        
        $name = $request->input('name');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $weight = $request->input('weight');
        $height = $request->input('height');
        $user_goal = $request->input('user_goal');
        $activity_level = $request->input('activity_level');
        
        // Validációk (pontosan ugyanazok)
        if (empty($name)) $errors[] = "Name is required";
        if (empty($username)) $errors[] = "Username is required";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
        if (empty($password) || strlen($password) < 6) $errors[] = "Password must be at least 6 characters long";
        if (empty($gender)) $errors[] = "Gender is required";
        if ($weight < 30 || $weight > 300) $errors[] = "Valid weight is required (30-300 kg)";
        if ($height < 100 || $height > 250) $errors[] = "Valid height is required (100-250 cm)";
        if (empty($user_goal)) $errors[] = "User goal is required";
        if (empty($activity_level)) $errors[] = "Activity level is required";
        
        if (!empty($errors)) {
            return back()->withErrors(['form' => implode(', ', $errors)]);
        }
        
        // Adatok elmentése session-be (mivel nincs adatbázis)
        session([
            'user_data' => [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'gender' => $gender,
                'weight' => $weight,
                'height' => $height,
                'user_goal' => $user_goal,
                'activity_level' => $activity_level
            ]
        ]);
        
        // Bejelentkeztetjük a felhasználót
        session(['logged_in' => true]);
        
        return redirect('/registration-success');
    }
}