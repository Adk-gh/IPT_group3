<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class PostController extends Controller
{
    public function index()
    {
        // Fetch posts with user and tags relations, paginate 10 per page
        $posts = Post::with(['user', 'tags'])->latest()->paginate(10);

        // Fetch trending tags
        $trendingTags = Tag::orderByDesc('usage_count')->take(10)->get();

        // Pass to view
       return view('SocialFeed', compact('posts', 'trendingTags'));


    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'caption' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'location_name' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle image upload
        $imageUrl = null;
        if ($request->hasFile('image_url')) {
            $imageUrl = $request->file('image_url')->store('uploads/posts', 'public');
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

        return redirect()->back()->with('success', 'Post created successfully!');
    }
}

