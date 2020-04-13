<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->slug(3),
        'client_id' => rand(1, 100),
        'category_id' => rand(1, 10),
        'start_date' => $faker->date(),
        'deadline' => $faker->date(),
        'status' => rand(1, 5),
        'description' => $faker->paragraph,
    ];
});
