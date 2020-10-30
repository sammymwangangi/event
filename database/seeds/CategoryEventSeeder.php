<?php

use Illuminate\Database\Seeder;

class CategoryEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Populate Users
        factory(\App\User::class, 5)->create();

        // Populate Services
        factory(\App\Service::class, 5)->create();

        // Populate Venues
        factory(\App\Venue::class, 5)->create();

        // Populate categories
        factory(App\Category::class, 5)->create();

        // Populate Events
        factory(App\Event::class, 5)->create();

        // Get all the categories attaching to each event
        $categories= App\Category::all();

        // Populate the pivot table
        App\Event::all()->each(function ($event) use ($categories) {
            $event->categories()->attach(
                $categories->random(rand(1, $categories->count()))->pluck('id')->toArray()
            );
        });
    }
}
