<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Speaker;
use Faker\Generator as Faker;

$factory->define(Speaker::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'location_id' => factory(\App\Location::class),
    ];
});
