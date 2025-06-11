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
    $firstComment = Comment::where('commentable_id', $request->commentable_id)
        ->where('commentable_type', $request->commentable_type)
        ->first();
    $commentable = $request->commentable_type::findOrFail($request->commentable_id);

    $comment = $commentable->comments()->create([
        'user_id' => Auth::id(),
        'text' => $request->text,
    ]);

    $commentable->increment('comments_count');

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'comments_count' => $commentable->comments_count,
            'user' => Auth::user(),
            'comment' => $comment,
            'first_comment' => $firstComment ? $firstComment->text : null,
            'commentable_type' => $request->commentable_type,
            'commentable_id' => $request->commentable_id,
        ]);
    }

    return redirect()->back()->with('success', 'Comment posted!');
}

}
