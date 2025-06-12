<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\StreetArtLocation;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/street-art-locations', function() {
    Log::info('Fetching all street art locations.');
    return StreetArtLocation::all();
});

Route::get('/posts', function () {
    try {
        Log::info('Request to /api/posts received.');

        $posts = Post::with(['user', 'tags'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        Log::info('Number of posts fetched: ' . $posts->count());

       $mappedPosts = $posts->map(function ($post) {
    return [
        'id' => $post->id,
        'description' => $post->caption,
        'latitude' => $post->latitude,
        'longitude' => $post->longitude,
        'imageUrl' => $post->image_url ? asset('storage/' . $post->image_url) : null,
        'user' => [
            'name' => $post->user?->name ?? 'Unknown',
            'email' => $post->user?->email ?? 'N/A',
       'avatar' => $post->user?->profile
    ? asset('storage/' . $post->user?->profile)
    : asset('img/default.jpg'),




        ],
        'location' => $post->location_name ?? 'Unknown',
        'created_at' => $post->created_at->diffForHumans(),
        'tags' => $post->tags instanceof Collection ? $post->tags->pluck('name') : [],
    ];
});

        Log::debug('Mapped post data:', $mappedPosts->toArray());

        return $mappedPosts;

    } catch (\Exception $e) {
        Log::error('Error fetching posts: ' . $e->getMessage());
        return response()->json([
            'error' => 'Could not fetch posts.',
            'details' => $e->getMessage()
        ], 500);
    }
});
