<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationTable extends Migration
{
    public function up()
    {
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // One-to-one relationship

            // Corrected: use string for file paths
            $table->string('profile_picture')->nullable();
            $table->string('cover_photo')->nullable();

            $table->text('bio')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
