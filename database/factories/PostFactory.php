<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $meta = [
        'description' => $faker->sentence(),
        'keywords' => implode(', ', $faker->words(5)),
    ];

    return [
        'title' => $faker->sentence(4),
        'content' => $faker->randomHtml(),
        'speaker_id' => factory(\App\Speaker::class),
        'location_id' => factory(\App\Location::class),
        'date' => $faker->date,
        'hijri_date' => null,
        'hijri_month' => null,
        'hijri_year' => null,
        'video_src' => 'https://www.youtube.com/embed/KJq08q7qfr4',
        'image_src' => $faker->word,
        'mins_read' => $faker->numberBetween(1, 7),
        'meta' => $meta,
        'user_id' => factory(\App\User::class),
        'published_at' => $faker->dateTime(),
    ];
    
});
