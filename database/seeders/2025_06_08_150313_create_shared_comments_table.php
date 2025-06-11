<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedCommentsTable extends Migration
{
    public function up()
{
    Schema::create('shared_comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('shared_post_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('text');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('shared_comments');
    }
}
