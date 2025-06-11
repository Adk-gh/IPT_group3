<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\SharedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|in:App\Models\Post,App\Models\SharedPost',
            'text' => 'required|string|max:1000',
        ]);

        // Find the commentable model with its relationships
        $commentable = $request->commentable_type::with(['user', 'comments.user'])
            ->findOrFail($request->commentable_id);

        // Create the new comment
        $comment = $commentable->comments()->create([
            'user_id' => Auth::id(),
            'text' => $request->text,
        ]);

        // Load the user relationship for the new comment
        $comment->load('user');

        // Increment comments count
        $commentable->increment('comments_count');

        // Get all comments with users (for modal)
        $comments = $commentable->comments()->with('user')->latest()->get();

        // Get first comment with user (for preview)
        $firstComment = $commentable->comments()
            ->with('user')
            ->oldest()
            ->first();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'comments_count' => $commentable->comments_count,
                'comment' => [
                    'id' => $comment->id,
                    'text' => $comment->text,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'user' => [
                        'id' => $comment->user->id,
                        'username' => $comment->user->username,
                        'name' => $comment->user->name,
                        'profile_picture' => $comment->user->profile_picture
                            ? asset('storage/'.$comment->user->profile_picture)
                            : asset('img/default.jpg'),
                    ]
                ],
                'first_comment' => $firstComment ? [
                    'text' => $firstComment->text,
                    'user' => [
                        'username' => $firstComment->user->username,
                        'profile_picture' => $firstComment->user->profile_picture
                            ? asset('storage/'.$firstComment->user->profile_picture)
                            : asset('img/default.jpg'),
                    ],
                    'created_at' => $firstComment->created_at->diffForHumans()
                ] : null,
                'commentable_type' => $request->commentable_type,
                'commentable_id' => $request->commentable_id,
            ]);
        }

        return redirect()->back()->with('success', 'Comment posted!');
    }
}
