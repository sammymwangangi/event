<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'venue_id' => factory(App\Venue::class),
        'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->paragraph,
        'entry_fee' => $faker->numberBetween($min = 1000, $max = 9000), // 8567,
        'starts_at' => $faker->dateTime('now'),
        'ends_at' => $faker->dateTime('+01 days'),
        'photo' => 'car.png',
        'tickets' => $faker->numberBetween($min = 200, $max = 500),
        'location' => $faker->state,
    ];
});
