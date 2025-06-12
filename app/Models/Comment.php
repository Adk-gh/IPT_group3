<?php

// app/Models/Comment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Comment extends Model
{
    use HasFactory;

 protected $fillable = [
    'user_id',
    'text',
    'commentable_id',
    'commentable_type',
];



   public function commentable()
    {
        return $this->morphTo();
    }

   public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'user_id')->withDefault([
        'username' => 'Anonymous',
        'name' => 'Anonymous User',
        'profile_picture' => null,
    ]);
}


    /*
// In Comment.php
public function user()
{
    return $this->belongsTo(User::class)->withDefault([
        'username' => 'Anonymous',
        'name' => 'Anonymous User',
        'profile_picture' => null
    ]);
}
*/

}
