<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class AuthController extends Controller
{
    // Show the sign-in form
    public function showSignInForm()
    {
        return view('Signin');
    }

    // Handle user sign-in
    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
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

    // Social Feed (now includes post loading logic)
    public function socialFeed()
    {
        Log::info('Fetching posts for feed');

        $posts = Post::with(['user', 'tags'])->latest()->paginate(10);
        Log::info('Fetched posts:', ['posts' => $posts]);

        $trendingTags = Tag::orderByDesc('usage_count')->take(10)->get();
        Log::info('Trending tags:', ['tags' => $trendingTags]);



        return view('SocialFeed', compact('posts', 'trendingTags'));
    }

    // Handle storing a new post
    public function storePost(Request $request)
    {
        Log::info('Received post creation request', ['request_data' => $request->all()]);

        $validatedData = $request->validate([
            'caption' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $imageUrl = $request->file('image_url')->store('uploads/posts', 'public');
            Log::info('Image uploaded to:', ['path' => $imageUrl]);
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->caption = $request->caption;
        $post->image_url = $imageUrl;
        $post->location_name = $request->location_name;
        $post->latitude = $request->latitude;
        $post->longitude = $request->longitude;
        $post->save();

        Log::info('Post created:', ['post' => $post]);

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    // Other static pages
    public function showArtist() { return view('Artist'); }
    public function showArticles() { return view('Articles'); }
    public function showAboutUs() { return view('AboutUs'); }
    public function showContact() { return view('Contact'); }

    // Profile updates
    public function updateCoverPhoto(Request $request)
    {
        $request->validate([
            'cover_photo' => 'required|image|max:2048',
        ]);

        $user = User::find(auth()->id());
        $path = $request->file('cover_photo')->store('cover_photos', 'public');
        $user->cover_photo = asset('storage/' . $path);
        $user->save();

        return response()->json(['cover_photo_url' => $user->cover_photo]);
    }

    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:500',
        ]);

        $user = User::find(auth()->id());
        if ($user) {
            $user->bio = $request->bio;
            $user->save();
            return response()->json(['bio' => $user->bio]);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
}
