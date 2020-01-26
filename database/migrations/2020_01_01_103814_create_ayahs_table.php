<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
            $table->longText('raw_content')->nullable();
            $table->integer('surah_number')->nullable();
            $table->integer('ayah_number')->nullable();
            $table->unsignedBigInteger('post_id');

            // $table->unique(['surah', 'ayah']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('ayahs');
    }
}
