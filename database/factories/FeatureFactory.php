<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Feature;
use Faker\Generator as Faker;

$factory->define(Feature::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
