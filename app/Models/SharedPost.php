<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SharedPost extends Model
{
    protected $fillable = ['user_id', 'post_id', 'caption', 'likes_count', 'comments_count'];

    // Relationship to the original Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relationship to the User who shared the post
    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'user_id');
}



    // Polymorphic relationship for likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Check if the current user has liked this shared post
    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    // Polymorphic relationship for comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
