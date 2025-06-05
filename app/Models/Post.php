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
        'image_url',
        'location_name',
        'latitude',
        'longitude'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
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

    // One-to-many with Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Many-to-many with User (saved posts)
    public function savers()
    {
        return $this->belongsToMany(User::class, 'saved_posts');
    }
}
