<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\SharedPost;
use Illuminate\Pagination\LengthAwarePaginator;


class AuthController extends Controller
{
    // Redirect authenticated users away from auth pages
    private function redirectIfAuthenticated()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return null;
    }

    // Show the sign-up form
    public function showSignUpForm()
    {
        if ($redirect = $this->redirectIfAuthenticated()) {
            return $redirect;
        }
        return view('Signup');
    }

    // Show the sign-in form
    public function showSignInForm()
    {
        if ($redirect = $this->redirectIfAuthenticated()) {
            return $redirect;
        }
        return view('Signin');
    }

    // Handle user sign-in
    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle user registration
    public function signUp(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => "{$validated['first_name']} {$validated['last_name']}",
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'Account created successfully!');
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

        Log::info('User profile accessed', ['user_id' => $user->id]);

        $posts = Post::where('user_id', $user->id)
            ->with('tags')
            ->latest()
            ->get();

        return view('Profile', [
            'user' => $user,
            'posts' => $posts,
            'artworksCount' => $posts->count()
        ]);
    }

    // Update user profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'bio' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Handle file uploads
        foreach (['avatar', 'cover_photo'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($user->$field) {
                    Storage::disk('public')->delete($user->$field);
                }
                $validated[$field] = $request->file($field)->store($field.'s', 'public');
            }
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'user' => User::find($user->id),
            'avatar_url' => $user->avatar ? asset('storage/'.$user->avatar) : null,
            'cover_photo_url' => $user->cover_photo ? asset('storage/'.$user->cover_photo) : null
        ]);
    }



public function socialFeed()
{
    // Load all original posts
    $originalPosts = Post::with(['user', 'tags', 'comments.user'])
        ->latest()
        ->get();

    // Load all shared posts, including their original post and relationships
   $sharedPosts = SharedPost::with(['user', 'post.user', 'post.tags', 'post.comments.user'])
       ->latest()
       ->get();

    // Merge both types of posts into one collection and sort by creation time
    $allPosts = $originalPosts->concat($sharedPosts)->sortByDesc('created_at');

    // Paginate the merged result manually
    $perPage = 10;
    $currentPage = request()->get('page', 1);
    $paginatedPosts = new LengthAwarePaginator(
        $allPosts->forPage($currentPage, $perPage),
        $allPosts->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

     $tags = Tag::all();


    // Load trending tags and user post count
    $trendingTags = Tag::orderByDesc('usage_count')->take(10)->get();
    $artworksCount = auth()->check() ? Post::where('user_id', auth()->id())->count() : 0;

    return view('SocialFeed', [
        'posts' => $paginatedPosts, // this now contains both original and shared posts
        'trendingTags' => $trendingTags,
        'artworksCount' => $artworksCount,
        'tags' => $tags,
    ]);
}


    // Handle storing a new post
    public function storePost(Request $request)
    {
        $validatedData = $request->validate([
            'caption' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id', // Ensure tags are valid IDs
            'image_url' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:40960',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $validatedData['caption'],
            'tags' => $validatedData['tags'] ? json_encode($validatedData['tags']) : null,
            'image_url' => $request->file('image_url')->store('uploads/posts', 'public'),
            'location_name' => $validatedData['location_name'],
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
        ]);

        // Sync tags
        if ($validatedData['tags']) {
            $post->tags()->sync($validatedData['tags']);
        }
        if (!empty($validatedData['tags'])) {
    $cleanTags = array_filter($validatedData['tags'], fn($tag) => !empty($tag));
    $post->tags()->sync($cleanTags);
}


        return redirect()->back()->with('success', 'Your post was successfully created!');
    }

    // Homepage
    public function index()
    {
        $posts = Post::with(['user', 'tags'])
            ->latest()
            ->paginate(10);

        $users = User::where('email', '!=', 'admin@gmail.com')
            ->paginate(12);

        $postsWithLocation = collect($posts->items())->filter(function ($post) {
            return $post->latitude && $post->longitude;
        })->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->caption ?? 'Untitled',
                'tags' => $post->tags ?? ['N/A'],
                'longitude' => $post->longitude,
                'location_name' => $post->location_name ?? '',
                'image_url' => $post->image_url ? asset('storage/'.$post->image_url) : null,
            ];
        });

        return view('index', compact('posts', 'users', 'postsWithLocation'));
    }

    // Share a post
    public function share(Request $request, $postId)
    {
        $request->validate([
            'caption' => 'nullable|string|max:1000',
        ]);

        SharedPost::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'Post shared successfully.');
    }

    // Static pages
    public function showArtist()
    {
        return view('Artist', [
            'users' => User::where('email', '!=', 'admin@gmail.com')
                ->paginate(12)
        ]);
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
