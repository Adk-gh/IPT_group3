<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tag;

class ProfileSetupController extends Controller
{
  public function store(Request $request)
{
    $user = Auth::user();

    if (!$user instanceof \App\Models\User) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'username' => 'required|string|max:255',
        'bio' => 'nullable|string|max:150',
        'location' => 'nullable|string|max:255',
        'birthdate' => 'nullable|date',
        'phone' => 'nullable|string|max:20',
        'instagram' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|max:2048',
        'cover_photo' => 'nullable|image|max:4096',
    ]);

    // Update fields
    $user->username = $request->input('username');
    $user->bio = $request->input('bio');
    $user->location = $request->input('location');
    $user->birthdate = $request->input('birthdate');
    $user->phone = $request->input('phone');
    $user->instagram = $request->input('instagram');
    $user->twitter = $request->input('twitter');
    $user->facebook = $request->input('facebook');

    // Handle profile picture
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_picture', 'public');
        $user->profile_picture = $path;
    }

    // Handle cover photo
    if ($request->hasFile('cover_photo')) {
        $path = $request->file('cover_photo')->store('cover_photos', 'public');
        $user->cover_photo = $path;
    }

    $user->profile_completed = true;
    $user->save();

    return redirect()->route('home')->with('success', 'Profile setup complete!');
}

public function show()
{
    $tags = Tag::all(); // or Tag::orderBy('name')->get();
    return view('ProfileSetup', compact('tags'));
}

}
