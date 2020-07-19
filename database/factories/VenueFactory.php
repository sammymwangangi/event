<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venue;
use Faker\Generator as Faker;

$factory->define(Venue::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'name' => $faker->title,
        'price' => $faker->numberBetween($min = 1000, $max = 9000), // 8567,
        'address' => $faker->streetAddress,
        'seats' => $faker->numberBetween($min = 20, $max = 500),
        'image' => $faker->imageUrl($width = 1920, $height = 1280),
    ];
});
