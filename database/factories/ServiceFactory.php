<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'title' => $faker->title,
        'price' => $faker->numberBetween($min = 1000, $max = 9000), // 8567,
        'description' => $faker->paragraph,
        'avatar' => $faker->imageUrl($width = 1920, $height = 1280),
    ];
});
