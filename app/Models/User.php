<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\UserInfo;
USE Illuminate\Database\Eloquent\Relations\HasOne;

// app/Models/User.php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One-to-one with UserInfo
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'user_id');
    }
    // One-to-many with Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // One-to-many with Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // One-to-many with Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Many-to-many with saved Posts
    public function savedPosts()
    {
        return $this->belongsToMany(Post::class, 'saved_posts');
    }

    // Following/followers relationships (if you want to implement this)
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }


    public function info()
{
    return $this->hasOne(UserInfo::class);
}

}
