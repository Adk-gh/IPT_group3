<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// [timestamp]_create_likes_table.php
if (!Schema::hasTable('likes')) {
Schema::create('likes', function (Blueprint $table) {
    $table->id();

    // Explicitly define as unsignedBigInteger
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('post_id');

    $table->timestamps();

    // Define foreign keys with explicit references
    $table->foreign('user_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');

    $table->foreign('post_id')
          ->references('id')
          ->on('posts')
          ->onDelete('cascade');

    // Add unique constraint to prevent duplicate likes
    $table->unique(['user_id', 'post_id']);
});
}
