<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\SharedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Determine if it's a shared post
        $shared = $post->sharedPost;

        return $this->likePost($request, $shared ?? $post);
    }

    public function destroy(Request $request, Post $post)
    {
        $shared = $post->sharedPost;

        return $this->unlikePost($request, $shared ?? $post);
    }

    protected function likePost(Request $request, $item)
    {
        $userId = Auth::id();
        $postId = $item->id;
        $isShared = $item instanceof \App\Models\SharedPost;

        Log::debug('Like attempt', [
            'user_id' => $userId,
            'post_id' => $postId,
            'shared' => $isShared,
            'ip_address' => $request->ip(),
        ]);

        $existingLike = Like::where('user_id', $userId)
                            ->where('post_id', $postId)
                            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'Already liked'], 422);
        }

        Like::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        $item->increment('likes_count');

        return response()->json([
            'message' => 'Liked successfully',
            'likes_count' => $item->fresh()->likes_count,
            'liked' => true,
        ]);
    }

    protected function unlikePost(Request $request, $item)
    {
        $userId = Auth::id();
        $postId = $item->id;
        $isShared = $item instanceof \App\Models\SharedPost;

        Log::debug('Unlike attempt', [
            'user_id' => $userId,
            'post_id' => $postId,
            'shared' => $isShared,
            'ip_address' => $request->ip(),
        ]);

        try {
            return DB::transaction(function () use ($userId, $item, $postId) {
                $like = Like::where('user_id', $userId)
                            ->where('post_id', $postId)
                            ->first();

                if (!$like) {
                    return response()->json(['message' => 'Like not found'], 404);
                }

                $like->delete();

                if ($item->likes_count > 0) {
                    $item->decrement('likes_count');
                }

                return response()->json([
                    'message' => 'Unliked successfully',
                    'likes_count' => $item->fresh()->likes_count,
                    'liked' => false,
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Unlike failed', [
                'user_id' => $userId,
                'post_id' => $postId,
                'error' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Failed to unlike'], 500);
        }
    }
}
