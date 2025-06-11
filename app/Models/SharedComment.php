<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SharedComment extends Model
{
    use HasFactory;

    protected $table = 'shared_comments';

    protected $fillable = [
        'user_id',
        'shared_post_id',
        'text',
    ];

    // A comment belongs to a shared post
   public function sharedPost()
    {
        return $this->belongsTo(SharedPost::class, 'shared_post_id');
    }

public function user()
{
    return $this->belongsTo(User::class);
}
}
