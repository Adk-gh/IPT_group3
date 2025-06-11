<?php

// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caption',
        'tags',
        'image_url',
        'location_name',
        'latitude',
        'longitude'
    ];

    // Relationship with User
    public function user()
{

       return $this->belongsTo(User::class, 'user_id', 'user_id');
}


    // Many-to-many with Tag
    public function tags()
{
    return $this->belongsToMany(Tag::class);
}


    // One-to-many with Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Many-to-many with User (saved posts)
    public function savers()
    {
        return $this->belongsToMany(User::class, 'saved_posts');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    // Check if the authenticated user has liked the post
    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_id', 'user_id');
    }
// In your Post model
/*public function comments()
{
    return $this->hasMany(Comment::class)->with('user')->latest();
}
*/
// app/Models/Post.php
public function firstComment()
{
    return $this->comments()->with('user')->oldest()->first();
}

    public function commentsCount()
    {
        return $this->comments()->count();
    }
public function shares()
{
    return $this->hasMany(SharedPost::class);
}

// Relationship: a post can have many shared posts
public function sharedPosts()
{
    return $this->hasMany(SharedPost::class);
}

public function sharedPost()
{
    return $this->hasOne(SharedPost::class);
}

public function shareCount()
{
    return $this->sharedPosts()->count();
}

public function savedByUsers()
{
    return $this->belongsToMany(User::class, 'saved_posts')->withTimestamps();
}

public function isSavedByUser($userId)
{
    return $this->savedByUsers()->where('user_id', $userId)->exists();
}
    public function sharedComments()
    {
        return $this->hasMany(SharedComment::class);
    }


// Polymorphic relationship for comments (new comments)
    public function polymorphicComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Legacy relationship for comments (via post_id)
    public function legacyComments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    // Combined comments (for eager loading)
    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}


    // Accessor for all comments (legacy and polymorphic)
    public function getAllCommentsAttribute()
    {
        return $this->polymorphicComments()
            ->get()
            ->merge($this->legacyComments()->get())
            ->sortByDesc('created_at')
            ->values();
    }

    // Comments count (use stored value)
    public function getCommentsCountAttribute($value)
    {
        return $value;
    }
}
