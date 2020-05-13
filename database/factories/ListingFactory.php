<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Listing;
use Faker\Generator as Faker;

$factory->define(Listing::class, function (Faker $faker) {
    return [
        'title' => $faker->text(),
        'section_id' => 1,
        'type_id' => 1,
    ];
});
