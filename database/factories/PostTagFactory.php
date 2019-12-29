<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostTag;
use Faker\Generator as Faker;

$factory->define(PostTag::class, function (Faker $faker) {
    return [
        'post_id' => factory(\App\Posts::class),
        'tag_id' => factory(\App\Tags::class),
    ];
});
