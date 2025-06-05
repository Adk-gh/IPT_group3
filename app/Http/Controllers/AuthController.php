<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show the sign-in form
    public function showSignInForm()
    {
        return view('Signin');
    }

    // Handle user sign-in
// In AuthController.php
public function signIn(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

      return redirect()->intended(route('home'));
 // lowercase profile if your route is /profile
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}


    // Show the home page
    public function showIndex()
    {
        return view('index');
    }

    // Show the sign-up form
    public function showSignUpForm()
    {
        return view('Signup');
    }

    // Handle user registration
   public function signUp(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->first_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/profile')->with('success', 'Account created successfully!');
}


    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been signed out successfully.');
    }

    // Show user profile
 public function showProfile()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors('You must be logged in to view the profile.');
    }

    return view('Profile', compact('user'));
}

//static
 public function socialFeed()
    {
        return view('SocialFeed');
    }

    public function showArtist()
    {
        return view('Artist');
    }

    public function showArticles()
    {
        return view('Articles');
    }

    public function showAboutUs()
    {
        return view('AboutUs');
    }

    public function showContact()
    {
        return view('Contact');
    }


}
