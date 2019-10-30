<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Measurement;
use Faker\Generator as Faker;

$factory->define(Measurement::class, function (Faker $faker) {
    return [
        'PM1' => rand(3, 50),
        'PM25' => rand(3, 50),
        'PM10' => rand(3, 50),
        'AveragePM1' => rand(3, 50),
        'AveragePM25' => rand(3, 50),
        'AveragePM10' => rand(3, 50),
        'Temperature' => rand(3, 50),
        'Humidity' => rand(3, 50),
        'IJPDescription' => $faker->text(30),
        'IJPString' => 'Dobry',
        'Created_at' => \Carbon\Carbon::now()
    ];
});
