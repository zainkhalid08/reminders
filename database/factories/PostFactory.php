<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'content' => $faker->paragraphs(3, true),
        'speaker_id' => factory(\App\Speaker::class),
        'location_id' => factory(\App\Location::class),
        'date' => $faker->word,
        'video_src' => $faker->word,
        'image_src' => $faker->word,
        'mins_read' => $faker->word,
        'user_id' => factory(\App\User::class),
        'published_at' => $faker->dateTime(),
    ];
});
