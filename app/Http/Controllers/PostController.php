<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        Log::info('Fetching posts for feed');

        // Fetch posts with user and tags relations, paginate 10 per page
        $posts = Post::with(['user', 'tags'])->latest()->paginate(10);
        Log::info('Fetched posts:', ['posts' => $posts]);

        // Fetch trending tags
        $trendingTags = Tag::orderByDesc('usage_count')->take(10)->get();
        Log::info('Trending tags:', ['tags' => $trendingTags]);

        return view('SocialFeed', compact('posts', 'trendingTags'));
    }

    public function store(Request $request)
    {
        Log::info('Received post creation request', ['request_data' => $request->all()]);

        // Validate input
        $validatedData = $request->validate([
            'caption' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Log::info('Validated data:', $validatedData);

        // Handle image upload
        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $imageUrl = $request->file('image_url')->store('uploads/posts', 'public');
            Log::info('Image uploaded to:', ['path' => $imageUrl]);
        }

        // Create new post
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
}
