<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SharedLike extends Model
{
    use HasFactory;

    protected $table = 'shared_likes';

    protected $fillable = [
        'user_id',
        'shared_post_id',
    ];

    // A like belongs to a shared post
   public function sharedPost()
{
    return $this->belongsTo(SharedPost::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
