<?php

use Illuminate\Http\Request;
use App\Models\SharedLike;
use App\Models\SharedPost;

class SharedPostInteractionController
{
    public function likeSharedPost(Request $request, $sharedPostId)
    {
        $userId = auth()->id();

    $existingLike = SharedLike::where('user_id', $userId)
                              ->where('shared_post_id', $sharedPostId)
                              ->first();

    if ($existingLike) {
        return response()->json(['message' => 'Already liked'], 422);
    }

    SharedLike::create([
        'user_id' => $userId,
        'shared_post_id' => $sharedPostId,
    ]);

    // Optionally increment a likes_count column on shared_post
    SharedPost::find($sharedPostId)->increment('likes_count');

    return response()->json(['message' => 'Liked successfully']);
    }

    public function unlikeSharedPost(Request $request, $sharedPostId)
    {
        $userId = auth()->id();
        $like = SharedLike::where('shared_post_id', $sharedPostId)->where('user_id', $userId)->first();
        if ($like) {
            $like->delete();
            SharedPost::find($sharedPostId)->decrement('likes_count');
        }
        return response()->json(['message' => 'Unliked successfully']);
    }
}
