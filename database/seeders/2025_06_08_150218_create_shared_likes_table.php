<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedLikesTable extends Migration
{
    public function up()
    {
        Schema::create('shared_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shared_post_id')->constrained('shared_posts')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['shared_post_id', 'user_id']); // prevent duplicate likes by same user
        });
    }

    public function down()
    {
        Schema::dropIfExists('shared_likes');
    }
}
