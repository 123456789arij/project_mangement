<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'titre' => $faker->title,
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'description' => $faker->paragraph(5),
        'priority' => rand(1, 3),
        'status' => rand(1, 5),
        'project_id' => rand(1, 200),
    ];
});
