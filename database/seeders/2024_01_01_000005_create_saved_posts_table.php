<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// [timestamp]_create_saved_posts_table.php
if (!Schema::hasTable('saved_posts')) {
    Schema::dropIfExists('saved_posts');
}
Schema::create('saved_posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    $table->unique(['user_id', 'post_id']); // Prevent duplicate saves
});
