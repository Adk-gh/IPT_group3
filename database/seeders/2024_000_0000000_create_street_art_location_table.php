<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\StreetArtLocation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateStreetArtLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('street_art_locations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->enum('type', ['stencil', 'mural', 'political', 'installation', 'other']);
            $table->string('image_url')->nullable();
            $table->string('artist')->nullable();
            $table->integer('year')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('street_art_locations');
    }
}
