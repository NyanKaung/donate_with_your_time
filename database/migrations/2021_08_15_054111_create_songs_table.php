<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('song_name')->nullable();
            $table->string('song_image')->nullable();
            $table->string('song_duration')->nullable();
            $table->foreignId('category_id')->constrained('categories')->nullable();
            $table->foreignId('artist_id')->constrained('artists')->nullable();
            $table->boolean('today_playlist')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
