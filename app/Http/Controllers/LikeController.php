<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\SharedPost;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'likeable_id' => 'required|integer',
            'likeable_type' => 'required|string|in:App\Models\Post,App\Models\SharedPost'
        ]);

        $likeableType = $request->likeable_type;
        $likeableId = $request->likeable_id;

        $likeable = $likeableType::findOrFail($likeableId);

        $existingLike = Like::where([
            'user_id' => auth()->id(),
            'likeable_id' => $likeableId,
            'likeable_type' => $likeableType
        ])->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            $like = new Like(['user_id' => auth()->id()]);
            $likeable->likes()->save($like);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likeable->likes()->count()
        ]);
    }
}
