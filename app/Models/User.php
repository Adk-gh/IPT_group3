<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'profile_picture',
        'profile_completed',
        'preference',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_completed' => 'boolean',
    ];

    // One-to-many with Post
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function savedPosts()
{
    return $this->belongsToMany(Post::class, 'saved_posts'); // or your pivot table name
}
public function hasSavedPost($postId)
{
    return $this->savedPosts()->where('post_id', $postId)->exists();
}
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function sharedPosts()
    {
        return $this->hasMany(SharedPost::class);
    }

    // Accessor for artworks_count
    public function getArtworksCountAttribute()
    {
        return $this->posts()->count();
    }
    //reports
    public function reports()
    {
        return $this->hasMany(PostReport::class, 'user_id', 'user_id');
    }
}
