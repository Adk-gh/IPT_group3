<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->unsignedBigInteger('user_id');  // Foreign key
            $table->text('caption');
            $table->string('image_url')->nullable();
            $table->string('location_name');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                  ->references('user_id')  // Or 'id' if you haven't renamed it
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
