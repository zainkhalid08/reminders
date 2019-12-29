<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('content');
            $table->unsignedBigInteger('speaker_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->date('date');
            $table->string('hijri_date')->nullable();
            $table->string('hijri_month')->nullable();
            $table->string('hijri_year')->nullable();
            $table->string('video_src');
            $table->string('image_src')->nullable();
            $table->tinyInteger('mins_read')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('published_at')->nullable();

            $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
